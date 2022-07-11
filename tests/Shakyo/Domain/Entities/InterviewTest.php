<?php

use PHPUnit\Framework\TestCase;
use Shakyo\Domain\Entities\Interview;

class InterviewTest extends TestCase
{
    public function testNewInstance()
    {
        $number = 2;
        $datetime = new DateTime('2022-07-24 16:30:00');
        $interview = Interview::createNewInstance($number, $datetime);

        $this->assertEquals($number, $interview->getInterviewNumber());
    }
}
