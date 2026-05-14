<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('circular_guideline_items', function (Blueprint $table) {
            if (!Schema::hasColumn('circular_guideline_items', 'file_path')) {
                $table->string('file_path')->nullable()->after('url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('circular_guideline_items', function (Blueprint $table) {
            if (Schema::hasColumn('circular_guideline_items', 'file_path')) {
                $table->dropColumn('file_path');
            }
        });
    }
};
