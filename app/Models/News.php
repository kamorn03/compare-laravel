<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'path_img', 
        'company_name',
        'type',
        'news_content',
        'news_detail',
        'created_at',
        'updated_at',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'path_img_detail'
    ];
}
