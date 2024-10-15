<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'appointment_session_id',
    ];

    /**
     * Get the appointment session that the member belongs to.
     */
    public function appointmentSession()
    {
        return $this->belongsTo(AppointmentSession::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}