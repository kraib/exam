<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $test app\models\Test */

$this->title = $test->name;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="test-view col-md-12">
    <h1>
        <?= Html::encode($this->title) ?>

    </h1>


            <h2>
                <?= Html::encode($test->subject) ?>
            </h2>


            <?php

            $qn_number = 1;
            $i = 0;

            foreach ($test_questions as $qn ) {

            ?>

                <h3><?=  Html::encode($qn->question) ?></h3>
                <p><?=  Html::encode($answers[$i]->answer) ?></p>




            <?php $i++;
            }

            $form =  ActiveForm::begin(
                ['action'=> Url::to(['test/hand-in', 'id' => $test->id ]) , 'id'=>'test-confirm-form']
            );

            ?>


    </div>
<div class="form-group">
    <?= Html::submitButton('Confrim', ['class' => 'btn btn-success']); ?>
</div>
<?php ActiveForm::end() ?>





</div>


