<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Question;
?>
<?php
$question_id = $this->params['question_id'];

?>
<div class="row key-container">
    <div class="col-md-5 question-section">
        <?php
        $question = new Question();
        $question = $question->findOne($question_id);
?>

        <h4>
           Question : <?php echo $question->question; ?>
        </h4>
        <div>

            <div class="row">
                <div class="col-md-1">

                </div>
                <div class="col-md-11">
                    <h4>Keywords</h4>
                    <ul class="keyword-list"></ul>
                </div>
            </div>

            </ul>
        </div>
    </div>
    <div class="col-md-7 question-key-section">

        <h4>
           Add Keywords
        </h4>
       <div class="row ">
           <div class="col-md-11">
               <?php $form =  ActiveForm::begin(
                   ['action'=> Url::to(['question-keywords/create', 'question' => $question_id ]) , 'id'=>'question-key-create']
               ); ?>
               <?= $form->field($model, 'question_id')->hiddenInput(['value'=> $question_id])->label(false) ?>

               <?= $form->field($model, 'keyword')->textInput(['maxlength' => true ] ) ?>

               <?= $form->field($model, 'marks')->textInput() ?>

               <div class="form-group">
                   <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
               </div>

               <?php ActiveForm::end(); ?>
           </div>
       </div>
    </div>
</div>
