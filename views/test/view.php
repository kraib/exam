<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->registerJsFile('@web/js/test.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
/* @var $this yii\web\View */
/* @var $model app\models\Test */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['examiner-home']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="test-view col-md-12">


    <h1>
        <?= Html::encode($this->title) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
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
            <input type="hidden" id="test-id" value="<?php echo $model->id ?>"/>
            <h3>
                Test Questions
                <?=Html::a('Add',[ 'question/create', 'test'=>$model->id],['class'=>'btn  btn-success','data-toggle'=>'modal','data-target' => '#modal_question'])  ?>
            </h3>

          <div id="test-qns">


        </div>
        </div>

    </div>



</div>

<?php

Modal::begin([
    'id' => 'modal_question',
    'header' => '<h4 id="md-title">Add Question</h4>',
    'options'=> ['class'=>'']
]);?>
<div class="response">

</div>
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

<?php  Modal::end();


?>

<?php

Modal::begin([
    'id' => 'modal_keywords',
    'header' => '<h4 id="md-title">Add Keywords</h4>',
    'options'=> ['class'=>'']
]);?>


<?php  Modal::end();


?>

