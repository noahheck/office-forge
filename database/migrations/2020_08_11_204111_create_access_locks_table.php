<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessLocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_type_access_locks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('file_type_id');
            $table->string('name');
            $table->text('details')->nullable();

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
        Schema::dropIfExists('file_type_access_locks');
    }
}
