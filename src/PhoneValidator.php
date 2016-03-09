<?php
namespace choate\validators;

use yii\validators\RegularExpressionValidator;

/**
 * Class PhoneValidator
 * @author Choate Yao <choate.yao@gmail.com>
 */
class PhoneValidator extends RegularExpressionValidator
{

    /**
     * whether the attribute value can only be an sim card number. Default to false.
     *
     * @var bool
     */
    public $entitiesOnly = false;

    /**
     * China mobile phone number (does not include virtual number) regular expression
     *
     * @var string
     * @link https://zh.wikipedia.org/wiki/%E4%B8%AD%E5%9B%BD%E5%86%85%E5%9C%B0%E7%A7%BB%E5%8A%A8%E7%BB%88%E7%AB%AF%E9%80%9A%E8%AE%AF%E5%8F%B7%E7%A0%81#cite_note-3
     */
    public $entitiesPattern = '#^1(([38]\d{9})|(4[57]\d{8})|(5[0-35-9]\d{8})|(7[6-8]\d{8}))$#';

    /**
     * China mobile phone number regular expression
     *
     * @var string
     */
    public $phonePattern = '#^1(([38]\d{9})|(4[57]\d{8})|(5[0-35-9]\d{8})|((7[6-8]\d{8})|(70[015789]\d{7})|(71[89]\d{7})))$#';

    public function init() {
        $this->pattern = $this->entitiesOnly ? $this->entitiesPattern : $this->phonePattern;
        $this->not = false;
        parent::init();
    }
}