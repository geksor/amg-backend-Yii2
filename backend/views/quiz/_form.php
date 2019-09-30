<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Quiz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quiz-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-xs-8">
            <?= $form->field($model, 'answer_1')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'isTrue_1')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8">
            <?= $form->field($model, 'answer_2')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'isTrue_2')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8">
            <?= $form->field($model, 'answer_3')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'isTrue_3')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8">
            <?= $form->field($model, 'answer_4')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'isTrue_4')->checkbox() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
