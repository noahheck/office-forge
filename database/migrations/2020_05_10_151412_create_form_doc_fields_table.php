<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDocFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_doc_fields', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('form_doc_id');
            $table->bigInteger('form_doc_template_field_id');
            $table->string('field_type');
            $table->string('label');
            $table->text('description')->nullable();
            $table->boolean('separator')->default(false);
            $table->boolean('active')->default(true);
            $table->integer('order');
            $table->json('options')->nullable();
            $table->bigInteger('value_integer')->nullable();
            $table->bigInteger('value_user')->nullable();
            $table->bigInteger('value_file')->nullable();
            $table->decimal('value_decimal', 13, 4)->nullable();
            $table->boolean('value_boolean')->nullable();
            $table->date('value_date')->nullable();
            $table->string('value_text1')->nullable();
            $table->string('value_text2')->nullable();
            $table->string('value_text3')->nullable();
            $table->string('value_text4')->nullable();
            $table->string('value_text5')->nullable();
            $table->string('value_text6')->nullable();
            $table->longText('value_longtext')->nullable();

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
        Schema::dropIfExists('form_doc_fields');
    }
}
