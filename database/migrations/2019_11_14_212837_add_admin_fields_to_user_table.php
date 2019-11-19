<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminFieldsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->boolean('force_password_change')->after('password')->default(false);
            $table->string('job_title')->nullable();
            $table->string('timezone');
            $table->string('color');
            $table->boolean('active')->default(true);
            $table->boolean('administrator')->default(false);
            $table->boolean('system_administrator')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'force_password_change',
                'job_title',
                'timezone',
                'active',
                'administrator',
                'system_administrator',
            ]);
        });
    }
}
