<?php

namespace App\Helpers;

use App\Models\SecurityLog;

class SecurityHelper
{
    // Function to log security events
    public static function logEvent($description)
    {
        // Create a new log entry in the database with the description provided
        SecurityLog::create([
            'description' => $description,
            'status' => 'unresolved', // Default status for new logs
            'type' => 'login_attempt', // specifying the type here
        ]);
    }
}
