<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageSeo extends Model
{
    use HasFactory;

    protected $table = 'home_page_seo';

    protected $fillable = [
        'seo_title',
        'seo_description',
    ];
}