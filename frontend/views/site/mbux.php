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
            <? foreach ($model->mbuxQuestions as $question) {?>
                <div class="mbux__slide">
                    <img src = "<?= $question->getPhotos()['image_1'] ?>" class = "mix_img">
                    <p class = "mix_ul_p"><?= $question->title ?></p>
                    <p class="mbux__help" style="display: none"><?= $question->description ?></p>
                </div>
            <?}?>
        </div>
        <div class="dotsAppend"></div>
    </div>
    <div class="button_next_back">
        <a class="button_help mbux__helpShow">Подсказка</a>
        <a class="button_next">Далее<img src="/public/images/right-arrow.svg"></a>
    </div>

    <?= $this->render('_footer') ?>
</div>


