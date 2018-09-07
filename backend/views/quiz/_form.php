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

    <?= $form->field($model, 'answer_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trueAnswer')->dropDownList(
        [
            '1' => 'Ответ 1',
            '2' => 'Ответ 2',
            '3' => 'Ответ 3',
            '4' => 'Ответ 4',
        ],
        [
            'prompt' => 'Выберите правильный ответ...',
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
