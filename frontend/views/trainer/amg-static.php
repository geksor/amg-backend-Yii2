<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $userModels \common\models\User */
/* @var $maxPoint \frontend\controllers\TrainerController */

$this->title = 'MyNT2018 AMG статика';
?>
<div class = "info info_trenr_group_viktorina">
    <?= $this->render('_top-line', [
        'title' => 'AMG статика',
        'link' => '/trainer/index',
    ]) ?>

    <div class="flex_1">
        <div class = "trenr_groups">
            <? foreach ( $userModels as $key => $userModel ) {?>
                <?
                /* @var $userModel \common\models\User */
                $placeClass = '';
                switch ($key + 1){
                    case 1:
                        $placeClass = 'gold';
                        break;
                    case 2:
                        $placeClass = 'silver';
                        break;
                    case 3:
                        $placeClass = 'bronze';
                        break;
                }
                ?>
                <div class = "trenr_group">
                    <div class = "group_place">
                        <p class = "group_place_number <?= $placeClass ?>"><?= ++$key ?></p>
                    </div>
                    <div class = "group_name">
                        <p><?= $userModel->surname . ' ' . $userModel->first_name . ' ' . $userModel->last_name ?></p>
                    </div>
                    <div class = "group_bal">
                        <p class = "group_bal_number" data-value="<?= $userModel->amgStatic ?>"><?= $userModel->amgStatic ?></p>
                    </div>
                </div>
            <?}?>
        </div>
    </div>

    <?= $this->render('_footer') ?>
</div> <!-- -->

<script>
    window.onload = function () {
        $('.group_bal_number').each(function () {

            $(this).progressbar({
                value: $(this).data('value'),
                max: <?= $maxPoint ?>
            })
        });

    }
</script>

