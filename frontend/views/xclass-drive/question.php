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
/* @var $userModel \common\models\User */
/* @var $commandModel \common\models\Command */
/* @var $questionModel \common\models\XClassDriveQuestion */
/* @var $captain \common\models\User */

$captain = $commandModel->captain;
$this->title = 'ABS Авто Список членов команды';
?>

<div class = "info">
    <?= $this->render('_top-line', [
        'title' => 'Список членов команды',
        'link' => Yii::$app->homeUrl,
    ]) ?>

    <div class="x-class_content">
        <div class = "mix_ul_p">
            <p><?= $questionModel->title ?></p>
            <p><?= $questionModel->question ?></p>
        </div>
        <img src = "<?= $questionModel->question_image ?>" class = "mix_img">
        <form id="#" method="POST" class="form_step_x" autocomplete="off">
            <input name="user" type="text" class="user" tabindex="0" placeholder="Введите правильный ответ" required="">
        </form>
    </div>

    <div class="button_next_back">
        <a class="button_help">Подсказка</a>
        <a class="button_next">Далее<img src="/public/images/right-arrow.svg"></a>
    </div>

    <?= $this->render('_footer') ?>
</div>

<?= $this->render('_popup-captain') ?>

<script>
    window.onload = function () {

    }
</script>



