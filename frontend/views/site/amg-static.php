<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

/* @var $this yii\web\View */
/* @var $questionModel \common\models\AmgStaticQuestion */

$this->title = 'ABS Авто Amg статика';
?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Amg статика',
        'link' => Yii::$app->homeUrl,
   ]) ?>
    <div class="x-class_content">
        <div class="amg_static_slick">

            <? $photoArr = $questionModel->getPhotos(); ?>


            <div>
                <div id="droppable_1" data-image="1" class="amg__questImage" style = 'background-image: url(<?= $photoArr['thumb_image_1'] ?>)'></div>
            </div>

            <div>
                <div id="droppable_2" data-image="2" class="amg__questImage" style = 'background-image: url(<?= $photoArr['thumb_image_2'] ?>)'></div>
            </div>

            <div>
                <div id="droppable_3" data-image="3" class="amg__questImage" style = 'background-image: url(<?= $photoArr['thumb_image_3'] ?>)'></div>
            </div>

        </div>
        <div class = "dotsAppend"></div>

        <div id="lobby" class = "mix_amg">
            <? foreach ($questionModel->amgStaticAnswers as $key => $answer) {?>
                <div class="amg__answer color_<?= $key ?>" data-set_color="color_<?= $key ?>" data-answer_id="<?= $answer->id ?>"><?= $answer->title ?></div>
            <?}?>
        </div>
    </div>
    <?= \yii\helpers\Html::a('Далее',
        [
            '/site/amg-static',
            'questId' => $questionModel->id,

        ],
        ['class' => 'submit mix__noStars', 'id' => 'amg_static_link']) ?>

    <?= $this->render('_footer') ?>
</div>


