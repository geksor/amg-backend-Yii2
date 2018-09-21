<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

/* @var $this yii\web\View */
/* @var $model \common\models\AmgStaticTest */

$this->title = 'ABS Авто Amg статика';

?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Amg статика',
        'link' => Yii::$app->homeUrl,
   ]) ?>
    <div class="x-class_content">
        <div id="amg_static_slick">
            <? foreach ($model->amgStaticQuestions as $key => $question) {/* @var $question \common\models\AmgStaticQuestion */?>

                <div id="droppable<?= $key ?>" style = 'background: url(<?= $question->getPhotos() ?>)'></div>
            <?}?>
        </div>
        <ul class = "mix_ul">
            <li></li>
            <li></li>
            <li class = "active"></li>
        </ul>
        <ul class = "mix_amg">
            <li id="draggable">63</li>
            <li id="draggable_1">53</li>
            <li id="draggable_2">43</li>
        </ul>
    </div>
    <a class="submit">Далее</a>
    <?= $this->render('_footer') ?>
</div>


