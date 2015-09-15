<?php

use app\models\Question;
use app\models\StudentAnswer;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Result */

if($test)
$this->title = "Test: ".$test->name;

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="result-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2><?= Html::encode($student->username) ?></h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',

            'score_percentage',
            'comments:ntext',

        ],
    ]) ?>

</div>

<div class="col-md-9 qn-box">
    <input type="hidden" id="test-id" value="<?php echo $test->id ?>"/>
    <h3>
        Test Questions
    </h3>

    <div id="test-qns">
        <?php

        $edit_icon = '<span class="glyphicon glyphicon-pencil"></span>';
        $delete_icon = '<span class="glyphicon glyphicon-trash"></span>';




        foreach ($test_questions as $qn ) {



            ?>
            <script>


            </script>
            <div class="row">
                <div class="col-md-1">
                    <h4 class="pull-right"></h4>
                </div>
                <div class="col-md-11">
                    <h4><?php echo $qn->question;  ?></h4>
                    <div class="row">

                        <?php

                        $qn_keywords = new \app\models\QuestionKeywords();
                        $keywords = $qn_keywords->find()->where(['question_id'=> $qn->id])->all();
                        $answer = StudentAnswer::find()->where(['question_id'=> $qn->id, 'student_id' => $student->id])->one();

                        ?>
                        <?php foreach ( $keywords as $keyword )
                        {
                        $kw[$keyword->keyword] = $keyword->marks;
                        }
                        ?>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">

                            <b><?php if ($answer) {echo $answer->answer;echo "(".Question::grade_question($kw, $answer->answer)."marks)";}?></b>

                        </div>
                        <div class="col-md-7 keyword-container">



                            <?php foreach ( $keywords as $keyword ) { ?>
                                <div class="key-contain">
                                    <div class="col-md-4"><?php echo $keyword->keyword; ?></div>
                                    <div class="col-md-8"><?php echo $keyword->marks; ?></div>

                                </div>

                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
            <hr/>
        <?php } ?>

    </div>
</div>
