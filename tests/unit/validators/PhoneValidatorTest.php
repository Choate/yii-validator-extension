<?php
namespace choateunit\validators\unit\validators;

use choate\validators\PhoneValidator;
use choateunit\validators\unit\TestCase;

/**
 * Class PhoneValidatorTest
 * @author Choate Yao <choate.yao@gmail.com>
 * @package choateunit\validators\unit\validators
 */
class PhoneValidatorTest extends TestCase
{
    use \Codeception\Specify;

    public function testEntitiesPhone() {
        $val = new PhoneValidator(['entitiesOnly' => true]);
        $this->specify('Check the beginning of the 13 phone numbers', function () use ($val) {
            $this->assertTrue($val->validate(13012345678));
            $this->assertTrue($val->validate(13112345678));
            $this->assertTrue($val->validate(13212345678));
            $this->assertTrue($val->validate(13312345678));
            $this->assertTrue($val->validate(13412345678));
            $this->assertTrue($val->validate(13512345678));
            $this->assertTrue($val->validate(13612345678));
            $this->assertTrue($val->validate(13712345678));
            $this->assertTrue($val->validate(13812345678));
            $this->assertTrue($val->validate(13912345678));
        });

        $this->specify('Check the beginning of the 14 phone numbers', function () use ($val) {
            $this->assertFalse($val->validate(14012345678));
            $this->assertFalse($val->validate(14112345678));
            $this->assertFalse($val->validate(14212345678));
            $this->assertFalse($val->validate(14312345678));
            $this->assertFalse($val->validate(14412345678));
            $this->assertTrue($val->validate(14512345678));
            $this->assertFalse($val->validate(14612345678));
            $this->assertTrue($val->validate(14712345678));
            $this->assertFalse($val->validate(14812345678));
            $this->assertFalse($val->validate(14912345678));
        });

        $this->specify('Check the beginning of the 15 phone numbers', function () use ($val) {
            $this->assertTrue($val->validate(15012345678));
            $this->assertTrue($val->validate(15112345678));
            $this->assertTrue($val->validate(15212345678));
            $this->assertTrue($val->validate(15312345678));
            $this->assertFalse($val->validate(15412345678));
            $this->assertTrue($val->validate(15512345678));
            $this->assertTrue($val->validate(15612345678));
            $this->assertTrue($val->validate(15712345678));
            $this->assertTrue($val->validate(15812345678));
            $this->assertTrue($val->validate(15912345678));
        });

        $this->specify('Check the beginning of the 16 phone numbers', function () use ($val) {
            $this->assertFalse($val->validate(16012345678));
            $this->assertFalse($val->validate(16112345678));
            $this->assertFalse($val->validate(16212345678));
            $this->assertFalse($val->validate(16312345678));
            $this->assertFalse($val->validate(16412345678));
            $this->assertFalse($val->validate(16512345678));
            $this->assertFalse($val->validate(16612345678));
            $this->assertFalse($val->validate(16712345678));
            $this->assertFalse($val->validate(16812345678));
            $this->assertFalse($val->validate(16912345678));
        });

        $this->specify('Check the beginning of the 17 phone numbers', function () use ($val) {
            $this->assertFalse($val->validate(17012345678));
            $this->assertFalse($val->validate(17112345678));
            $this->assertFalse($val->validate(17212345678));
            $this->assertFalse($val->validate(17312345678));
            $this->assertFalse($val->validate(17412345678));
            $this->assertFalse($val->validate(17512345678));
            $this->assertTrue($val->validate(17612345678));
            $this->assertTrue($val->validate(17712345678));
            $this->assertTrue($val->validate(17812345678));
            $this->assertFalse($val->validate(17912345678));
        });

        $this->specify('Check the beginning of the 18 phone numbers', function () use ($val) {
            $this->assertTrue($val->validate(18012345678));
            $this->assertTrue($val->validate(18112345678));
            $this->assertTrue($val->validate(18212345678));
            $this->assertTrue($val->validate(18312345678));
            $this->assertTrue($val->validate(18412345678));
            $this->assertTrue($val->validate(18512345678));
            $this->assertTrue($val->validate(18612345678));
            $this->assertTrue($val->validate(18712345678));
            $this->assertTrue($val->validate(18812345678));
            $this->assertTrue($val->validate(18912345678));
        });

        $this->specify('Check the beginning of the 19 phone numbers', function () use ($val) {
            $this->assertFalse($val->validate(19012345678));
            $this->assertFalse($val->validate(19112345678));
            $this->assertFalse($val->validate(19212345678));
            $this->assertFalse($val->validate(19312345678));
            $this->assertFalse($val->validate(19412345678));
            $this->assertFalse($val->validate(19512345678));
            $this->assertFalse($val->validate(19612345678));
            $this->assertFalse($val->validate(19712345678));
            $this->assertFalse($val->validate(19812345678));
            $this->assertFalse($val->validate(19912345678));
        });
    }

    public function testPhone() {
        $val = new PhoneValidator(['entitiesOnly' => false]);
        $this->specify('Check the beginning of the 170[015789] and 171[89] phone numbers', function () use ($val) {
            $this->assertTrue($val->validate(17012345678));
            $this->assertFalse($val->validate(17022345678));
            $this->assertFalse($val->validate(17032345678));
            $this->assertFalse($val->validate(17042345678));
            $this->assertTrue($val->validate(17052345678));
            $this->assertFalse($val->validate(17062345678));
            $this->assertTrue($val->validate(17072345678));
            $this->assertTrue($val->validate(17082345678));
            $this->assertTrue($val->validate(17092345678));
            $this->assertFalse($val->validate(17102345678));
            $this->assertFalse($val->validate(17112345678));
            $this->assertFalse($val->validate(17122345678));
            $this->assertFalse($val->validate(17132345678));
            $this->assertFalse($val->validate(17142345678));
            $this->assertFalse($val->validate(17152345678));
            $this->assertFalse($val->validate(17162345678));
            $this->assertFalse($val->validate(17172345678));
            $this->assertTrue($val->validate(17182345678));
            $this->assertTrue($val->validate(17192345678));
        });

        $this->specify('Check the phone number length', function() use ($val) {
            $this->assertFalse($val->validate(130123456789));
            $this->assertFalse($val->validate(1301234567));
            $this->assertFalse($val->validate(130123456));
            $this->assertFalse($val->validate(13012345));
            $this->assertFalse($val->validate(1301234));
        });
    }
}