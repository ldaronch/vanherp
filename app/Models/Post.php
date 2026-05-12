<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'date', 'title', 'header_line', 'slug', 'content', 'image', 'is_published', 'is_featured'];

    protected $casts = [
        'date' => 'date',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
