<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDocTemplateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_doc_template_fields', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('form_doc_template_id');
            $table->string('field_type');
            $table->string('label');
            $table->string('placeholder')->nullable();
            $table->text('description')->nullable();
            $table->boolean('separator')->default(false);
            $table->boolean('active')->default(true);
            $table->integer('order');
            $table->json('options')->nullable();

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
        Schema::dropIfExists('form_doc_template_fields');
    }
}
