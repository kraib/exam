<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\QuestionKeywords */

$this->title = 'Create Question Keywords';
$this->params['breadcrumbs'][] = ['label' => 'Question Keywords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-keywords-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
