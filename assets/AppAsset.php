<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot'; // points to web/
    public $baseUrl = '@web';      // URL for web/
    public $css = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', // Bootstrap CSS from CDN
        'css/site.css', // your custom CSS
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', // Bootstrap JS
        'js/custom.js', // your custom JS
    ];
    public $depends = [
        'yii\web\YiiAsset',          // includes jQuery
        'yii\bootstrap5\BootstrapAsset', // optional if you want Bootstrap AssetBundle support
    ];
}
