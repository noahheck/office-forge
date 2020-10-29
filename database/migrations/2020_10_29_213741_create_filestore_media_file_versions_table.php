<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilestoreMediaFileVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filestore_media_file_versions', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->bigInteger('media_file_id');
            $table->bigInteger('uploaded_by');
            $table->string('mimetype');
            $table->string('filename')->nullable();
            $table->string('original_filename');
            $table->bigInteger('filesize');
            $table->boolean('current_version')->default(false);

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
        Schema::dropIfExists('filestore_media_file_versions');
    }
}
