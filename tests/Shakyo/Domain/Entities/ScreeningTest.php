<?php

use PHPUnit\Framework\TestCase;
use Shakyo\Domain\Entities\Screening;
use Shakyo\Domain\ValueObjects\ScreeningStatus;

class ScreeningTest extends TestCase
{
    public function testNewInstancePreInterview()
    {
        $emailAddress = 'preinterview@example.com';
        $screening = Screening::startFromPreInterview($emailAddress);

        $this->assertInstanceOf(Screening::class, $screening);
        $this->assertEquals($emailAddress, $screening->getApplicantEmailAddress()->getValue());
        $this->assertEquals(ScreeningStatus::NotApplied, $screening->getScreeningStatus());
        $this->assertNull($screening->getApplyDateTime());
        $this->assertEquals(0, count($screening->getInterviews()->all()));
    }

    public function testNewInstanceApply()
    {
        $emailAddress = 'applicant@example.com';
        $screening = Screening::startFromApply($emailAddress);

        $this->assertInstanceOf(Screening::class, $screening);
        $this->assertEquals($emailAddress, $screening->getApplicantEmailAddress()->getValue());
        $this->assertEquals(ScreeningStatus::Interview, $screening->getScreeningStatus());

        $now = new DateTime();
        $format = 'YmdHis';
        $this->assertEquals($now->format($format), $screening->getApplyDateTime()->format($format));
    }

    public function testAddInterviewRaiseException()
    {

        $emailAddress = 'test@example.com';
        $screening = Screening::startFromPreInterview($emailAddress);

        $this->expectException(Exception::class);
        $screening->addNextInterview(new DateTime('2022-07-25 13:30:00'));
    }

    public function testAddInterview()
    {
        $emailAddress = 'test@example.com';
        $screening = Screening::startFromApply($emailAddress);

        $screening->addNextInterview(new DateTime('2022-07-25 13:30:00'));
        $this->assertEquals(1, count($screening->getInterviews()->all()));
    }
}
