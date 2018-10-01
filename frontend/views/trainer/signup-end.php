<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupFormStep3 */
/* @var $dealerCentersArr */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';

?>
<div class = "registration mail_send site-signup-end">
    <div class = "mail_send_in">
        <img src = "/public/images/mail_send.svg">
        <p>
            Спасибо за регистрацию!<br>
            Пожалуйста проверте свою почту
        </p>
        <?= Html::a('OK', '/', ['class' => 'mail_send_bottom']) ?>
    </div>
</div> <!-- -->

