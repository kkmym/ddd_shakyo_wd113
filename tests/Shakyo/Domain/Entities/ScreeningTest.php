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
        $this->assertEquals($emailAddress, $screening->getApplicantEmailAddress());
        $this->assertEquals(ScreeningStatus::NotApplied, $screening->getScreeningStatus());
        $this->assertNull($screening->getApplyDateTime());
    }

    public function testNewInstanceApply()
    {
        $emailAddress = 'applicant@example.com';
        $screening = Screening::startFromApply($emailAddress);

        $this->assertInstanceOf(Screening::class, $screening);
        $this->assertEquals($emailAddress, $screening->getApplicantEmailAddress());
        $this->assertEquals(ScreeningStatus::Interview, $screening->getScreeningStatus());

        $now = new DateTime();
        $format = 'YmdHi'; // もしインスタンス生成とassertメソッド実行が 1秒以上ズレても比較成功するよう、分までで比較
        $this->assertEquals($now->format($format), $screening->getApplyDateTime()->format($format));
    }
}
