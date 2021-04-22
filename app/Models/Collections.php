<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;


class Collections extends Model
{
    use HasFactory ,Sluggable;

    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];
 

    public function categories() {
        return $this->belongsTo('Category');
    }

    public function products() {
        return $this->hasManyThrough('App\Product', 'App\Category','collection_id','category_id','id');
    }
}
