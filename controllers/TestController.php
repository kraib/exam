<?php

namespace app\controllers;

use app\models\Question;
use app\models\QuestionKeywords;
use app\models\Result;
use app\models\StudentAnswer;
use app\models\StudentTest;
use DateTime;
use Yii;
use app\models\Test;
use app\models\TestSearch;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Test model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Test model.
     * @param integer $id
     * @return mixed
     */
    public function actionSit($id)
    {
        $test = $this->findModel($id);
        $questions = new Question();
        $test_questions =  $questions->find()->where(['test_id' =>$test->id])->all();
        $studentTest  = new StudentTest();
        $has_taken_test = StudentTest::find()->where([
            'student_id' => Yii::$app->user->id,
            'test_id' => $test->id
        ])->exists();
        //echo $has_taken_test;

        if($has_taken_test){

            return $this->redirect(Yii::$app->urlManager->createUrl("test/student-home"));
        }
        $answers = [];


        for($i = 0; $i < count($test_questions); $i++) {
            $answers[] = new StudentAnswer();
        }




    if (Model::loadMultiple($answers, Yii::$app->request->post()) &&  Model::validateMultiple($answers)) {
        // valid data received in $model

        // do something meaningful here about $model ...

        $studentTest->student_id = Yii::$app->user->id;
        $studentTest->test_id = $test->id;
        $studentTest->taken = 1;


        /*
         * Get ids of all questions in this test
         *
         */
        $test_questions_ids = array();

        foreach($test_questions as $tq){
            $test_questions_ids[]= $tq->id;
        }
        $keyword_points = QuestionKeywords::find()->where(['question_id' => $test_questions_ids])->all();


        /*
         * Get total marks achievable for this test
         *
         */
        $total_test_marks= 0;
        foreach($keyword_points as $keyword_point){
            $total_test_marks+=$keyword_point->marks;
        }
        //echo $total_test_marks;

        /*
         * Add all answers to the database and grade them
         */
        $total_score =0;
        foreach ($answers as $answer) {
            $answer->save(false);
            $keywords = QuestionKeywords::find()->andWhere(['question_id'=> $answer->question_id])->all();
            $kw = array();

            foreach($keywords as $keyword){
                $kw[$keyword->keyword] = $keyword->marks;
            }

            $total_score +=  $this->grade_question($kw, $answer->answer);

        }
        $studentTest->save();
        $result= new Result();
        $result->test_id = $test->id;
        $result->student_id = Yii::$app->user->id;
        $result->total_score = $total_score;
        $result->score_percentage = ($total_score/$total_test_marks)*100;
        $result->duration_used = 0;
        $result->save();



        return $this->redirect(Yii::$app->urlManager->createUrl("test/student-home"));
        } else {

            // either the page is initially displayed or there is some validation error
            return $this->render('sit', [
                'test' => $this->findModel($id),
                'test_questions' =>  $test_questions,
                'answers' => $answers,
            ]);
        }


    }

    public function actionStudentHome(){
        return $this->render('student-home', [
            'taken_tests' => $this->getTakenTests(),
            'available_tests' => $this->getAvailableTests(),

        ]);

    }

    public function actionExaminerHome(){
        return $this->render('examiner-home', [
            'examiners_tests' => $this->getExaminersTests(),
        ]);

    }

    /**
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Test();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Test model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionQuestionsFetch($id){
        if(Yii::$app->request->isAjax){
            $model = $this->findModel($id);
            return $this->renderAjax('qnkey',[
                'model' => $model,
            ]);
        }
    }

    public function getTakenTests(){
        $tests_taken = StudentTest::find()->where(['student_id' => Yii::$app->user->id])->all();
        $ids_of_tests_taken =[];
        foreach ($tests_taken as $t){
            $ids_of_tests_taken[] = $t->test_id;
        }
        $tests = Test::find()->
            where([
                'id' => $ids_of_tests_taken,
            ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $tests,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $dataProvider;
    }

    public function getAvailableTests(){
        $tests_taken = StudentTest::find()->where(['student_id' => Yii::$app->user->id])->all();
        $ids_of_tests_taken =[];
        foreach ($tests_taken as $t){
            $ids_of_tests_taken[] = $t->test_id;
        }
        $tests = Test::find()->
            andWhere("time<=NOW()")->
            andWhere("NOW()<= DATE_ADD(time, INTERVAL + duration MINUTE)")->
            andWhere(['not in', 'id', $ids_of_tests_taken]);

        $dataProvider = new ActiveDataProvider([
            'query' => $tests,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $dataProvider;
    }

    public function getExaminersTests(){
        $tests = Test::find()->
            where([
                'examiner_id' => Yii::$app->user->id,
            ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $tests,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $dataProvider;
    }

    private function grade_question($question_keywords, $student_answer)
    {

        $score = 0;
        foreach($question_keywords as $keyw => $mark){

            if(preg_match("/(".$keyw.")/i", $student_answer, $match)){
                $score+=$mark;
            }

        }
        return $score;
    }


    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }




}
