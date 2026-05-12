<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameContactSettingsTableToConfigSettings extends Migration
{
    public function up()
    {
        if (Schema::hasTable('contact_settings') && !Schema::hasTable('config_settings')) {
            Schema::rename('contact_settings', 'config_settings');
        }
    }

    public function down()
    {
        if (Schema::hasTable('config_settings') && !Schema::hasTable('contact_settings')) {
            Schema::rename('config_settings', 'contact_settings');
        }
    }
}

