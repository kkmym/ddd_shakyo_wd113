<?php

namespace Shakyo\Domain\ValueObjects;

use Exception;

class EmailAddress
{
    private string $emailAddress;

    public function __construct(string $emailAddress)
    {
        if (!$this->validateEmailAddress($emailAddress)) {
            throw new Exception('Eメールアドレスがおかしい');
        }

        $this->emailAddress = $emailAddress;
    }

    public function getValue(): string
    {
        return $this->emailAddress;
    }

    private function validateEmailAddress($value): bool
    {
        return (bool)filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
