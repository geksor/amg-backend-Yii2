<?php
/* @var $this yii\web\View */
/* @var $userModel \common\models\User */

?>
<div class = "home_footer_fixed">
</div>

<div class = "home_footer">
    <textarea id="sendMessage" name="text" class = "textarea" placeholder = "Написать сообщение.."

           data-name="<?= $userModel->surname . ' ' . $userModel->first_name . ' ' . $userModel->last_name ?>"

           data-id="<?= $userModel->id ?>"
    ></textarea>
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
