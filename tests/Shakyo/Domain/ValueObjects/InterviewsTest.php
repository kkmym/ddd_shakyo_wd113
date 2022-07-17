<?php

use PHPUnit\Framework\TestCase;
use Shakyo\Domain\Entities\Interview;
use Shakyo\Domain\ValueObjects\Interviews;

class InterviewsTest extends TestCase
{
    public function testConstructEmpty()
    {
        $interviews = new Interviews();
        $this->assertEmpty($interviews->all());
        $this->assertIsArray($interviews->all());
    }

    public function testConstructSomeInterviews()
    {
        $interview1 = Interview::createNewInstance(1, new DateTime('2022-07-21 17:00:00'));
        $interview2 = Interview::createNewInstance(2, new DateTime('2022-07-30 19:30:00'));;

        $interviews = new Interviews(...[$interview1, $interview2]);
        $this->assertIsArray($interviews->all());
        $this->assertCount(2, $interviews->all());

        foreach ($interviews->all() as $i) {
            $this->assertTrue($i instanceof Interview);
        }
    }

    public function testConstructInvalidInterviews()
    {
        $this->expectErrorMessageMatches('/.+must be of type.+given.+/');

        $interview1 = new DateTime('2022-07-21 17:00:00');
        $interview2 = Interview::createNewInstance(2, new DateTime('2022-07-30 19:30:00'));;

        $interviews = new Interviews(...[$interview1, $interview2]);
    }
}
