<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuestionKeywordsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Question Keywords';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-keywords-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Question Keywords', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'question_id',
            'keyword',
            'marks',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
