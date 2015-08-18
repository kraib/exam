<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-view">

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

        <?=Html::a('Add Questions to Test',[ 'question/create', 'test'=>$model->id],['class'=>'btn btn-success'])  ?>
    </p>

    <div class="row">
        <div class="col-md-5">
            <?php
            //return examiner link
            $examiner = new \app\models\User();
            $username = $examiner->findIdentity($model->examiner_id)->username;
            $examiner_link = Html::a($username,['user/view', 'id'=>$model->id]);


            ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'subject',
                    [                      // the owner name of the model
                        'label' => 'Examiner',
                        'value' => $examiner_link,
                        'format' => 'html'
                    ],
                    'time',
                    'duration',
                ],
            ]) ?>
        </div>
        <div class="col-md-7">
            <h3>Test Questions</h3>
            <?php
             $questions = new \app\models\Question();

            $test_questions =  $questions->find()->where(['test_id' =>$model->id])->all();
            
            foreach ($test_questions as $qn ) {



            ?>

            <h4><?php echo $qn->question; ?></h4>

            <?php } ?>

        </div>

    </div>


</div>
