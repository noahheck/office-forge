<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportDatasetFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_dataset_fields', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('dataset_id');
            $table->string('template_field_type');
            $table->string('field_type');
            $table->string('field_id');
            $table->string('label')->nullable();
            $table->bigInteger('order');

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
        Schema::dropIfExists('report_dataset_fields');
    }
}
