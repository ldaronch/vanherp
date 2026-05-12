<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToContentsTable extends Migration
{
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->index()->after('section');
        });
    }

    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}

