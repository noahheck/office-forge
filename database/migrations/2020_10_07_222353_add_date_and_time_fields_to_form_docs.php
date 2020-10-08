<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateAndTimeFieldsToFormDocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_docs', function (Blueprint $table) {

            $table->date('date')->after('name')->nullable();
            $table->time('time')->after('date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_docs', function (Blueprint $table) {

            $table->dropColumn(['date', 'time']);

        });
    }
}
