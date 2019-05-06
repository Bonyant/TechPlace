<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'css/skel.css',
        'css/style.css',
        'css/style-desktop.css',
        'css/style-wide.css',
        'css/nivo-lightbox.css',
        'css/nivo_themes/default/default.css'
    ];
    public $js = [
        'js/skel.min.js',
        'js/skel-layers.min.js',
        'js/init.js',
        'js/main.js',
        'js/nivo-lightbox.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
