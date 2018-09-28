<?php

/* @var $this yii\web\View */
/* @var $title */
/* @var $link */

?>

<div class = "step_1">
    <div class = "back fullLinkWrap">
        <? if ($link) {?>
            <?= \yii\helpers\Html::a('', $link, ['class' => 'fullLink']) ?>
            <img src = "/public/images/back.svg" alt = "назад">
        <?}?>
        <p><?= $title ?></p>
    </div>
</div>

