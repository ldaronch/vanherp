<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiClubSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('pi_club_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pi_club_sections');
    }
}

