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
/* @var $quizCount \frontend\controllers\TrainerController */

$this->title = 'ABS Авто Викторина';
?>
<div class = "info info_trenr_group_viktorina">
    <?= $this->render('_top-line', [
        'title' => 'Викторина',
        'link' => '/trainer/index',
    ]) ?>

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

                $quizAnswerCount = 0;

                if ($userModel->userQuizzes !== null) {
                    foreach ($userModel->userQuizzes as $quiz) {
                        ++$quizAnswerCount;
                    }
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
                    <div class="ul_bal_8" data-value="<?= $quizAnswerCount ?>">
                        <p><?= $quizAnswerCount ?>/<?= $quizCount ?></p>
                    </div>
                    <p class = "group_bal_number" data-value="<?= $userModel->quiz ?>"><?= $userModel->quiz ?></p>
                </div>
            </div>
        <?}?>
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
        $('.ul_bal_8').each(function () {

            $(this).progressbar({
                value: $(this).data('value'),
                max: <?= $quizCount ?>
            })
        });

    }
</script>

