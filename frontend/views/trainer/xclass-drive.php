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

$this->title = 'ABS Авто X-Класс Тест-Драйв';
?>

<div class = "info info_trenr_group_viktorina">
    <?= $this->render('_top-line', [
        'title' => 'X-Класс Тест-Драйв',
        'link' => '/trainer/index',
    ]) ?>

    <div class="x-class_content">
        <? foreach ($commandModels as $key => $commandModel) {?>
            <?
            /* @var $commandModel \common\models\Command */
            /* @var $captain \common\models\User */
            $captain = $commandModel->captain;
            ?>
            <div class = "trenr_group_comand">
                <div class = "trenr_group_comand_name">
                    <h2>Команда №<?= ++$key ?></h2>
                    <p>Капитан команды: <?= $captain->surname . ' ' . $captain->first_name . ' ' . $captain->last_name ?></p>
                </div>
                <div class = "trenr_group_comand_progres">
                    <? if ($captain->endQuests->xClassDrive) {?>
                        <p><?= Yii::$app->params['PointTest']['xClassDrive'] ?></p>
                    <?}else{?>
                        Тестирование не окончено
                    <?}?>
                </div>
            </div>
        <?}?>
    </div>

    <?= $this->render('_footer') ?>
</div> <!-- -->


