<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $userModel \common\models\User */
/* @var $driveModel \common\models\MixDrive || \common\models\AmgDrive */
/* @var $title \frontend\controllers\TrainerController */

$this->title = "ABS Авто $title";
?>

<div class = "info info_trenr_group_viktorina">
    <?= $this->render('_top-line', [
        'title' => $title,
        'link' => Yii::$app->request->referrer,
    ]) ?>

    <div class="x-class_content">
        <p class = "mix_ul_p"><?= $userModel->surname . ' ' . $userModel->first_name . ' ' . $userModel->last_name ?></p>
        <?= Html::img($driveModel->getPhoto(), ['class' => 'mix_img']) ?>
    </div>

    <?= $this->render('_footer') ?>
</div> <!-- -->


