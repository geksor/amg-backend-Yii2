<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $images \common\models\PhotoReportGallery*/
/* @var $model \common\models\PhotoReport */

$this->title = "MyNT2018 $model->title";
?>

<div class = "info info_trenr_group_viktorina">
    <div class="photoReportInner">
            <?= $this->render('_top-line', [
                'title' => 'Назад',
                'link' => Yii::$app->request->referrer,
            ]) ?>
        <div class = "trenr_groups photoReport__groups">
            <h1 class="photoReport__h"><?= $model->title ?></h1>

            <? if ($model->video != null && $model->isVideoLoad) {?>
                <div class="photoReport__videoWrap">
                    <video controls width="400" height="auto" poster="<?= $model->getVideo() ?>.gif" preload="none">
                        <source src="<?= $model->getVideo() ?>.mp4" type="video/mp4">
                        <source src="<?= $model->getVideo() ?>.webm" type="video/webm">
                    </video>
                </div>
            <?}?>
        </div>

        <div class = "flex_1">
            <div class = "trenr_groups photoReport__groups">
                <? foreach ($images as $image) {?>
                    <div class="gallery__item">
                        <div class = "linkWrap gallery__imageWrap">
                            <?/* @var $image \common\models\PhotoReportGallery */?>

                            <img src="<?= $image->getUrl('preview') ?>" class="gallery__image" alt="<?= $image->name ?>">
                            <?= Html::a('', $image->getUrl('original'), ['data-fancybox' => 'gallery', 'data-caption' => $image->name]);?>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</div> <!-- -->


