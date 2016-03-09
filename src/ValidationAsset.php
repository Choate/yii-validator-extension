<?php
namespace choate\validators;

use yii\web\AssetBundle;

/**
 * Class ValidationAsset
 * @author Choate Yao <choate.yao@gmail.com>
 * @package choate\validators
 */
class ValidationAsset extends AssetBundle
{
    public $sourcePath = '@choate/assets';
    public $js = [
        'choate.validation.js',
    ];
    public $depends = [
        'yii\validators\ValidationAsset',
    ];
}