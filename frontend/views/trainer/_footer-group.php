<?php
/* @var $this yii\web\View */


?>

<div class = "home_footer home_footer_trener">
    <div class = "footer_block_1 footerLinkWrap">
        <?= \yii\helpers\Html::a('', '/trainer/timetable') ?>
        <img src = "/public/images/clock.svg" class = "block_3_img" alt = "настройки">
        <p>Расписание</p>
    </div>
    <div id="groupSelect_1" class = "footer_block_1">
        <img src = "/public/images/nav-bar.svg" class = "block_3_img" alt = "настройки">
        <p>Группа 1</p>
    </div>
    <div id="groupSelect_2" class = "footer_block_1 footer_block_4">
        <img src = "/public/images/nav-bar.svg" class = "block_3_img" alt = "информация">
        <p>Группа 2</p>
    </div>

    <div class = "footer_block_3 footerLinkWrap">
        <?= \yii\helpers\Html::a('', '/chat/index') ?>
        <img src = "/public/images/conversation.svg" class = "block_3_img" alt = "чат">
    </div>
</div>
