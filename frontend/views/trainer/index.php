<?php

/* @var $this yii\web\View */
/* @var $userModel \common\models\User */
/* @var $place \common\models\User */
/* @var $totalCount \frontend\controllers\SiteController */

$this->title = 'ABS Авто раздел тренера главная';
?>
<div class = "home">
    <div class = "home_head home_head_test">
        <div class = "block_3 block_3_mersedes">
            <img src = "/public/images/mersedes_logo.svg" class = "block_3_mersedes" alt = "mersedes">
            <p>Список тренингов</p>
        </div>
        <div class = "block_3 block_3_mersedes">
            <p>Дата тренинга: <?= date("d.m.Y", (integer) $userModel->training->date) ?> </p>
        </div>
        <div class = "block_3 block_3_mersedes">
            <p>Группа: <?= $userModel->group ?> </p>
        </div>
    </div>
    <div class = "home_content test_trener">
        <div data-value="<?= $userModel->xClassDrive ?>" class="test test_1">
            <?= \yii\helpers\Html::a('', '/trainer/xclass-drive') ?>
            <h3><?= $userModel->getAttributeLabel('xClassDrive') ?></h3>
        </div>

        <div data-value="<?= $userModel->mixStatic ?>" class="test test_2">
            <?= \yii\helpers\Html::a('', '/trainer/mix-static') ?>
            <h3><?= $userModel->getAttributeLabel('mixStatic') ?></h3>
        </div>

        <div data-value="<?= $userModel->amgStatic ?>" class="test test_3">
            <?= \yii\helpers\Html::a('', '/trainer/amg-static') ?>
            <h3><?= $userModel->getAttributeLabel('amgStatic') ?></h3>
        </div>

        <div data-value="<?= $userModel->mbux ?>" class="test test_4">
            <?= \yii\helpers\Html::a('', '/trainer/mbux') ?>
            <h3><?= $userModel->getAttributeLabel('mbux') ?></h3>
        </div>

        <div data-value="<?= $userModel->amgDrive ?>" class="test test_5">
            <?= \yii\helpers\Html::a('', '/trainer/amg-drive') ?>
            <h3><?= $userModel->getAttributeLabel('amgDrive') ?></h3>
        </div>

        <div data-value="<?= $userModel->mixDrive ?>" class="test test_6">
            <?= \yii\helpers\Html::a('', '/trainer/mix-drive') ?>
            <h3><?= $userModel->getAttributeLabel('mixDrive') ?></h3>
        </div>

        <div data-value="<?= $userModel->xClassLine ?>" class="test test_7">
            <?= \yii\helpers\Html::a('', '/trainer/x-class-line') ?>
            <h3><?= $userModel->getAttributeLabel('xClassLine') ?></h3>
        </div>

        <div class = "test test_8">
                <?= \yii\helpers\Html::a('', '/trainer/quiz') ?>
            <h3>Викторина</h3>
        </div>
        <div class = "test test_9">
                <?= \yii\helpers\Html::a('', '/trainer/intelligent') ?>
            <h3>Intelligent Drive</h3>
        </div>
    </div>
    <?= $this->render('_footer') ?>
</div>

