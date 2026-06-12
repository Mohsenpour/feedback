<?php

namespace App\Models;

use App\Enums\FeedbackStatus;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'title',
        'message',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => FeedbackStatus::class,
        ];
    }
}
