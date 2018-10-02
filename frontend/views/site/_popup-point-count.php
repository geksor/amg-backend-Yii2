<?php

/* @var $this yii\web\View */
/* @var $point */
/* @var $truAnswers array */

?>

<div class="popupWrap">
    <div class="popup">
        <img src = "/public/images/cup_2.svg" class = "popup_cup">
        <p class = "popup_heppy">Поздравляем! Вы набрали:</p>
        <p class = "popup_ball"><?= $point ?><br><span>баллов</span></p>
        <? if ($truAnswers !== null) {?>
            <p class = "popup_heppy">Правильных ответов <?= $truAnswers['true'] ?> из <?= $truAnswers['total'] ?></p>
        <?}?>
        <a id="pointsOk" class="submit">ОК</a>
    </div>
</div>

