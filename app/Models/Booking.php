<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'guest_id',
        'start_date',
        'end_date',
        'status',
        'location',
    ];

    // Relationship with Property
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Relationship with User (Guest)
    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }


}

