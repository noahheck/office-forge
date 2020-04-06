<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('activity_id');
            $table->bigInteger('process_task_id')->nullable();
            $table->string('title', 1024);
            $table->longText('details')->nullable();
            $table->longText('process_task_details')->nullable();
            $table->date('due_date')->nullable();
            $table->bigInteger('assigned_to')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
