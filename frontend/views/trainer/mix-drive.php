<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \frontend\models\ImageUpload */

$this->title = 'ABS Авто MIX Тест-Драйв';
?>

<div class = "info info_trenr_group_viktorina">
    <?= $this->render('_top-line', [
        'title' => 'MIX Тест-Драйв',
        'link' => Yii::$app->homeUrl,
    ]) ?>

    <div class = "trenr_groups">
        <div class = "trenr_group">
            <div class = "group_place">
                <p class = "group_place_number">1</p>
            </div>
            <div class = "group_name">
                <p>Иванов Иван</p><p>Иванович</p>
            </div>
            <div class = "group_bal">
                <p class = "test_ok">Тест завершен</p>
            </div>
        </div>
    </div>

    <?= $this->render('_footer') ?>
</div> <!-- -->


