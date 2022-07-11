<?php

namespace Shakyo\Domain\Entities;

use DateTime;
use Shakyo\Domain\ValueObjects\InterviewResult;

class Interview
{
    private string $interviewId;
    private int $interviewNumber;
    private DateTime $interviewDateTime;
    private InterviewResult $result;

    private function __construct()
    {
    }

    public static function createNewInstance(int $interviewNumber, DateTime $interviewDateTime): static
    {
        $instance = new static();
        $instance->interviewId = uniqid();
        $instance->interviewNumber = $interviewNumber;
        $instance->interviewDateTime = $interviewDateTime;
        $instance->result = InterviewResult::NotEvaluated;

        return $instance;
    }

    public function getInterviewId(): string
    {
        return $this->interviewId;
    }

    public function getInterviewNumber(): int
    {
        return $this->interviewNumber;
    }

    public function getInterviewDate(): DateTime
    {
        return $this->interviewDateTime;
    }

    public function getInterviewResult(): InterviewResult
    {
        return $this->result;
    }
}
