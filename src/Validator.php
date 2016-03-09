<?php
namespace choate\validators;

use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\helpers\ArrayHelper;

/**
 * Class ExtensionValidator
 * @author Choate Yao <choate.yao@gmail.com>
 */
class Validator extends Component implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app) {
        \Yii::setAlias('@choate/validators', __DIR__);
        \yii\validators\Validator::$builtInValidators = ArrayHelper::merge($this->getExtensionValidators(), \yii\validators\Validator::$builtInValidators);
    }

    protected function getExtensionValidators() {
        return [
            'qq'      => [
                'class'   => 'yii\validators\RegularExpressionValidator',
                'pattern' => '#^\d{5,10}$#',
            ],
            'chinese' => [
                'class'   => 'yii\validators\RegularExpressionValidator',
                'pattern' => '#^[\x{4e00}-\x{9fa5}]*$#u',
            ],
            'account' => 'choate\validators\AccountValidator',
            'phone'   => 'choate\validators\PhoneValidator',
            'idCard'  => 'choate\validators\IdCardValidator',
        ];
    }

}