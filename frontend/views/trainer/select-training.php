<?php

/* @var $this yii\web\View */
/* @var $trainingsArr  */
/* @var $selectModel \frontend\models\SelectTrainingForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Выбор тренинга';
?>
<div class="popupWrap">
    <div class="popup">
    <?php $form = ActiveForm::begin(['id' => 'select-form']); ?>
        <?php echo $form->field($selectModel, 'training_id')->dropDownList($trainingsArr, [ 'prompt' => 'Выберите один вариант', ]) ?>
        <?php echo Html::submitButton('Установить', [
            'class' => 'submit',
            'name' => 'set-button'
        ]) ?>
    <?php ActiveForm::end() ?>
    </div>

</div>
