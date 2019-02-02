<?php

use Nofutur3\ValueObject\User\Email;

class EmailCest
{
    public function _before(UnitTester $I)
    {
    }

    /**
     * @dataProvider emailProvider
     */
    public function testEmailValidation(UnitTester $I, \Codeception\Example $example)
    {
        if (!$example['result']) {
            $I->expectThrowable(\InvalidArgumentException::class, function () use ($example) {new Email($example['email']); });
        } else {
            $I->assertSame($example['email'], (string) new Email($example['email']));
        }
    }

    protected function emailProvider()
    {
        return [
            ['email' => 'user@domain.com', 'result' => true],
            ['email' => 'first.user@domain.com', 'result' => true],
            ['email' => 'hello+user@domain.com', 'result' => true],
            ['email' => 'user@domain.co.uk', 'result' => true],
            ['email' => 'user@domain.cz', 'result' => true],
            ['email' => 'user@subdomain.domain.com', 'result' => true],
            // two below are limitations of filter, might be solved
            // ['email' => 'user@10.10.10.1', 'result' => true],
            // ['email' => 'user@domain.commonvalueobject', 'result' => false],
            ['email' => 'user@hello', 'result' => false],
            ['email' => 'user', 'result' => false],
            ['email' => 'user.com', 'result' => false],
        ];
    }
}
