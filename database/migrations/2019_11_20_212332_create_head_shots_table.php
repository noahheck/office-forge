<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadShotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('head_shots', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->morphs('headshottable');

            $table->boolean('current')->default(false);
            $table->string('filename')->nullable();
            $table->string('thumb_filename')->nullable();
            $table->string('icon_filename')->nullable();
            $table->string('original_filename')->nullable();
            $table->string('type');
            $table->string('extension');
            $table->bigInteger('uploaded_by');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('head_shots');
    }
}
