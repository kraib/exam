<?php

namespace app\controllers;

use app\models\Question;
use app\models\StudentAnswer;
use app\models\StudentTest;
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
        echo $has_taken_test;

        if($has_taken_test){

            $testModel = new Test();
            $tests = $testModel->find();
            $dataProvider = new ActiveDataProvider([
                'query' => $tests,
                'pagination' => [
                    'pageSize' => 10,
                ]
            ]);

            return $this->render('student-home', [
                'tests' => $tests,
                'dataProvider' => $dataProvider,
            ]);
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

        foreach ($answers as $answer) {
            $answer->save(false);

        }
        $studentTest->save();

        $testModel = new Test();
        $tests = $testModel->find();
        $dataProvider = new ActiveDataProvider([
            'query' => $tests,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('student-home', [
            'tests' => $tests,
            'dataProvider' => $dataProvider,
        ]);
        } else {

            // either the page is initially displayed or there is some validation error
            return $this->render('sit', [
                'test' => $this->findModel($id),
                'test_questions' =>  $test_questions,
                'answers' => $answers,
            ]);
        }


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



    /**
     * Lists all Tests for a student.
     * @return mixed
     */
    public function actionStudentHome()
    {
        $testModel = new Test();
        $tests = $testModel->find();
        $dataProvider = new ActiveDataProvider([
            'query' => $tests,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('student-home', [
            'tests' => $tests,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function goStudentHome(){
        $testModel = new Test();
        $tests = $testModel->find();
        $dataProvider = new ActiveDataProvider([
            'query' => $tests,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('student-home', [
            'tests' => $tests,
            'dataProvider' => $dataProvider,
        ]);
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
