<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\XClassDriveQuestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="xclass-drive-question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'question')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'request')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_var_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_var_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_var_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_var_4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_isImage')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
