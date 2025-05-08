<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'button_text',
        'working_hours',
        'active',
    ];

    protected $casts = [
        'working_hours' => 'json',
        'active' => 'boolean',
    ];
}