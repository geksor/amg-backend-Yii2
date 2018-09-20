<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Timetable */

$this->title = 'ABS Авто информация';
?>
<div class = "info">
    <?= $this->render('_top-line', [
        'title' => $model->title,
        'link' => Yii::$app->request->referrer,
    ]) ?>
    <div class = "info_content">
        <div class = "info_content">
            <?= $model->description ?>
        </div>
    </div>
    <?= $this->render('_footer') ?>
</div>
