<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CircularAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['circular_id', 'file_path', 'original_name'];

    public function circular()
    {
        return $this->belongsTo(Circular::class);
    }
}
