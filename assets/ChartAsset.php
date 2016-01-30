<?php
/**
 * Created by PhpStorm.
 * User: karen
 * Date: 1/24/16
 * Time: 10:13 PM
 */

namespace app\assets;
use yii\web\AssetBundle;

class ChartAsset extends AssetBundle
{
    //public $sourcePath = '@bower/Chart.js';
    public $js = [
        'http://www.gstatic.com/charts/loader.js'
    ];
}