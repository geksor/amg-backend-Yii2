<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $userModels \common\models\User */

$this->title = 'MyNT2018 MIX Тест-Драйв';
?>

<div class = "info info_trenr_group_viktorina">
    <?= $this->render('_top-line', [
        'title' => 'MIX Тест-Драйв',
        'link' => '/trainer/index',
    ]) ?>
    <div class = "flex_1">
        <div class = "trenr_groups">
        <? foreach ($userModels as $key => $userModel) {?>
            <?
                /* @var $userModel \common\models\User */
                /* @var $endQuests \common\models\EndQuest */
                $endQuests = $userModel->endQuests;
                $userFIO = $userModel->surname . ' ' . $userModel->first_name . ' ' . $userModel->last_name;
            ?>
            <div class="gallery__item">
                <div class = "linkWrap gallery__imageWrap">
                    <? if ($endQuests !== null && $endQuests->mixDrive) {?>
                        <?/* @var $mixDrive \common\models\MixDrive */
                        $mixDrive = $userModel->mixDrives
                        ?>

                        <img src="<?= $mixDrive->getPhoto() ?>" class="gallery__image" alt="<?= $userFIO ?>">
                        <?
                        echo Html::a('', $mixDrive->getPhoto(), ['data-fancybox' => 'gallery', 'data-caption' => $userFIO]);
                    }else{?>
                        <img src="/public/images/noimage.svg" class="gallery__image" alt="<?= $userFIO ?>">
                    <?}?>
                </div>
                <p class="gallery__userName"><?= $userFIO ?></p>
            </div>
        <?}?>
    </div>
    </div>
    <?= $this->render('_footer') ?>
</div> <!-- -->


