<?php
namespace admin\assets;

use yii\base\Exception;
use yii\web\AssetBundle;
use yii\web\AssetManager;

class AdminAsset extends AssetBundle
{
    public $sourcePath = '@adminDist';
    public $css = [
        'css/admin.css',
    ];
    public $js = [
        'js/admin.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $publishOptions = [
        'forceCopy' => true,
    ];
}
