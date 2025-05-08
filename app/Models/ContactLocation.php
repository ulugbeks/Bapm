<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'email',
        'phone',
    ];
}