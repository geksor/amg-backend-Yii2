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
//        'public/css/main.css',
    ];
    public $js = [
        'public/js/vendor/jquery-ui.min.js',
        'public/js/vendor/jquery.maskedinput.min.js',
        'public/js/vendor/slick.min.js',
        'public/js/vendor/slideout.js',
        'public/js/vendor/jquery.fancybox.min.js',
        'public/js/agreement.js',
        'public/js/mainNew.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
        'frontend\assets\AppAsset'
    ];
}
