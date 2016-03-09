<?php
/**
 * 邢帅教育
 *
 * 本源代码由邢帅教育及其作者共同所有，未经版权持有者的事先书面授权，
 * 不得使用、复制、修改、合并、发布、分发和/或销售本源代码的副本。
 *
 * @copyright Copyright (c) 2013 xsteach.com all rights reserved.
 */

namespace choateunit\validators\unit\validators;

use choateunit\validators\unit\TestCase;
use Codeception\Specify;
use yii\base\Model;
use yii\validators\Validator;

/**
 * Class ValidatorTest
 * @author Choate Yao <choate.yao@gmail.com>
 * @package choateunit\validators\unit\validators
 */
class ValidatorTest extends TestCase
{
    use Specify;

    public function testBuiltInValidators() {
        $this->assertArrayHasKey('qq', Validator::$builtInValidators);
        $this->assertArrayHasKey('chinese', Validator::$builtInValidators);
        $this->assertArrayHasKey('account', Validator::$builtInValidators);
        $this->assertArrayHasKey('phone', Validator::$builtInValidators);
        $this->assertArrayHasKey('trim', Validator::$builtInValidators);
    }

    public function testValidators() {
        $this->specify('Check QQ number', function () {
            $qqVal = Validator::createValidator('qq', new Model(), '');
            $this->assertFalse($qqVal->validate(1234));
            $this->assertTrue($qqVal->validate(12345));
            $this->assertTrue($qqVal->validate(123456));
            $this->assertTrue($qqVal->validate(1234567));
            $this->assertTrue($qqVal->validate(12345678));
            $this->assertTrue($qqVal->validate(123456789));
            $this->assertTrue($qqVal->validate(1234567890));
            $this->assertFalse($qqVal->validate(12345678901));
            $this->assertFalse($qqVal->validate(123456789012));
            $this->assertFalse($qqVal->validate('123456x'));
            $this->assertFalse($qqVal->validate('x123456x'));
            $this->assertFalse($qqVal->validate('123x456x'));
        });

        $this->specify('Check Chinese', function () {
            $val = Validator::createValidator('chinese', new Model(), '');
            $this->assertTrue($val->validate('中国'));
            $this->assertFalse($val->validate('中国x'));
            $this->assertFalse($val->validate('中国1'));
            $this->assertFalse($val->validate('中国\x4E00'));
            $this->assertFalse($val->validate('abc'));
        });
    }
}