<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_title', 'email_leads', 'email_display', 'phone', 'cellphone', 'whatsapp', 'address', 'city', 'state', 'zip_code', 'maps_iframe', 'working_hours', 'copyright_text'
    ];
}
