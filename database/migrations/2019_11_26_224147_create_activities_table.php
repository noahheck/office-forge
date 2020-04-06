<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('process_id')->nullable();
            $table->string('process_name', '1024')->nullable();
            $table->string('name', '1024');
            $table->date('due_date')->nullable();
            $table->bigInteger('owner_id')->nullable();
            $table->bigInteger('file_id')->nullable();
            $table->longText('process_details')->nullable();
            $table->longText('details')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('completed')->default(false);

            $table->bigInteger('created_by');
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
            $table->bigInteger('completed_by')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
