<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1>My <?= Html::encode($this->title) ?></h1>
    <?php echo ""//"<p>". var_dump($dataProvider)."</p>"; // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $taken_tests,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'subject',
            [
            'attribute' => 'examiner',
            'value' => 'examiner.username'
            ],
            'time',
            'duration',


        ],
    ]); ?>

    <h2>Available <?= Html::encode($this->title) ?></h2>
    <?php echo ""//"<p>". var_dump($dataProvider)."</p>"; // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $available_tests,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'subject',
            [
                'attribute' => 'examiner',
                'value' => 'examiner.username'
            ],
            'time',
            'duration',
            [
                //'attribute' => 'Take Test',
                //'content' => Html::a('Take Test', ['sit'], ['class' => 'btn btn-success']),
                'label'=>'Take Test',
                'format'=>'raw',
                'value' => function ($data) {

                    return  Html::a('Take Test', ['sit','id' => $data->id], ['class' => 'btn btn-info']);
                },

            ],

        ],
    ]); ?>
</div>
