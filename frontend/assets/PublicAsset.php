<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/slick-theme.css',
        'public/css/slick.css',
        'public/css/fancybox.css',
        'public/css/style.css',
    ];
    public $js = [
//        'https://code.jquery.com/jquery-1.12.4.js',
        'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
        'public\js\jquery.ui.touch-punch.min.js',
        'public\js\jquery.fancybox.min.js',
        'public\js\slick.min.js',
        'public\js\load-image.all.min.js',
        'public\js\main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
