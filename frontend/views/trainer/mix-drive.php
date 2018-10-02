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

$this->title = 'ABS Авто MIX Тест-Драйв';
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
            ?>
            <div class = "trenr_group linkWrap">
                <div class = "group_place">
                    <p class = "group_place_number"><?= ++$key ?></p>
                </div>
                <div class = "group_name">
                    <p><?= $userModel->surname . ' ' . $userModel->first_name . ' ' . $userModel->last_name ?></p>
                </div>
                <div class = "group_bal">
                    <? if ($endQuests !== null && $endQuests->mixDrive) {?>
                        <p class = "test_ok">Тест завершен</p>
                    <?}else{?>
                        <p class = "test_no">Нет данных</p>
                    <?}?>
                </div>
                <? if ($endQuests !== null && $endQuests->mixDrive) {
                    echo Html::a('', ['/trainer/mix-drive-view', 'id' => $userModel->id]);
                }?>
            </div>
        <?}?>
    </div>
    </div>
    <?= $this->render('_footer') ?>
</div> <!-- -->


