<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $models \common\models\PhotoReport */

$this->title = 'MyNT2018 Фотоотчеты';
?>

<div class = "info info_trenr_group_viktorina">
    <div class="photoReportInner">
        <? if (!Yii::$app->user->isGuest) {?>
            <?= $this->render('_top-line', [
                'title' => 'Назад',
                'link' => '/',
            ]) ?>
        <?}?>
        <h1 class="photoReport__h">Фотоотчеты</h1>
        <div class = "flex_1">
            <div class = "trenr_groups photoReport__groups">
                <? foreach ($models as $model) {?>
                    <?$images = $model->getBehavior('galleryBehavior')->getImages();?>
                    <? if (!empty($images)) {?>
                        <div class="gallery__item">
                            <div class = "linkWrap gallery__imageWrap">
                                <?/* @var $model \common\models\PhotoReport */
                                /* @var $images \common\models\PhotoReportGallery */

                                foreach ($images as $image) {
                                    /* @var $image \common\models\PhotoReportGallery */
                                    echo Html::img($image->getUrl('medium'), ['class' => 'gallery__image', 'alt' => $image->name]);
                                    break;
                                }?>

                                <?= Html::a('', ['report', 'id' => $model->id]);?>
                            </div>
                            <p class="gallery__userName"><?= $model->title ?></p>
                        </div>
                    <?}?>
                <?}?>
            </div>
        </div>
    </div>
</div> <!-- -->


