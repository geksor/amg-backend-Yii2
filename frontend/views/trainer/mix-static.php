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

<div class="info info_trenr_group_viktorina">
    <?= $this->render('_top-line', [
        'title' => 'Mix статика',
        'link' => '/trainer/index',
    ]) ?>

    <? foreach ($models as $model) {?>
        <div id="gallery_<?= $model->id ?>" class="x-class_content">
            <div class = "trenr_group_opros">
                <div class = "trenr_group_opros_name linkWrap">
                    <h2><?= $model->title ?></h2>
                    <?= \yii\helpers\Html::img($model->getThumbPhoto()) ?>
                    <?= \yii\helpers\Html::a('', ['/trainer/mix-static-gallery', 'id' => $model->id]) ?>
                </div>
                <?
                    $users = $model->users;
                    $usersArr = \yii\helpers\ArrayHelper::toArray($users);
                    $userCount = count($usersArr);
                ?>
                <div class = "trenr_group_opros_progres">
                    <ul class="ul_bal_12">
                        <? for ($item = 1; $item<=12; $item++) {?>
                            <li class ="item_<?=$item?> <?= $item <= $userCount ? 'active' : '' ?>"></li>
                        <?}?>
                    </ul>
                    <ul class="ul_bal_12">
                        <? for ($item = 13; $item<=24; $item++) {?>
                            <li class ="item_<?=$item?> <?= $item <= $userCount ? 'active' : '' ?>"></li>
                        <?}?>
                    </ul>
                </div>
                <p><?= $userCount ?>/24</p>
            </div>
        </div>
    <?}?>

    <?= $this->render('_footer') ?>
</div>

<script>
    window.onload = function () {

    }
</script>


