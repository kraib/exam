<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1>My <?= Html::encode($this->title) ?></h1>
    <?php echo ""//"<p>". var_dump($dataProvider)."</p>"; // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p class="pull-right">
        <?= Html::a('Create Test', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $examiners_tests,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'subject',
            'time',
            'duration',
            [
                'label'=>'Edit',
                'format'=>'raw',
                'value' => function ($data) {
                    return  Html::a('Edit Test Questions', ['test/view','id' => $data->id], ['class' => 'btn btn-danger']);
                },

            ]
            ,
            [
                'label'=>'View Results',
                'format'=>'raw',
                'value' => function ($data) {
                    return  Html::a('View Results', ['result/examiner-list','test' => $data->id], ['class' => 'btn btn-success']);
                },

            ]


        ],
    ]); ?>

</div>
