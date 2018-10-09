<?php

/* @var $this yii\web\View */
/* @var $userModel \common\models\User */
/* @var $place \common\models\User */
/* @var $totalCount \frontend\controllers\SiteController */
/* @var $isRunDrive bool */
/* @var $totalQuestion integer */

$this->title = 'MyNT2018 главная';
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
            <p>&nbsp;<?= $place ?></p>
        </div>
    </div>
    <div class = "home_content">
        <div data-value="<?= $userModel->xClassDrive ?>" data-max="<?= (integer)Yii::$app->params['PointTest']['amgDrive']/4 ?>" class="progressBar test test_1">
            <? if (!$userModel->endQuests->xClassDrive && $isRunDrive ) {?>
                <?= \yii\helpers\Html::a('', '/xclass-drive/index') ?>
            <?}?>
            <h3><?= $userModel->getAttributeLabel('xClassDrive') ?></h3>
            <p><?= $userModel->xClassDrive ?> / <?= (integer)Yii::$app->params['PointTest']['amgDrive']/4 ?></p>
        </div>

        <div data-value="<?= $userModel->mixStatic ?>" data-max="<?= Yii::$app->params['PointTest']['mixStatic'] ?>" class="progressBar test test_2">
            <? if (!$userModel->endQuests->mixStatic) {?>
                <?= \yii\helpers\Html::a('', '/site/mix-static') ?>
            <?}?>
            <h3><?= $userModel->getAttributeLabel('mixStatic') ?></h3>
            <p><?= $userModel->mixStatic ?> / <?= Yii::$app->params['PointTest']['mixStatic'] ?></p>
        </div>

        <div data-value="<?= $userModel->amgStatic ?>" data-max="<?= Yii::$app->params['PointTest']['amgStatic'] ?>" class="progressBar test test_3">
            <? if (!$userModel->endQuests->amgStatic) {?>
                <?= \yii\helpers\Html::a('', '/site/amg-static') ?>
            <?}?>
            <h3><?= $userModel->getAttributeLabel('amgStatic') ?></h3>
            <p><?= $userModel->amgStatic ?> / <?= Yii::$app->params['PointTest']['amgStatic'] ?></p>
        </div>

        <div data-value="<?= $userModel->mbux ?>" data-max="<?= Yii::$app->params['PointTest']['mbux'] ?>" class="progressBar test test_4">
            <? if (!$userModel->endQuests->mbux) {?>
                <?= \yii\helpers\Html::a('', '/site/mbux') ?>
            <?}?>
            <h3><?= $userModel->getAttributeLabel('mbux') ?></h3>
            <p><?= $userModel->mbux ?> / <?= Yii::$app->params['PointTest']['mbux'] ?></p>
        </div>

        <div data-value="<?= $userModel->amgDrive ?>" data-max="<?= Yii::$app->params['PointTest']['amgDrive'] ?>" class="progressBar test test_5">
            <? if (!$userModel->endQuests->amgDrive) {?>
                <?= \yii\helpers\Html::a('', '/site/amg-drive') ?>
            <?}?>
            <h3><?= $userModel->getAttributeLabel('amgDrive') ?></h3>
            <p><?= $userModel->amgDrive ?> / <?= Yii::$app->params['PointTest']['amgDrive'] ?></p>
        </div>

        <div data-value="<?= $userModel->mixDrive ?>" data-max="<?= Yii::$app->params['PointTest']['mixDrive'] ?>" class="progressBar test test_6">
            <? if (!$userModel->endQuests->mixDrive) {?>
                <?= \yii\helpers\Html::a('', '/site/mix-drive') ?>
            <?}?>
            <h3><?= $userModel->getAttributeLabel('mixDrive') ?></h3>
            <p><?= $userModel->mixDrive ?> / <?= Yii::$app->params['PointTest']['mixDrive'] ?></p>
        </div>

        <div data-value="<?= $userModel->xClassLine ?>" data-max="<?= Yii::$app->params['PointTest']['xClassLine'] ?>" class="progressBar test test_7">
            <? if (!$userModel->endQuests->xClassLine) {?>
                <?= \yii\helpers\Html::a('', '/site/x-class-line') ?>
            <?}?>
            <h3><?= $userModel->getAttributeLabel('xClassLine') ?></h3>
            <p><?= $userModel->xClassLine ?> / <?= Yii::$app->params['PointTest']['xClassLine'] ?></p>
        </div>

        <div data-value="<?= $userModel->intelligent ?>" data-max="<?= Yii::$app->params['PointTest']['intelligent'] ?>" class = "progressBar test test_9">
            <h3>Intelligent drive</h3>
            <p><?= $userModel->intelligent ?> / <?= Yii::$app->params['PointTest']['intelligent'] ?></p>
        </div>

        <div data-value="<?= $userModel->quiz ?>" data-max="1" class = "progressBar test test_8">
            <? if (!$userModel->endQuests->quiz) {?>
                <?= \yii\helpers\Html::a('', '/site/quiz') ?>
            <?}?>
            <h3>Викторина</h3>
            <p><?= $userModel->quiz ?></p>
        </div>
    </div>
    <?= $this->render('_footer') ?>
</div>
<?// $truAnswers = false; ?>
<? if (Yii::$app->session->hasFlash('popupEndTest')) { ?>
    <? $truAnswers = [];
            if (!empty(Yii::$app->session->getFlash('popupEndTest')['truAnswers'])) {
                $truAnswers = Yii::$app->session->getFlash('popupEndTest')['truAnswers'];
            }else{
                $truAnswers = false;
            }
        ?>
        <?= $this->render('_popup-point-count', [
            'point' => Yii::$app->session->getFlash('popupEndTest')['point'],
            'truAnswers' => $truAnswers,
        ]);?>

<?}?>
