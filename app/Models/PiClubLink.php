<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiClubLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'pi_club_section_id',
        'name',
        'url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(PiClubSection::class, 'pi_club_section_id');
    }
}
