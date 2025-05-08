<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'additional_title',
        'additional_description',
        'seo_title',  
        'seo_description', 
    ];
}