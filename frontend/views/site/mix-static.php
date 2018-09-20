<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

/* @var $this yii\web\View */
/* @var $models \common\models\MixStatic */
/* @var $model \common\models\MixStatic */

$this->title = 'ABS Авто Mix статика';

?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Mix статика',
        'link' => Yii::$app->homeUrl,
   ]) ?>
    <div class="x-class_content">
        <? foreach ($models as $model) {?>
            <? if (!$model->users) {?>
                <a href="<?= \yii\helpers\Url::to(['site/mix-static-gallery', 'id' => $model->id]) ?>">
                    <img src = "<?= $model->getThumbPhoto() ?>" alt="<?= $model->title ?>" class = "mix_img">
                </a>
            <?}?>
        <?}?>
    </div>
    <?= $this->render('_footer') ?>
</div>


