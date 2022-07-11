<?php

namespace Shakyo\Domain\ValueObjects;

enum InterviewResult
{
    case NotEvaluated;
    case Pass;
    case Fail;
}
