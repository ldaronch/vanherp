<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakePostsCategoryNullableAndAddIsFeaturedToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->index()->after('is_published');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE posts MODIFY category_id BIGINT UNSIGNED NULL');
        }

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE posts MODIFY category_id BIGINT UNSIGNED NOT NULL');
        }

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->dropColumn('is_featured');
        });
    }
}

