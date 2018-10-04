<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="popupWrap">
    <div class="popup">
        <p class = "popup_ball"><?= Html::encode($this->title) ?></p>

        <p class = "popup_heppy"><?= nl2br(Html::encode($message)) ?></p>
        <a href="/" class="submit">ОК</a>
    </div>
</div>
