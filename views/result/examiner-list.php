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
               'attribute' => 'student',
                'value' => 'student.username',
            ],
            'total_score',
            'score_percentage',
            'comments:ntext',



        ],
    ]); ?>

</div>