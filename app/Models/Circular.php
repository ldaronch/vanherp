<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'description'];

    public function attachments()
    {
        return $this->hasMany(CircularAttachment::class);
    }
}
