<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_title',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'logo',
        'logo_white',
        'favicon',
        'email',
        'phone',
        'address',
        'working_hours',
        'facebook',
        'twitter',
        'linkedin',
        'whatsapp',
        'map_url',
        'footer_cta_title',
        'newsletter_text',
    ];
}