<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'password_hash') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'role') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'group') ?>

    <?php // echo $form->field($model, 'training_id') ?>

    <?php // echo $form->field($model, 'dealer_center_id') ?>

    <?php // echo $form->field($model, 'command_id') ?>

    <?php // echo $form->field($model, 'amgStatic') ?>

    <?php // echo $form->field($model, 'mixStatic') ?>

    <?php // echo $form->field($model, 'mbux') ?>

    <?php // echo $form->field($model, 'xClassDrive') ?>

    <?php // echo $form->field($model, 'amgDrive') ?>

    <?php // echo $form->field($model, 'intelligent') ?>

    <?php // echo $form->field($model, 'mixDrive') ?>

    <?php // echo $form->field($model, 'xClassLine') ?>

    <?php // echo $form->field($model, 'quiz') ?>

    <?php // echo $form->field($model, 'moderatorPoints') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
