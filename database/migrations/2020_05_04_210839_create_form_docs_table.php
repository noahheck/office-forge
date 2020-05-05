<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_docs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('file_type_id')->nullable();
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->dateTime('last_created_at')->nullable();
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
        Schema::dropIfExists('form_docs');
    }
}
