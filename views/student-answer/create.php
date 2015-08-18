<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StudentAnswer */

$this->title = 'Create Student Answer';
$this->params['breadcrumbs'][] = ['label' => 'Student Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
