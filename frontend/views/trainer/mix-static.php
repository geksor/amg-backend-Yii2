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

<div class="info info_trenr_group_viktorina">
    <?= $this->render('_top-line', [
        'title' => 'Mix статика',
        'link' => '/trainer/index',
    ]) ?>

    <? foreach ($models as $model) {?>
        <div class="x-class_content">
            <div class = "trenr_group_opros">
                <div class = "trenr_group_opros_name linkWrap">
                    <h2><?= $model->title ?></h2>
                    <?= \yii\helpers\Html::img($model->getThumbPhoto()) ?>
                    <?= \yii\helpers\Html::a('', ['/trainer/mix-static-gallery', 'id' => $model->id]) ?>
                </div>
                <?
                    $mixStaticUsers = $model->mixStaticUsers;
                    $usersArr = \yii\helpers\ArrayHelper::toArray($mixStaticUsers);
                    $userCount = count($usersArr);
                ?>
                <div class = "trenr_group_opros_progres">
                    <ul class="ul_bal_12">
                        <li class ="item_1"></li>
                        <li class ="item_2"></li>
                        <li class ="item_3"></li>
                        <li class ="item_4"></li>
                        <li class ="item_5"></li>
                        <li class ="item_6"></li>
                        <li class ="item_7"></li>
                        <li class ="item_8"></li>
                        <li class ="item_9"></li>
                        <li class ="item_10"></li>
                        <li class ="item_11"></li>
                        <li class ="item_12"></li>
                    </ul>
                    <ul class="ul_bal_12">
                        <li class ="item_13"></li>
                        <li class ="item_14"></li>
                        <li class ="item_15"></li>
                        <li class="item_16 "></li>
                        <li class="item_17 "></li>
                        <li class="item_18 "></li>
                        <li class="item_19 "></li>
                        <li class="item_20 "></li>
                        <li class="item_21 "></li>
                        <li class="item_22 "></li>
                        <li class="item_23 "></li>
                        <li class="item_24 "></li>
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
        var userCount = <?= $userCount ?>;

        for (var item = 1; item <= userCount; item++) {
            $('.item_' + item).addClass('active');
        }
    }
</script>


