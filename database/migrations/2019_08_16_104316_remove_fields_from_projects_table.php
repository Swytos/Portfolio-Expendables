<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldsFromProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('team_size');
            $table->dropColumn('platform');
            $table->dropColumn('skills');
            $table->dropColumn('timeline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('image');
            $table->string('team_size');
            $table->string('platform');
            $table->string('skills');
            $table->string('timeline');
        });
    }
}
