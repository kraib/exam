<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Result */

$this->title = "Test: ".$test->name;
$this->params['breadcrumbs'][] = ['label' => 'Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="result-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2><?= Html::encode(Yii::$app->user->identity->username) ?></h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'total_score',
            'score_percentage',
            'comments:ntext',
            'duration_used',
        ],
    ]) ?>

</div>