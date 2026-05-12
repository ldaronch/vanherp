<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    use HasFactory;

    protected $table = 'config_settings';

    protected $fillable = [
        'site_title',
        'email_leads',
        'email_display',
        'phone',
        'cellphone',
        'whatsapp',
        'emergency_phone',
        'address',
        'city',
        'state',
        'zip_code',
        'mailing_address',
        'maps_iframe',
        'working_hours',
        'copyright_text',
    ];
}
