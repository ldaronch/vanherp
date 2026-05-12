<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    use HasFactory;

    protected $table = 'socialnets';

    protected $fillable = ['name', 'url', 'icon', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
