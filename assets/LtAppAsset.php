<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LtAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
       public $js = [
           'web/js/html5shiv.js',
           'web/js/respond.min.js'
    ];

       public  $jsOptions = [
           'condition' => 'Ite IE9',
           'position' => \yii\web\view::POS_HEAD,
       ];
}
