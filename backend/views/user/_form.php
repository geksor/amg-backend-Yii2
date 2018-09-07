<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'role')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'group')->textInput() ?>

    <?= $form->field($model, 'training_id')->textInput() ?>

    <?= $form->field($model, 'dealer_center_id')->textInput() ?>

    <?= $form->field($model, 'command_id')->textInput() ?>

    <?= $form->field($model, 'amgStatic')->textInput() ?>

    <?= $form->field($model, 'mixStatic')->textInput() ?>

    <?= $form->field($model, 'mbux')->textInput() ?>

    <?= $form->field($model, 'xClassDrive')->textInput() ?>

    <?= $form->field($model, 'amgDrive')->textInput() ?>

    <?= $form->field($model, 'intelligent')->textInput() ?>

    <?= $form->field($model, 'mixDrive')->textInput() ?>

    <?= $form->field($model, 'xClassLine')->textInput() ?>

    <?= $form->field($model, 'quiz')->textInput() ?>

    <?= $form->field($model, 'moderatorPoints')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
