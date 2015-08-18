<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-view  col-md-12">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?=Html::a('Add Keywords to Question',[ 'question-keywords/create', 'question'=>$model->id],['class'=>'btn btn-success'])  ?>
    </p>
<div class="row">
    <div class="col-md-5">
        <?php
        $test = new \app\models\Test();
        $test= $test->findOne(['id'=>$model->test_id]);
        $test_name = $test->name;
        $test_link = Html::a($test_name,['test/view', 'id'=>$model->test_id]);
        ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'test_id',
                [
                    'label'=>'Test Name',
                    'value'=> $test_link,
                    'format' => 'html'
                ],
                'question',
            ],
        ]) ?>

    </div>
    <div class="col-md-7">
        <h4>Question KeyWords</h4>
        <?php
        $keywords = new \app\models\QuestionKeywords();
        $qn_keywords = $keywords->find()->where(['question_id' => $model->id])->all();

        foreach($qn_keywords as $keyword){
        ?>
            <h4> <?=$keyword->keyword ?></h4>
       <?php  } ?>


    </div>
</div>

</div>
