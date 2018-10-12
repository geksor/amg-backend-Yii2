<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

/* @var $this yii\web\View */

$this->title = 'MyNT2018 Информация';
?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Информация',
        'link' => Yii::$app->homeUrl,
    ]) ?>
    <div class = "info_button">
        <?= \yii\helpers\Html::a('Контакты', '/site/contact', ['class' => 'submit']) ?>
        <?= \yii\helpers\Html::a('Карта тренинга', '/site/training-map', ['class' => 'submit']) ?>
        <?= \yii\helpers\Html::a('Правила тренинга', '/site/rules', ['class' => 'submit']) ?>
        <?= \yii\helpers\Html::a('Фотоотчет', '/photo-report', ['class' => 'submit']) ?>
    </div>
    <?= $this->render('_footer') ?>
</div>


