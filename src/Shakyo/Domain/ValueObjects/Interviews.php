<?php

namespace Shakyo\Domain\ValueObjects;

use DateTime;
use Shakyo\Domain\Entities\Interview;

class Interviews
{
    private array $interviews;

    public function __construct(?Interview ...$interviews)
    {
        $this->interviews = $interviews;
    }

    public function all(): array
    {
        return $this->interviews;
    }

    public function getMaxInterviewNumber(): int
    {
        $maxNum = 0;

        foreach ($this->interviews as $interview) {
            if ($interview->getInterviewNumber() > $maxNum) {
                $maxNum = $interview->getInterviewNumber();
            }
        }

        return $maxNum;
    }

    public function addNextInterview(DateTime $nextInterviewDateTime): void
    {
        $nextInterviewNumber = $this->getMaxInterviewNumber() + 1;
        $newInterview = Interview::createNewInstance($nextInterviewNumber, $nextInterviewDateTime);
        $this->interviews[] = $newInterview;
    }
}
