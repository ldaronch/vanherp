<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'bio',
        'email',
        'mobile',
        'priority',
        'is_active',
        'logo',
        'link',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
