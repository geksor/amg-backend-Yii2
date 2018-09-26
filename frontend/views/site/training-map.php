<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

/* @var $this yii\web\View */
/* @var $map */

$this->title = 'ABS Авто Карта тренинга';
?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Карта тренинга',
        'link' => Yii::$app->request->referrer,
    ]) ?>
    <?= $map ?>
    <?= $this->render('_footer') ?>
</div>


