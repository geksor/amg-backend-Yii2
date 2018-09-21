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
        <div class="amg_static_slick">

            <? foreach ($model->amgStaticQuestions as $question) {/* @var $question \common\models\AmgStaticQuestion */?>
                <? if (!$question->isUserAnswer(Yii::$app->user->id)) {?>

                    <? $photoArr = $question->getPhotos();?>


                    <div>
                        <div id="droppable_1" class="amg__questImage" style = 'background-image: url(<?= $photoArr['thumb_image_1'] ?>)'></div>
                    </div>

                    <div>
                        <div id="droppable_2" class="amg__questImage" style = 'background-image: url(<?= $photoArr['thumb_image_2'] ?>)'></div>
                    </div>

                    <div>
                        <div id="droppable_3" class="amg__questImage" style = 'background-image: url(<?= $photoArr['thumb_image_3'] ?>)'></div>
                    </div>

                    <? break ?>

                <?}?>
            <?}?>

        </div>
        <div class = "dotsAppend"></div>
        <ul class = "mix_amg">
            <li id="draggable">63</li>
            <li id="draggable_1">53</li>
            <li id="draggable_2">43</li>
        </ul>
    </div>
    <a class="submit">Далее</a>
    <?= $this->render('_footer') ?>
</div>


