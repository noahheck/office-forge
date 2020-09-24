<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backups', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->boolean('successful')->default(false);
            $table->string('filename')->nullable();
            $table->bigInteger('filesize')->nullable();
            $table->dateTime('started');
            $table->dateTime('completed')->nullable();
            $table->text('error')->nullable();

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
        Schema::dropIfExists('backups');
    }
}
