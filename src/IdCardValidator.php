<?php
/**
 * Created by PhpStorm.
 * User: Choate
 * Date: 16/3/8
 * Time: 上午10:48
 */

namespace choate\validators;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\validators\Validator;

/**
 * Class IdCardValidator
 * @author Choate Yao <choate.yao@gmail.com>
 * @package choate\validators
 */
class IdCardValidator extends Validator
{
    const FACTOR = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
    const PARITY = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
    const CHECKSUM = 11;

    protected $pattern = '#^([1-9]{2})(\d{2})(\d{2})(\d{4})(\d{2})(\d{2})(\d{3})(\d|x)#i';

    /**
     * @inheritDoc
     */
    public function init() {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} is invalid.');
        }
    }

    /**
     * @inheritDoc
     */
    public function clientValidateAttribute($model, $attribute, $view) {
        $options = [
            'pattern'     => Html::escapeJsRegularExpression($this->pattern),
            'factor'      => self::FACTOR,
            'parity'      => self::PARITY,
            'checksum'    => self::CHECKSUM,
            'message'     => Yii::$app->getI18n()->format($this->message, [
                'attribute' => $model->getAttributeLabel($attribute),
            ], Yii::$app->language),
            'skipOnEmpty' => $this->skipOnEmpty,
        ];
        ValidationAsset::register($view);

        return 'yii.validation.idCard(value, messages, ' . Json::htmlEncode($options) . ');';
    }

    /**
     * @inheritDoc
     */
    protected function validateValue($value) {
        if (!$this->isCard($value, $match)) {
            return [$this->message, []];
        }
        return $this->isParity($value, end($match)) ? null : [$this->message, []];
    }

    protected function isCard($value, &$match) {
        return preg_match_all($this->pattern, $value, $match);
    }

    protected function isParity($card, $parity) {
        $numbers = str_split($card);
        array_pop($numbers);
        $total = 0;
        foreach ($numbers as $key => $num) {
            $total += $num * self::FACTOR[$key];
        }

        return strcmp($parity, self::PARITY[$total % self::CHECKSUM]) === 0;
    }

    protected function isEffectiveArea($province, $city, $county) {
        return $this->isProvince($province);
    }

    protected function isProvince($province) {
        return (bool)$this->getProvince($province);
    }

    public function getProvince($province) {
        $provinces = [
            11 => '北京', 12 => '天津', 13 => '河北', 14 => '山西', 15 => '内蒙古',
            21 => '辽宁', 22 => '吉林', 23 => '黑龙江', 31 => '上海', 32 => '江苏',
            33 => '浙江', 34 => '安徽', 35 => '福建', 36 => '江西', 37 => '山东', 41 => '河南',
            42 => '湖北', 43 => '湖南', 44 => '广东', 45 => '广西', 46 => '海南', 50 => '重庆',
            51 => '四川', 52 => '贵州', 53 => '云南', 54 => '西藏', 61 => '陕西', 62 => '甘肃',
            63 => '青海', 64 => '宁夏', 65 => '新疆', 71 => '台湾', 81 => '香港', 82 => '澳门', 91 => '国外'
        ];

        return ArrayHelper::getValue($provinces, $province, null);
    }
}