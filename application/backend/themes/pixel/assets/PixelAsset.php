<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\themes\pixel\assets;

use yii\web\AssetBundle;

/**
 * @author Dmitry Pilipenko
 * @since 2.0
 */
class PixelAsset extends AssetBundle {

    public $basePath = '@app/themes/pixel';
    public $baseUrl = '@web/themes/pixel';
    public $css = [
        'assets/stylesheets/bootstrap.min.css',
        'assets/stylesheets/pixel-admin.min.css',
        'assets/stylesheets/widgets.min.css',
        'assets/stylesheets/pages.min.css',
        'assets/stylesheets/rtl.min.css',
        'assets/stylesheets/themes.min.css',
    ];
    public $js = [
        'assets/javascripts/bootstrap.min.js',
        'assets/javascripts/pixel-admin.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
