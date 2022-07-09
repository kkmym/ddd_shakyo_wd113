<?php

namespace Shakyo\Domain\ValueObjects;

enum ScreeningStatus
{
    case NotApplied;
    case Interview;
    case Refected;
    case Passed;
}
