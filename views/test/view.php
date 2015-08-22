<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$edit_icon = '<span class="glyphicon glyphicon-pencil"></span>';
$delete_icon = '<span class="glyphicon glyphicon-trash"></span>';
?>
<div class="test-view col-md-12">


    <h1>
        <?= Html::encode($this->title) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </h1>

    

    <div class="row">
        <div class="col-md-3 test-details">
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

        <div class="col-md-9 qn-box">
            <h3>
                Test Questions
                <?=Html::a('Add',[ 'question/create', 'test'=>$model->id],['class'=>'btn  btn-success','data-toggle'=>'modal','data-target' => '#modal_question'])  ?>
            </h3>
            <div class="row">
                <div class="col-md-1">
                    <h4 class="pull-right">1</h4>
                </div>
                <div class="col-md-11">
                    <h4>Good old days? </h4>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">Keywords</div>
                        <div class="col-md-9 keyword-container">
                           <div class="key-contain">
                               <div class="col-md-3">Yes</div>
                               <div class="col-md-5">5 marks</div>
                               <div class="col-md-4">
                                   <?=Html::a($edit_icon ,[ 'question-keyword/edit', 'test'=>$model->id],['class'=>''])  ?>
                                   <?=Html::a($delete_icon ,[ 'question-keyword/delete', 'test'=>$model->id],['class'=>''])  ?>
                               </div>
                           </div>
                            <div class="key-contain">
                                <div class="col-md-3">Yes Yes</div>
                                <div class="col-md-5">20 marks</div>
                                <div class="col-md-4">
                                    <?=Html::a($edit_icon ,[ 'question-keyword/edit', 'test'=>$model->id],['class'=>''])  ?>
                                    <?=Html::a($delete_icon ,[ 'question-keyword/delete', 'test'=>$model->id],['class'=>''])  ?>
                                </div>
                            </div>
                            <div class="key-contain">
                                <div class="col-md-3">No</div>
                                <div class="col-md-5"> 0 marks</div>
                                <div class="col-md-4">
                                    <?=Html::a($edit_icon ,[ 'question-keyword/edit', 'test'=>$model->id],['class'=>''])  ?>
                                    <?=Html::a($delete_icon ,[ 'question-keyword/delete', 'test'=>$model->id],['class'=>''])  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-1">
                    <h4 class="pull-right">2</h4>
                </div>
                <div class="col-md-11">
                    <h4>Is Kraiba a fool? </h4>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">Keywords</div>
                        <div class="col-md-9 keyword-container">
                            <div class="key-contain">
                                <div class="col-md-3">Yes</div>
                                <div class="col-md-5">5 marks</div>
                                <div class="col-md-4">
                                    <?=Html::a($edit_icon ,[ 'question-keyword/edit', 'test'=>$model->id],['class'=>''])  ?>
                                    <?=Html::a($delete_icon ,[ 'question-keyword/delete', 'test'=>$model->id],['class'=>''])  ?>
                                </div>
                            </div>
                            <div class="key-contain">
                                <div class="col-md-3">Yes Yes</div>
                                <div class="col-md-5">20 marks</div>
                                <div class="col-md-4">
                                    <?=Html::a($edit_icon ,[ 'question-keyword/edit', 'test'=>$model->id],['class'=>''])  ?>
                                    <?=Html::a($delete_icon ,[ 'question-keyword/delete', 'test'=>$model->id],['class'=>''])  ?>
                                </div>
                            </div>
                            <div class="key-contain">
                                <div class="col-md-3">No</div>
                                <div class="col-md-5"> 0 marks</div>
                                <div class="col-md-4">
                                    <?=Html::a($edit_icon ,[ 'question-keyword/edit', 'test'=>$model->id],['class'=>''])  ?>
                                    <?=Html::a($delete_icon ,[ 'question-keyword/delete', 'test'=>$model->id],['class'=>''])  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
<?php
Modal::begin([
    'id' => 'modal_question',
    'header' => '<h4>Add Question</h4>',
    'options'=> ['class'=>'']
]);?>

<?php $question = new \app\models\Question(); ?>
    <?php $form =  ActiveForm::begin(
        ['action'=> Url::to(['question/create', 'test' => $model->id ]) , 'id'=>'question-create']
    ); ?>

<?= $form->field($question, 'test_id')->hiddenInput(['value'=>$model->id])->label(false); ?>

<?= $form->field($question, 'question')->textInput(['maxlength' => true]) ?>
<div class="form-group">
    <?= Html::submitButton('Create', ['class' => 'btn btn-success']); ?>
</div>
    <?php ActiveForm::end() ?>

<?php  Modal::end();  ?>

