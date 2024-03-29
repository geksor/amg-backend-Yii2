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

$this->title = 'MyNT2018 Mix статика';

?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Mix статика',
        'link' => Yii::$app->homeUrl,
   ]) ?>
    <div class="x-class_content">
        <? foreach ($models as $model) {?>
            <? $viewed = false; ?>
            <? if (!empty($model->users)) {
                foreach ($model->users as $user){
                    if ($user->id == Yii::$app->user->id && $user->isMixStaticViewed($model->id)){
                        $viewed = true;
                        break;
                    }
                }
            }?>
            <a href="<?= $viewed ? '#' : \yii\helpers\Url::to(['site/mix-static-gallery', 'id' => $model->id]) ?>"
                class="mix__link <?= $viewed ? 'viewed' : '' ?>" style="color: #000000; text-decoration: none; text-align: center">
                <img src = "<?= $model->getThumbPhoto() ?>" alt="<?= $model->title ?>" class = "mix_img">
                <?= $model->title ?>
            </a>
        <?}?>
    </div>
    <?= $this->render('_footer') ?>
</div>


