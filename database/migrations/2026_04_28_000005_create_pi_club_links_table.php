<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiClubLinksTable extends Migration
{
    public function up()
    {
        Schema::create('pi_club_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pi_club_section_id')->constrained('pi_club_sections')->cascadeOnDelete();
            $table->string('name');
            $table->string('url');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pi_club_links');
    }
}

