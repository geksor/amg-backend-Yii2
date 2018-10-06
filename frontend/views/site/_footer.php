<?php
/* @var $this yii\web\View */


?>
<div class = "home_footer_fixed">
</div>
<div class = "home_footer site-footer">
    <div class = "footer_block_1 footerLinkWrap">
        <?= \yii\helpers\Html::a('', '/site/timetable') ?>
        <img src = "/public/images/clock.svg" class = "block_3_img" alt = "настройки">
        <p>Расписание</p>
    </div>
    <div class = "footer_block_1 footer_block_2 footerLinkWrap">
        <?= \yii\helpers\Html::a('', '/site/info') ?>
        <img src = "/public/images/settings.svg" class = "block_3_img" alt = "информация">
        <p>Информация</p>
    </div>
    <div class = "footer_block_3 footerLinkWrap">
        <?= \yii\helpers\Html::a('', '/chat/index') ?>
        <img src = "/public/images/conversation.svg" class = "block_3_img" alt = "чат">
    </div>
</div>