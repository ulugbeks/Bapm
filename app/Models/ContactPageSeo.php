<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPageSeo extends Model
{
    use HasFactory;

    protected $table = 'contact_page_seo';

    protected $fillable = [
        'seo_title',
        'seo_description',
    ];
}