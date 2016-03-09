<?php
namespace choate\validators;
use yii\validators\RegularExpressionValidator;

/**
 * Class AccountValidator
 * @author Choate Yao <choate.yao@gmail.com>
 * @package choate\validators\assets
 */
class AccountValidator extends RegularExpressionValidator
{
    public $allowChinese = true;

    /**
     * Why not use \w, when the system LC_ALL is zh_CN will lead BUG.
     * ```
     * LC_ALL = zh_CN.UTF-8
     *
     * preg_match('#^\w+$#', '人1111', $match);
     *
     * match '人1111'
     * ```
     *
     * @var string
     */
    protected $alnumPattern = '#^[a-zA-Z][a-zA-Z\d_]*$#';

    protected $alnumChinesePattern = '#^[\x{4e00}-\x{9fa5}a-zA-Z][\x{4e00}-\x{9fa5}a-zA-Z\d_]*$#u';

    public function init() {
        $this->pattern = $this->allowChinese ? $this->alnumChinesePattern : $this->alnumPattern;
        parent::init();
    }
}