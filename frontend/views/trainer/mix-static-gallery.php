<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $images \common\models\GalleryImage */

$this->title = 'MyNT2018 Mix статика';

function floor_to($number, $increments) {
    $increments = 1 / $increments;
    return (floor($number * $increments) / $increments);
}

?>

<div class="info info_trenr_group_viktorina">
    <?= $this->render('_top-line', [
        'title' => 'Mix статика',
        'link' => Yii::$app->request->referrer,
   ]) ?>

    <div class="x-class_content trenr_group_opros_in">
        <? foreach ($images as $key => $image) {?>
            <?/* @var $image \common\models\GalleryImage */?>
            <div class = "trenr_group_opros">
                <div class = "trenr_group_opros_star">
                    <h2><?= $image->name ?></h2>
                    <?
                    $rating = $image->rating ? $image->rating : 0;
                    $voteCount = $image->voteCount ? $image->voteCount : 1;
                    $starValue = floor_to($rating / $voteCount, 0.5)
                    ?>
                    <?= \kartik\rating\StarRating::widget([
                        'name' => 'star_'.$key,
                        'value' => $starValue,
                        'pluginOptions' => [
                            'theme' => 'krajee-svg',
                            'filledStar' => '<span class="krajee-icon mix_star_img trainer"></span>',
                            'emptyStar' => '<span class="krajee-icon mix_star_img_empty trainer"></span>',
                            'readonly' => true,
                            'showClear' => false,
                            'showCaption' => false,
                        ]
                    ]) ?>
                </div>
            </div>
        <?}?>
    </div>

    <?= $this->render('_footer') ?>
</div>


