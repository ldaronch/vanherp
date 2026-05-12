<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdatePiClubsTablesForPublicPageAndToggles extends Migration
{
    public function up()
    {
        Schema::table('pi_club_sections', function (Blueprint $table) {
            if (!Schema::hasColumn('pi_club_sections', 'text')) {
                $table->longText('text')->nullable()->after('title');
            }
            if (!Schema::hasColumn('pi_club_sections', 'is_active')) {
                $table->boolean('is_active')->default(true)->index()->after('sort_order');
            }
        });

        Schema::table('pi_club_links', function (Blueprint $table) {
            if (!Schema::hasColumn('pi_club_links', 'is_active')) {
                $table->boolean('is_active')->default(true)->index()->after('sort_order');
            }
        });

        if (Schema::hasColumn('pi_club_links', 'url')) {
            $driver = DB::getDriverName();
            if (in_array($driver, ['mysql', 'mariadb'], true)) {
                DB::statement('ALTER TABLE `pi_club_links` MODIFY `url` VARCHAR(255) NULL');
            }
        }
    }

    public function down()
    {
        Schema::table('pi_club_links', function (Blueprint $table) {
            if (Schema::hasColumn('pi_club_links', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });

        Schema::table('pi_club_sections', function (Blueprint $table) {
            if (Schema::hasColumn('pi_club_sections', 'is_active')) {
                $table->dropColumn('is_active');
            }
            if (Schema::hasColumn('pi_club_sections', 'text')) {
                $table->dropColumn('text');
            }
        });
    }
}

