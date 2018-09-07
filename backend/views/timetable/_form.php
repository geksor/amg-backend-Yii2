<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */
/* @var $form yii\widgets\ActiveForm */
/* @var $day */
/* @var $training */
/* @var $group */

?>

<div class="timetable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'weekday')->hiddenInput(['value' => (integer) $day])->label(false) ?>

    <?= $form->field($model, 'trainingDay')->hiddenInput(['value' => (integer) $training])->label(false) ?>

    <?= $form->field($model, 'group')->hiddenInput(['value' => (integer) $group])->label(false) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'startTime')->textInput()  ?>

    <?= $form->field($model, 'stopTime')->textInput()?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
