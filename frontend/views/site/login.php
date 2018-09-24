<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper">
    <div class="index">
        <header class="header">
            <img src = "/public/images/logo.svg" alt = "mersedes-benz" class = "logo_index">
        </header><!-- .header-->
        <main class="content index_margin">

            <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'form', 'autocomplete' => 'off']]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Введите логин', 'class' => 'user'])->label(false) ?>

            <?= $form->field($model, 'password')->passwordInput(['class' => 'password', 'placeholder' => 'Введите пароль'])->label(false) ?>

            <?= Html::submitButton('Отправить', ['class' => 'submit', 'name' => 'login-button']) ?>

            <?= Html::a('Регистрация', '/site/signup-step-1') ?>

            <?php ActiveForm::end(); ?>

        </main><!-- .content -->
        <footer id="personalDataOpen" class="footer index_margin">
            Регистрируясь на сайте вы автоматически даёте согласие на обработку своих персональных данных
        </footer><!-- .footer -->

        <div class = "personal_data">
            <p>
                What is Pexels?
                <br><br>
                Pexels helps designers, bloggers and everyone who is looking for an image to find great photos that you can use everywhere for free.
                <br><br>
                What is the license of the photos on Pexels?
                <br><br>
                All photos uploaded on Pexels are licensed under the Pexels license. This means you can use them for free for personal and commercial purposes. For more information read the following questions, our license page or our Terms of Service.
                <br><br>
                Can I use the photos for a commercial project?
                <br><br>
                Yes, all photos are free for commercial use. You can use them on your commercial website, blog, product or anywhere else. Please note that depicted content in the photos like trademarks, logos or brands may still be protected by e.g. privacy, copyright or trademark rights and you shouldn't imply that the depicted person, brand, trademark or copyright holder of the depicted work is endorsing or taking part in your product or service. For such uses cases you may need the permission or consent of the depicted third parties.
                <br>Can I sell Pexels photos?
                <button id="personalDataClose" class="submit">Ок</button>
            </p>
        </div> <!-- -->

    </div> <!--Главный-->
</div>
