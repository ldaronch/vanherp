<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['primary_text', 'title', 'subtitle', 'text', 'image', 'section', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
