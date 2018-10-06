<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

/* @var $this yii\web\View */
/* @var $models \common\models\Contact */
/* @var $model \common\models\Contact */

$this->title = 'MyNT2018 Контакты';
?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Контакты',
        'link' => Yii::$app->request->referrer,
    ]) ?>
    <div class = "info_content">
        <div class = "info_content">
            <? foreach ($models as $model) {?>
                <div class = "info_kontakt">
                    <h3><?= $model->name ?></h3>
                    <p class ="info_kontakt_p"><?= $model->position ?></p>
                    <p class = "info_phone"><?= $model->phone ?></p>
                </div>
            <?}?>
        </div>
    </div>
    <?= $this->render('_footer') ?>
</div>


