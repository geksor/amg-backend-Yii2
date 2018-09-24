<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';

?>
    <div class = "registration site-signup-step-1">
        <?= $this->render('_top-line-signup', [
            'title' => $this->title,
            'imageName' => 'step_1.svg',

        ]) ?>
        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form_step_1']]); ?>

        <?= $form->field($model, 'email')->input('email', ['class' => 'user', 'autofocus' => true, 'placeholder' => 'Введите E-mail'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['class' => 'password', 'placeholder' => 'Введите пароль'])->label(false) ?>

        <?= $form->field($model, 'conformPassword')->passwordInput(['class' => 'password', 'placeholder' => 'Повторите пароль'])->label(false) ?>

        <p>
            <span>*</span> Внимательно проверяйте свои данные, на данный e-mail придёт ваш логин и пароль
            <br><br>
            <span>*</span> Пароль должен содержать не менее 6 символов, включая цифры и буквы английского алфавита
        </p>

        <div class="button_next_back">
            <?= Html::a('<img src = "/public/images/left-arrow.svg">Назад', '/', ['class' => 'button_back'] ) ?>
            <?= Html::submitButton('Далее<img src = "/public/images/right-arrow.svg">', ['class' => 'button_next', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div> <!-- -->
