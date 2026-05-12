<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->string('email_leads')->nullable();
            $table->string('email_display')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('maps_iframe')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('copyright_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_settings');
    }
}
