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
        'dataProvider' => $results,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
               'attribute' => 'First Name',
                'value' => 'student.first_name',
            ],
            [
                'attribute' => 'Last Name',
                'value' => 'student.last_name',
            ],
            [
                'label'=>'View Results',
                'format'=>'raw',
                'value' => function ($data) {
                    return  Html::a('View Results', ['result/examiner-view','student'=>$data->student_id,'test' => $data->test_id], ['class' => 'btn btn-success']);
                },

            ],

            'score_percentage',
            'comments:ntext',



        ],
    ]); ?>

</div>
