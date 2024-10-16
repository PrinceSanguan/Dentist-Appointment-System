<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'appointment_session_id',
        'date',
        'title',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
