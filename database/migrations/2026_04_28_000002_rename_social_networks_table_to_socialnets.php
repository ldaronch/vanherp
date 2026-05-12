<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameSocialNetworksTableToSocialnets extends Migration
{
    public function up()
    {
        if (Schema::hasTable('social_networks') && !Schema::hasTable('socialnets')) {
            Schema::rename('social_networks', 'socialnets');
        }
    }

    public function down()
    {
        if (Schema::hasTable('socialnets') && !Schema::hasTable('social_networks')) {
            Schema::rename('socialnets', 'social_networks');
        }
    }
}

