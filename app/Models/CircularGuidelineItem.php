<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CircularGuidelineItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'name',
        'url',
        'file_path',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(CircularGuidelineSection::class, 'section_id');
    }
}
