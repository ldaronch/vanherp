<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrimaryTextToContentsTable extends Migration
{
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->string('primary_text')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('primary_text');
        });
    }
}

