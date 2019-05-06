<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 13.08.2017
 * Time: 22:41
 */

namespace app\assets;

use yii\web\AssetBundle;

class AppAssetAdmin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/font-awesome.min.css',
    ];
    public $js = [
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}