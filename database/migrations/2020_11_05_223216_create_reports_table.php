<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('file_type_id')->nullable();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->boolean('active')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('reports_teams', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('report_id');
            $table->bigInteger('team_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
        Schema::dropIfExists('reports_teams');
    }
}
