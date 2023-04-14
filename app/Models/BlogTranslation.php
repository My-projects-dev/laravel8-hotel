<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class BlogTranslation extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['slug', 'title','content','language','blog_id'];

    public function parentBlog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
