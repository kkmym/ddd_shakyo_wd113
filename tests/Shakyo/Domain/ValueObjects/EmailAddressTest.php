<?php

use PHPUnit\Framework\TestCase;
use Shakyo\Domain\ValueObjects\EmailAddress;

class EmailAddressTest extends TestCase
{
    public function testInvalidEmailAddressString()
    {
        $this->expectException(Exception::class);

        $invalidEmailAddressString = 'invalid_mail@address';
        $vo = new EmailAddress($invalidEmailAddressString);
    }

    public function testValidEmailAddressString()
    {
        $validEmailAddressString = 'valid.email.address@example.com';
        $emailAddress = new EmailAddress($validEmailAddressString);

        $this->assertEquals($validEmailAddressString, $emailAddress->getValue());
    }
}
