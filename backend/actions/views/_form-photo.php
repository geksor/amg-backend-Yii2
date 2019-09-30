<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bupy7\cropbox\CropboxWidget;

/* @var $this yii\web\View */
/* @var $model common\models\ImageUpload */
/* @var $form yii\widgets\ActiveForm */
/* @var $width */
/* @var $height */
/* @var $minWidth */
/* @var $minHeight */
/* @var $maxWidth */
/* @var $maxHeight */
/* @var $prevWidth */
/* @var $prevHeight */

$variants = [[
    'width' => $width,
    'height' => $height
]];

if ($minWidth && $minHeight && $maxWidth && $maxHeight && !$prevWidth && !$prevHeight){
    $variants = [[
        'width' => $width,
        'height' => $height,
        'minWidth' => $minWidth,
        'minHeight' => $minHeight,
        'maxWidth' => $maxWidth,
        'maxHeight' => $maxHeight,
    ]];
}

if ($prevWidth && $prevHeight){
    $variants = [
        [
            'width' => $width,
            'height' => $height,
        ],
        [
            'width' => $prevWidth,
            'height' => $prevHeight,
        ]
    ];

    if ($minWidth && $minHeight && $maxWidth && $maxHeight){
        $variants = [
            [
                'width' => $width,
                'height' => $height,
                'minWidth' => $minWidth,
                'minHeight' => $minHeight,
                'maxWidth' => $maxWidth,
                'maxHeight' => $maxHeight,
            ],
            [
                'width' => $prevWidth,
                'height' => $prevHeight,
            ]
        ];
    }
}

?>

<div class="personal-form-photo image-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'image')->widget(CropboxWidget::className(), [
        'croppedDataAttribute' => 'crop_info',
        'pluginOptions' => [
            'variants' => $variants
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
