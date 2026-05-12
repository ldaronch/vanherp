<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmergencyPhoneAndMailingAddressToContactSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('config_settings', function (Blueprint $table) {
            $table->string('emergency_phone')->nullable()->after('whatsapp');
            $table->string('mailing_address')->nullable()->after('zip_code');
        });
    }

    public function down()
    {
        Schema::table('config_settings', function (Blueprint $table) {
            $table->dropColumn(['emergency_phone', 'mailing_address']);
        });
    }
}
