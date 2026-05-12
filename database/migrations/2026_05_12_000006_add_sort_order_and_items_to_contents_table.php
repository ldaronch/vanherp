<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSortOrderAndItemsToContentsTable extends Migration
{
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->text('items')->nullable()->after('text');
            $table->unsignedInteger('sort_order')->default(0)->index()->after('section');
        });
    }

    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('items');
            $table->dropColumn('sort_order');
        });
    }
}

