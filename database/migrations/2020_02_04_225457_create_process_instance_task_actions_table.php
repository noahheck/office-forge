<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessInstanceTaskActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_instance_task_actions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('process_instance_task_id');
            $table->bigInteger('process_task_action_id');
            $table->string('action_name');
            $table->mediumText('action_details')->nullable();
            $table->mediumText('details')->nullable();
            $table->integer('order');
            $table->boolean('completed')->default(false);
            $table->dateTime('completed_at')->nullable();
            $table->bigInteger('completed_by')->nullable();

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
        Schema::dropIfExists('process_instance_task_actions');
    }
}
