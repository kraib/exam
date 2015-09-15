<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'password')->textInput(['rows' => 6]) ?>


    <?php echo $form->field($model, 'role')->dropDownList(array('Admin' => 'Admin', 'Examiner' => 'Examiner','Student' => 'Student')) ?>

    <?php echo $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
