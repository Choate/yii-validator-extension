<?php
namespace choateunit\validators\unit\validators;
use choate\validators\AccountValidator;
use choateunit\validators\unit\TestCase;
use Codeception\Specify;

/**
 * Class AccountValidatorTest
 * @author Choate Yao <choate.yao@gmail.com>
 * @package choateunit\validators\unit\validators
 */
class AccountValidatorTest extends TestCase
{
    use Specify;

    public function testAlnum() {
        $val = new AccountValidator(['allowChinese' => false]);
        $this->assertTrue($val->validate('x1994'));
        $this->assertFalse($val->validate('人1994'));
        $this->assertFalse($val->validate('x人1994'));
        $this->assertFalse($val->validate('1994'));
    }

    public function testAllowChineseAlnum() {
        $val = new AccountValidator(['allowChinese' => true]);
        $this->assertTrue($val->validate('x1994'));
        $this->assertTrue($val->validate('然1994'));
        $this->assertTrue($val->validate('x然1994'));
        $this->assertFalse($val->validate('1x然1994'));
    }
}