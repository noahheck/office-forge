<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_files', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->morphs('resource');
            $table->string('name');
            $table->string('mimetype');
            $table->string('filename')->nullable();
            $table->string('original_filename');
            $table->bigInteger('filesize');
            $table->bigInteger('uploaded_by');

            $table->timestamps();

            $table->bigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('resource_files');
    }
}
