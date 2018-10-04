<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

/* @var $this yii\web\View */
/* @var $model \common\models\MbuxTest */

$this->title = 'ABS Авто MBUX теория и практика';
?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'MBUX теория и практика',
        'link' => Yii::$app->homeUrl,
   ]) ?>
    <div class="x-class_content">
        <div class="mbux_slick">
            <? foreach ($model->mbuxQuestions as $key => $question) {?>
                <div class="mbux__slide">
                    <img src = "<?= $question->getPhotos()['image_1'] ?>" class = "mix_img">
                    <p class = "mix_ul_p"><?= $question->title ?></p>
                    <div id="help_<?= $key ?>" style="display: none">
                            <?= $question->description ?>
                    </div>
                </div>
            <?}?>
        </div>
        <div class="dotsAppend"></div>
    </div>
    <div class="button_next_back">
        <a class="button_help mbux__helpShow">Подсказка</a>
        <a class="button_next mbux__next">Далее<img src="/public/images/right-arrow.svg"></a>
        <?= \yii\helpers\Html::a('Завершить',
            ['/site/mbux'],
            [
                'class' => 'button_next mbux__end',
                'style' => 'display:none',
                'data-method' => 'POST',
                'data-params' => [
                    'userId' => Yii::$app->user->id,
                    'end' => true,
                ]
            ]) ?>
    </div>

    <?= $this->render('_footer') ?>
</div>
<div class="popupWrap mbux__help" style="display: none; z-index: 100">
    <div class="popup">
        <p id="insertText" class = "popup_heppy">
            <? foreach ($model->mbuxQuestions as $key => $question) {?>
                <? if ($key === 0) {
                    echo $question->description;
                }else{
                    break;
                }?>
            <?}?>
        </p>
        <a class="submit mbux__helpHide">Закрыть</a>
    </div>
</div>




