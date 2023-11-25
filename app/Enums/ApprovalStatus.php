<?php

namespace App\Enums;

enum ApprovalStatus: string
{
    case STATUS_WAITING_FOR_APPROVAL = "waiting for approval";
    case STATUS_APPROVED = "approved";
    case STATUS_REJECTED = "rejected";

    public function toString(): string
    {
        return match ($this){
            self::STATUS_APPROVED => "Approved",
            self::STATUS_REJECTED => "Rejected",
            default => "Waiting approval"
        };
    }

    public function color(): string
    {
        return match ($this){
            self::STATUS_APPROVED => "green",
            self::STATUS_REJECTED => "red",
            default => "orange"
        };
    }

    public function approved(): bool
    {
        return $this == self::STATUS_APPROVED;
    }

    public function rejected(): bool
    {
        return $this == self::STATUS_REJECTED;
    }

    public function pending(): bool
    {
        return $this == self::STATUS_WAITING_FOR_APPROVAL;
    }

}
