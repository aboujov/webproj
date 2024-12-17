<?php

namespace App\Helpers;

use App\Models\SecurityLog;

class SecurityHelper
{
    public static function logEvent($description)
    {
        SecurityLog::create([
            'description' => $description,
            'status' => 'unresolved',
            'type' => 'login_attempt',
        ]);
    }
}
