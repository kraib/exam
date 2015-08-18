<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QuestionKeywords */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$request = Yii::$app->request;
$qn_id = $request->get('question');
?>

<div class="question-keywords-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question_id')->textInput(['value'=> $qn_id]) ?>

    <?= $form->field($model, 'keyword')->textInput(['maxlength' => true ] ) ?>

    <?= $form->field($model, 'marks')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
