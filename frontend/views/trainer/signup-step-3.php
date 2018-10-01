<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupFormStep3 */
/* @var $dealerCentersArr */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';

?>
    <div class = "registration site-signup-step-3">
        <?= $this->render('_top-line-signup', [
            'title' => $this->title,
            'imageName' => 'step_3.svg',

        ]) ?>

        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form_step_1']]); ?>

        <?= $form->field($model, 'surname')->textInput(['class' => 'user', 'autofocus' => true, 'placeholder' => 'Фамилия'])->label(false) ?>

        <?= $form->field($model, 'first_name')->textInput(['class' => 'user', 'placeholder' => 'Имя'])->label(false) ?>

        <?= $form->field($model, 'last_name')->textInput(['class' => 'user', 'placeholder' => 'Отчество'])->label(false) ?>

        <?= $form->field($model, 'dealer_center_id')->dropDownList($dealerCentersArr, [ 'class' => 'user', 'prompt' => 'Диллерский центр', ])->label(false) ?>


        <p>
            <span>*</span> Пожалуйста убедитесь в правильности заполненных данных, воизбежание ошибок
        </p>

        <div class="button_next_back">
            <?= Html::a('<img src = "/public/images/left-arrow.svg">Назад', '/site/signup-step-2', ['class' => 'button_back'] ) ?>
            <?= Html::submitButton('Завершить', ['class' => 'button_next', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div> <!-- -->
