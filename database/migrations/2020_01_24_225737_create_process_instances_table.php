<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_instances', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('process_id');
            $table->bigInteger('owner_id')->nullable();
            $table->string('process_name');
            $table->text('process_details');
            $table->string('name');
            $table->text('details')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('completed')->default(false);
            $table->dateTime('completed_at')->nullable();
            $table->bigInteger('completed_by')->nullable();
            $table->bigInteger('created_by');

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
        Schema::dropIfExists('process_instances');
    }
}
