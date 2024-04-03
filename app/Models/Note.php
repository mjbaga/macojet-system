<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    public $fillable = [
        'type',
        'content',
        'noteable_type',
        'noteable_id',
        'reminder_alarm',
    ];

    public static array $types = [
        'note',
        'reminder',
    ];

    public function noteable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'noteable_type', 'noteable_id');
    }
}
