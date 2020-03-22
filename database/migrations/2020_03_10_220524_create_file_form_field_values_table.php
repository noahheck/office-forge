<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileFormFieldValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_formfield_values', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('file_id');
            $table->bigInteger('file_type_form_field_id');
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
        Schema::dropIfExists('file_formfield_values');
    }
}
