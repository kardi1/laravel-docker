<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersaccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('usersaccesses');

        Schema::create('usersaccesses', function (Blueprint $table) {
            $table->id();
            $table->timestamp('last_login')->nullable();
            $table->bigInteger('user_id')->unsigned();
        });

        Schema::table('usersaccesses', function($table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usersaccesses');
    }
}
