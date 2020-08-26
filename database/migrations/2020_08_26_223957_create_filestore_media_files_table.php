<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilestoreMediaFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filestore_media_files', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('drive_id');
            $table->bigInteger('folder_id')->nullable();
            $table->string('name');
            $table->string('mimetype');
            $table->string('filename');
            $table->string('original_filename');
            $table->bigInteger('filesize');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('filestore_media_files');
    }
}
