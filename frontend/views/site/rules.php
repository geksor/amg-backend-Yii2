<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

/* @var $this yii\web\View */
/* @var $rules */

$this->title = 'MyNT2018 Правила тренинга';
?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Правила тренинга',
        'link' => Yii::$app->request->referrer,
    ]) ?>
    <div class = "info_content info_content_p ">
        <div class = "info_content">
            <?= $rules ?>
        </div>
    </div>
    <?= $this->render('_footer') ?>
</div>


