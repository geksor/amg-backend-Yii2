<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\MixStatic */
/* @var $images \common\models\GalleryImage */
/* @var $step */

$this->title = 'ABS Авто Mix статика';

$imageId = Yii::$app->session->get('images')[$step]['id'];

?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Mix статика',
        'link' => Yii::$app->request->referrer,
   ]) ?>
    <div class="x-class_content">
        <? foreach ($images as $image) {?>
            <? if ($image->id === $imageId) {?>
                <div class="mix__imageWrap">
                    <?= \yii\helpers\Html::img($image->getUrl('small'), ['alt' => $image->name, 'class' => 'mix__imageAbsolute']); ?>
                </div>
            <?}?>
        <?}?>

        <ul class = "mix_ul">
            <? foreach ($images as $key => $image) {?>
                <li class = "<?= $key == $step ? 'active' : '' ?>"></li>
            <?}?>
        </ul>
        <?php $form = ActiveForm::begin(); ?>
        <div class = "mix_star">
            <?= \kartik\rating\StarRating::widget([
                'name' => 'star_1',
                'pluginOptions' => [
                    'theme' => 'krajee-svg',
                    'filledStar' => '<span class="krajee-icon mix_star_img"></span>',
                    'emptyStar' => '<span class="krajee-icon mix_star_img_empty"></span>',
                    'stars' => 5,
                    'min' => 0,
                    'max' => 5,
                    'step' => 1,
                    'showClear' => false,
                    'showCaption' => false,
                    'starCaptions' => [
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                    ],
                ]
            ]) ?>
        </div>
    </div>

    <?= \yii\helpers\Html::a('Далее', ['/site/mix-static-gallery', 'id' => $model->id, 'step' => ++$step, 'imageId' => $imageId], ['class' => 'submit', 'id' => 'mix_static_link']) ?>

    <?php ActiveForm::end(); ?>

    <?= $this->render('_footer') ?>
</div>


