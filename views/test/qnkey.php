<?php
use yii\helpers\Html;

$edit_icon = '<span class="glyphicon glyphicon-pencil"></span>';
$delete_icon = '<span class="glyphicon glyphicon-trash"></span>';


$questions = new \app\models\Question();

$test_questions =  $questions->find()->where(['test_id' =>$model->id])->all();

foreach ($test_questions as $qn ) {



?>
<div class="row">
    <div class="col-md-1">
        <h4 class="pull-right"></h4>
    </div>
    <div class="col-md-11">
        <h4><?php echo $qn->question;  ?></h4>
        <div class="row">
            <div class="col-md-1"></div>
            <?php

            $qn_keywords = new \app\models\QuestionKeywords();
            $keywords = $qn_keywords->find()->where(['question_id'=> $qn->id])->all();

            ?>


            <div class="col-md-2">Keywords</div>
            <div class="col-md-9 keyword-container">
                <?php foreach ( $keywords as $keyword ) { ?>
                    <div class="key-contain">
                        <div class="col-md-3"><?php echo $keyword->keyword; ?></div>
                        <div class="col-md-5"><?php echo $keyword->marks; ?></div>
                        <div class="col-md-4">
                            <?=Html::a($edit_icon ,[ 'question-keywords/update', 'id'=>$keyword->id,'test'=>$model->id],['class'=>''])  ?>
                            <?=Html::a($delete_icon ,[ 'question-keywords/delete', 'id'=>$keyword->id, 'test'=>$model->id],['class'=>'keyword-delete','data-id'=>$keyword->id])  ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<hr/>
<?php } ?>