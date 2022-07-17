<?php

namespace Shakyo\Domain\Entities;

use DateTime;
use Exception;
use Shakyo\Domain\ValueObjects\EmailAddress;
use Shakyo\Domain\ValueObjects\Interviews;
use Shakyo\Domain\ValueObjects\ScreeningStatus;

class Screening
{
    private string $screeningId;
    private ?DateTime $applyDateTime;
    private ScreeningStatus $status;
    private EmailAddress $applicantEmailAddress;
    private Interviews $interviews;

    private function __construct()
    {
    }

    /**
     * "面談" から始まる選考の場合の Screening を生成する
     */
    public static function startFromPreInterview(string $applicantEmailAddress): static
    {
        $instance = static::createNewInstance($applicantEmailAddress);

        $instance->applyDateTime = null;
        $instance->status = ScreeningStatus::NotApplied;

        return $instance;
    }

    /**
     * "応募" してきた場合の Screening を生成する
     */
    public static function startFromApply(string $applicantEmailAddress): static
    {
        $instance = static::createNewInstance($applicantEmailAddress);

        $instance->applyDateTime = new DateTime();
        $instance->status = ScreeningStatus::Interview;

        return $instance;
    }

    protected static function createNewInstance(string $applicantEmailAddress): static
    {
        $instance = new static();
        // 各プロパティに値をセット
        // ID
        $instance->screeningId = uniqid();
        // メールアドレス
        $instance->applicantEmailAddress = new EmailAddress($applicantEmailAddress);
        // 面接
        $instance->interviews = new Interviews();
        // 応募日時とステータスは、"面談"スタートか"応募"スタートかでちがうので、個々の生成メソッドでセットする

        return $instance;
    }

    public function getScreeningId(): string
    {
        return $this->screeningId;
    }

    public function getApplyDateTime(): ?DateTime
    {
        return $this->applyDateTime;
    }

    public function getScreeningStatus(): ScreeningStatus
    {
        return $this->status;
    }

    public function getApplicantEmailAddress(): EmailAddress
    {
        return $this->applicantEmailAddress;
    }

    public function getInterviews(): Interviews
    {
        return $this->interviews;
    }

    public function addNextInterview(DateTime $nextInterviewDateTime): void
    {
        if (!$this->status->canAddInterview()) {
            throw new Exception('面接設定できないステータス');
        }

        $this->interviews->addNextInterview($nextInterviewDateTime);
    }
}
