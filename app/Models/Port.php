<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'is_active', 'location', 'description', 'image'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
