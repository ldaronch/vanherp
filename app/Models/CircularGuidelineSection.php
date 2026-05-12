<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CircularGuidelineSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'note',
        'show_note',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'show_note' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(CircularGuidelineItem::class, 'section_id')->orderBy('sort_order')->orderBy('name');
    }
}

