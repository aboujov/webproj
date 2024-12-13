<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'host_id',
        'status',
        'location',
    ];

    // Relationship with User (Host)
    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }
}

