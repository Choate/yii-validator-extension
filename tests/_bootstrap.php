<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require_once '../../../../vendor/autoload.php';
require_once '../../../../vendor/yiisoft/yii2/Yii.php';

Yii::setAlias('@choateunit/validators', __DIR__);
Yii::setAlias('@choate/validators', dirname(__DIR__) . '/src');
