<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreateAndReviewColumnsToTemplateTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_doc_templates_teams', function (Blueprint $table) {

            $table->boolean('create')->after('team_id')->default(false)->nullable();
            $table->boolean('review')->after('create')->default(false)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_doc_templates_teams', function (Blueprint $table) {
            $table->dropColumn([
                'create',
                'review',
            ]);
        });
    }
}
