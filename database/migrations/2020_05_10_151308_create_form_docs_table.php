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

            $table->bigInteger('form_doc_template_id');
            $table->bigInteger('file_id')->nullable();
            $table->bigInteger('creator_id');
            $table->string('name');
            $table->dateTime('published_at')->nullable();

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
