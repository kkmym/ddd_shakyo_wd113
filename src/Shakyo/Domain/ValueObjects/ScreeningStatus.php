<?php

namespace Shakyo\Domain\ValueObjects;

enum ScreeningStatus
{
    case NotApplied;
    case Interview;
    case Refected;
    case Passed;

    public function canAddInterview(): bool
    {
        return match ($this) {
            self::Interview => true,
            self::NotApplied, self::Passed, self::Passed => false
        };
    }
}
