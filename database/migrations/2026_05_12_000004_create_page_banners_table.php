<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageBannersTable extends Migration
{
    public function up()
    {
        Schema::create('page_banners', function (Blueprint $table) {
            $table->id();
            $table->string('page');
            $table->string('image');
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();

            $table->index(['page', 'is_active']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_banners');
    }
}

