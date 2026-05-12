<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('circulars', function (Blueprint $table) {
            if (!Schema::hasColumn('circulars', 'url')) {
                $table->string('url', 2048)->nullable()->after('description');
            }
        });

        Schema::table('guidelines', function (Blueprint $table) {
            if (!Schema::hasColumn('guidelines', 'url')) {
                $table->string('url', 2048)->nullable()->after('file_path');
            }
        });
    }

    public function down(): void
    {
        Schema::table('circulars', function (Blueprint $table) {
            if (Schema::hasColumn('circulars', 'url')) {
                $table->dropColumn('url');
            }
        });

        Schema::table('guidelines', function (Blueprint $table) {
            if (Schema::hasColumn('guidelines', 'url')) {
                $table->dropColumn('url');
            }
        });
    }
};
