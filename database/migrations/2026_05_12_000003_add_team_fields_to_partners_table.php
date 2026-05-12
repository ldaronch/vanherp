<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeamFieldsToPartnersTable extends Migration
{
    public function up()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->string('role')->nullable()->after('name');
            $table->longText('bio')->nullable()->after('role');
            $table->string('email')->nullable()->after('bio');
            $table->string('mobile')->nullable()->after('email');
            $table->integer('priority')->default(0)->index()->after('mobile');
            $table->boolean('is_active')->default(true)->index()->after('priority');
        });
    }

    public function down()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn(['role', 'bio', 'email', 'mobile', 'priority', 'is_active']);
        });
    }
}

