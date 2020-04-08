<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_participants', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('activity_id');
            $table->bigInteger('user_id');
            $table->bigInteger('added_by');
            $table->timestamps();
            $table->dateTime('removed_at')->nullable();
            $table->bigInteger('removed_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_participants');
    }
}
