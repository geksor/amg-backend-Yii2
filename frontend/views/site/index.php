<?php

/* @var $this yii\web\View */
/* @var $userModel \common\models\User */
/* @var $totalCount \frontend\controllers\SiteController */

$this->title = 'ABS Авто главная';
?>
<div class = "home">
    <div class = "home_head">
        <div class = "block_3 block_3_mersedes">
            <img src = "/public/images/mersedes_logo.svg" class = "block_3_mersedes" alt = "mersedes">
        </div>
        <div class = "block_3">
            <img src = "/public/images/cup.svg" class = "block_3_img" alt = "кубок">
            <p><?= $totalCount ?></p>
        </div>
        <div class = "block_3 block_3_mesto">
            <img src = "/public/images/podium.svg" class = "block_3_img" alt = "место">
            <p>3</p>
        </div>
    </div>
    <div class = "home_content">
        <div data-value="<?= $userModel->xClassDrive ?>" data-max="<?= Yii::$app->params['PointTest']['amgDrive'] ?>" class="progressBar test test_1">
            <?= \yii\helpers\Html::a('', '/site/x-class-drive') ?>
            <h3><?= $userModel->getAttributeLabel('xClassDrive') ?></h3>
            <p><?= $userModel->xClassDrive ?> / <?= Yii::$app->params['PointTest']['amgDrive'] ?></p>
        </div>
        <div data-value="<?= $userModel->mixStatic ?>" data-max="<?= Yii::$app->params['PointTest']['mixStatic'] ?>" class="progressBar test test_2">
            <? if (!Yii::$app->session->has('mixStatic')) {?>
                <?= \yii\helpers\Html::a('', '/site/mix-static') ?>
            <?}?>
            <h3><?= $userModel->getAttributeLabel('mixStatic') ?></h3>
            <p><?= $userModel->mixStatic ?> / <?= Yii::$app->params['PointTest']['mixStatic'] ?></p>
        </div>
        <div data-value="<?= $userModel->amgStatic ?>" data-max="<?= Yii::$app->params['PointTest']['amgStatic'] ?>" class="progressBar test test_3">
            <?= \yii\helpers\Html::a('', '/site/amg-static') ?>
            <h3><?= $userModel->getAttributeLabel('amgStatic') ?></h3>
            <p><?= $userModel->amgStatic ?> / <?= Yii::$app->params['PointTest']['amgStatic'] ?></p>
        </div>
        <div data-value="<?= $userModel->mbux ?>" data-max="<?= Yii::$app->params['PointTest']['mbux'] ?>" class="progressBar test test_4">
            <?= \yii\helpers\Html::a('', '/site/mbux') ?>
            <h3><?= $userModel->getAttributeLabel('mbux') ?></h3>
            <p><?= $userModel->mbux ?> / <?= Yii::$app->params['PointTest']['mbux'] ?></p>
        </div>
        <div data-value="<?= $userModel->amgDrive ?>" data-max="<?= Yii::$app->params['PointTest']['amgDrive'] ?>" class="progressBar test test_5">
            <?= \yii\helpers\Html::a('', '/site/amg-drive') ?>
            <h3><?= $userModel->getAttributeLabel('amgDrive') ?></h3>
            <p><?= $userModel->amgDrive ?> / <?= Yii::$app->params['PointTest']['amgDrive'] ?></p>
        </div>
        <div data-value="<?= $userModel->mixDrive ?>" data-max="<?= Yii::$app->params['PointTest']['mixDrive'] ?>" class="progressBar test test_6">
            <?= \yii\helpers\Html::a('', '/site/mix-drive') ?>
            <h3><?= $userModel->getAttributeLabel('mixDrive') ?></h3>
            <p><?= $userModel->mixDrive ?> / <?= Yii::$app->params['PointTest']['mixDrive'] ?></p>
        </div>
        <div data-value="<?= $userModel->xClassLine ?>" data-max="<?= Yii::$app->params['PointTest']['xClassLine'] ?>" class="progressBar test test_7">
            <?= \yii\helpers\Html::a('', '/site/x-class-line') ?>
            <h3><?= $userModel->getAttributeLabel('xClassLine') ?></h3>
            <p><?= $userModel->xClassLine ?> / <?= Yii::$app->params['PointTest']['xClassLine'] ?></p>
        </div>
        <div class = "test test_8">
            <?= \yii\helpers\Html::a('', '/site/quiz') ?>
            <h3>Викторина</h3>
        </div>
    </div>
    <?= $this->render('_footer') ?>
</div>
<? if (Yii::$app->session->hasFlash('popupEndTest')) {?>

        <?= $this->render('_popup-point-count', [
            'point' => Yii::$app->session->getFlash('popupEndTest')['point'],
            'truAnswers' => false,
        ]);?>

<?}?>
