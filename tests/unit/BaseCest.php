<?php

use Nofutur3\ValueObject\Address\PostalCode;
use Nofutur3\ValueObject\Base;

class BaseCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests
    public function comparableTest(UnitTester $I)
    {
        $one = new PostalCode('11111');
        $two = new PostalCode('22222');
        $similarAsOne = new PostalCode('11111');

        $I->assertTrue($one->equals($one));
        $I->assertTrue($one->equals($similarAsOne));
        $I->assertFalse($one->equals($two));
    }

    public function testImmutabilityLock(UnitTester $I)
    {
        $one = new PostalCode('11111');
        $two = clone $one;
        $I->assertFalse($one === $two);
        $I->expectThrowable(\LogicException::class, function () use ($two) {$two->__set('value', '22222');});
    }
}
