<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlAndIsActiveToPortsTable extends Migration
{
    public function up()
    {
        Schema::table('ports', function (Blueprint $table) {
            $table->string('url')->nullable()->after('name');
            $table->boolean('is_active')->default(true)->index()->after('url');
        });
    }

    public function down()
    {
        Schema::table('ports', function (Blueprint $table) {
            $table->dropColumn(['url', 'is_active']);
        });
    }
}

