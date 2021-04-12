<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMSAdminManage extends Model
{
    use HasFactory;   
    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keyword', 
        'title',
        'content', 
        'contact', 
        'detail',
        'name',
        'path_img',
        'path_img_banner',
        'page_type',
    ];

    protected $casts = [
        'contact' => 'array',
    ];

}
