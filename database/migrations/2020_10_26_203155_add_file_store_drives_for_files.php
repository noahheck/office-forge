<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileStoreDrivesForFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filestore_drives', function (Blueprint $table) {

            $table->bigInteger('file_type_id')->after('id')->nullable();

        });

        Schema::table('filestore_folders', function (Blueprint $table) {

            $table->bigInteger('file_id')->after('drive_id')->nullable();

        });

        Schema::table('filestore_media_files', function (Blueprint $table) {

            $table->bigInteger('file_id')->after('drive_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filestore_drives', function (Blueprint $table) {

            $table->dropColumn([
                'file_type_id',
            ]);

        });

        Schema::table('filestore_folders', function (Blueprint $table) {

            $table->dropColumn([
                'file_id',
            ]);

        });

        Schema::table('filestore_media_files', function (Blueprint $table) {

            $table->dropColumn([
                'file_id',
            ]);

        });
    }
}
