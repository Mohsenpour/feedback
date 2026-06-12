<?php

namespace App\Enums;

enum FeedbackStatus: string
{
    case Submitted = 'submitted';
    case InReview = 'in_review';
    case Resolved = 'resolved';

    public function label(): string
    {
        return match ($this) {
            self::Submitted => 'Submitted',
            self::InReview => 'In Review',
            self::Resolved => 'Resolved',
        };
    }
}
