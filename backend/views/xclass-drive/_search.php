<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\XClassDriveQuestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="xclass-drive-question-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'question') ?>

    <?= $form->field($model, 'question_image') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'answer_var_1') ?>

    <?php // echo $form->field($model, 'answer_var_2') ?>

    <?php // echo $form->field($model, 'answer_var_3') ?>

    <?php // echo $form->field($model, 'answer_var_4') ?>

    <?php // echo $form->field($model, 'answer_isImage') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
