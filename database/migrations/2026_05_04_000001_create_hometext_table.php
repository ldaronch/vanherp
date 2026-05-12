<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHometextTable extends Migration
{
    public function up()
    {
        Schema::create('hometext', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('text')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hometext');
    }
}

