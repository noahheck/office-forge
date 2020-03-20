<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileTypeFormFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_type_form_fields', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('file_type_form_id');
            $table->string('field_type');
            $table->string('label');
            $table->string('placeholder')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('order');
            $table->json('options')->nullable();
            $table->boolean('panel_display')->default(false);

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
        Schema::dropIfExists('file_type_form_fields');
    }
}
