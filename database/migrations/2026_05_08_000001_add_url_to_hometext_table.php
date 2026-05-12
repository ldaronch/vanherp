<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlToHometextTable extends Migration
{
    public function up()
    {
        Schema::table('hometext', function (Blueprint $table) {
            $table->string('url')->nullable()->after('text');
        });
    }

    public function down()
    {
        Schema::table('hometext', function (Blueprint $table) {
            $table->dropColumn('url');
        });
    }
}

