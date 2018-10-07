<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $commandModels \common\models\Command */
/* @var $isRunDrive bool */

$this->title = 'MyNT2018 X-Класс Тест-Драйв';
?>

<div class = "info info_trenr_group_viktorina">
    <?= $this->render('_top-line', [
        'title' => 'X-Класс Тест-Драйв',
        'link' => '/trainer/index',
    ]) ?>

    <div class = "flex_1">
        <div class = "trenr_groups">
            <? foreach ($commandModels as $key => $commandModel) {?>
                <?
                /* @var $commandModel \common\models\Command */
                /* @var $captain \common\models\User */
                $captain = $commandModel->captain;
                $captaineName = $captain->surname . ' ' . $captain->first_name . ' ' . $captain->last_name;
                ?>
                <div class = "gallery__item">
                    <div class = "linkWrap gallery__imageWrap">
                        <? if ($captain->endQuests->xClassDrive) {?>
                            <img src="<?= $commandModel->getPhoto() ?>" class="gallery__image" alt="<?= $captaineName ?>">
                        <?
                            echo Html::a('', $commandModel->getPhoto(), ['data-fancybox' => 'gallery', 'data-caption' => $captaineName]);
                        }else{?>
                            <img src="/public/images/noimage.svg" class="gallery__image" alt="<?= $captaineName ?>">
                        <?}?>
                    </div>
                    <p class="gallery__userName"><?= $captaineName . '<br> группа ' . $captain->group ?></p>
                </div>
            <?}?>
            <? if (!$isRunDrive) {?>
                <?= \yii\helpers\Html::a('Активировать', '/trainer/run-xclass-drive', ['class' => 'submit', 'style' => 'background-color: #00675f;']) ?>
            <?}?>

        </div>
    </div>

    <?= $this->render('_footer') ?>
</div> <!-- -->


