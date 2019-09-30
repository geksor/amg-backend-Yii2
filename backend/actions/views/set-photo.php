<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\ImageUpload */
/* @var $imageFrom */
/* @var $title */
/* @var $width */
/* @var $height */
/* @var $minWidth */
/* @var $minHeight */
/* @var $maxWidth */
/* @var $maxHeight */
/* @var $prevWidth */
/* @var $prevHeight */

$this->title = 'Выбор Изображения: ' . $title;

?>
<div class="personal-set-photo">

    <div class="box box-primary">
        <div class="box-body">
            <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', Yii::$app->request->referrer, ['class' => 'btn btn-default']) ?>

            <?= $this->render('_form-photo', [
                'model' => $model,
                'width' => $width,
                'height' => $height,
                'minWidth' => $minWidth,
                'minHeight' => $minHeight,
                'maxWidth' => $maxWidth,
                'maxHeight' => $maxHeight,
                'prevWidth' => $prevWidth,
                'prevHeight' => $prevHeight,
            ]) ?>

        </div>
    </div>

</div>
