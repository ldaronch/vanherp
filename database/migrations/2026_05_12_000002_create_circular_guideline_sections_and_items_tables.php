<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircularGuidelineSectionsAndItemsTables extends Migration
{
    public function up()
    {
        Schema::create('circular_guideline_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('note')->nullable();
            $table->boolean('show_note')->default(false)->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('circular_guideline_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('circular_guideline_sections')->cascadeOnDelete();
            $table->string('name');
            $table->string('url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('circular_guideline_items');
        Schema::dropIfExists('circular_guideline_sections');
    }
}

