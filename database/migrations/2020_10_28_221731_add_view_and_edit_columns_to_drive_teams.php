<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewAndEditColumnsToDriveTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filestore_drives_teams', function (Blueprint $table) {

            $table->boolean('view')->after('team_id')->default(false)->nullable();
            $table->boolean('edit')->after('view')->default(false)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filestore_drives_teams', function (Blueprint $table) {
            $table->dropColumn([
                'view',
                'edit',
            ]);
        });
    }
}
