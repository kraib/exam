<?php

use app\models\StudentAnswer;
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
            $form =  ActiveForm::begin(
                            //['action'=> Url::to(['test/confirm', 'id' => $test->id ]) , 'id'=>'test-form']
                        );


            $i = 0;
            echo count($answers);
            foreach ($answers as $index => $answer) {
                echo $i;
                echo $form->field($answer, "[$index]answer")->textInput()->label($test_questions[$i]->question);
                echo $form->field($answer, "[$index]student_id")->hiddenInput(['value'=>Yii::$app->user->id])->label(false);
                echo $form->field($answer, "[$index]question_id")->hiddenInput(['value'=>$test_questions[$i]->id])->label(false);
                $i++;

            }
            ?>



    </div>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-success']); ?>
</div>
<?php ActiveForm::end() ?>
</div>


