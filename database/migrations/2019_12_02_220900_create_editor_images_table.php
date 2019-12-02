<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditorImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editor_images', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('filename')->nullable();
            $table->string('original_filename');
            $table->string('type');
            $table->string('resource_type');
            $table->string('resource_temp_id')->nullable();
            $table->string('resource_id')->nullable();
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
        Schema::dropIfExists('editor_images');
    }
}
