<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_title',
        'schedule_date',
        'number_of_member',
        'price',
    ];

    /**
     * Get the user that owns the appointment session.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the members for the appointment session.
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }
    
    public function memberCount()
    {
        return $this->members()->count();
    }
}
