<?php

/* @var $this yii\web\View */
/* @var $point */
/* @var $truAnswers array */

?>

<div id="captainOk" class="popupWrap" style="display: none">
    <div class="popup">
        <img src = "/public/images/capitan_ok.svg" class = "popup_img">
        <p class = "popup_p">ПОЗДРАВЛЯЕМ!<br>ВЫ СТАЛИ КАПИТАНОМ</p>

        <?= \yii\helpers\Html::a('Перейти к просмотру команды', '/xclass-drive/captain-command', ['class' => 'submit']) ?>
    </div>
</div>

<div id="captainNone" class="popupWrap" style="display: none">
    <div class="popup">
        <img src = "/public/images/capitan_no.png" class = "popup_img">
        <p class = "popup_p">Вы не стали капитаном,<br>но у Вас есть возможность вступить<br>в одну из 6 команд</p>

        <?= \yii\helpers\Html::a('Перейти к выбору команды', '/xclass-drive/select-command', ['class' => 'submit']) ?>
    </div>
</div>

<div id="commandSet" class="popupWrap" style="display: none">
    <div class="popup">
        <img src = "/public/images/capitan_ok.svg" class = "popup_img">
        <p class = "popup_p">Вы присоединились к команде!<br>дальнейшее прохождение теста<br>через устройство капитана</p>

        <?= \yii\helpers\Html::a('ОК', '/xclass-drive/captain-command', ['class' => 'submit']) ?>
    </div>
</div>


<div id="commandNoSet" class="popupWrap" style="display: none">
    <div class="popup">
        <img src = "/public/images/capitan_no.png" class = "popup_img">
        <p class = "popup_p">Вы не вступить в команду,<br>но у Вас есть возможность вступить<br>в другую</p>

        <?= \yii\helpers\Html::a('Перейти к выбору команды', '/xclass-drive/select-command', ['class' => 'submit']) ?>
    </div>
</div>


