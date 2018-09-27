<?php
/* @var $this yii\web\View */


?>

<div class = "home_footer">
    <div class = "forum_block_1 footerLinkWrap">
        <?= \yii\helpers\Html::a('', '/site/timetable') ?>
        <img src = "/public/images/clock.svg" class = "block_3_img" alt = "настройки">
    </div>
    <div class = "forum_block_1 footer_block_2 footerLinkWrap">
        <?= \yii\helpers\Html::a('', '/site/info') ?>
        <img src = "/public/images/settings.svg" class = "block_3_img" alt = "информация">
    </div>
    <div id="send" class = "forum_block_3">
        <img src = "/public/images/conversation.svg" class = "block_3_img" alt = "чат">
        <p>Отправить</p>
    </div>
</div>