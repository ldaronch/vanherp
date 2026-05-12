<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiClubSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function links()
    {
        return $this->hasMany(PiClubLink::class)->orderBy('sort_order');
    }
}
