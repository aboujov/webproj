<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'description', 'status'];

    public static function logEvent($userId, $event, $details) {
        SecurityLog::create([
            'user_id' => $userId,
            'event' => $event,
            'details' => $details,
            'status' => 'pending',  // You can set the initial status as 'pending'
        ]);
    }
}

