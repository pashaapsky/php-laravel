<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrantUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grant_user', function (Blueprint $table) {
            $table->unsignedBigInteger('grant_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['grant_id', 'user_id']);
            $table->foreign('grant_id')->references('id')->on('grants')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grant_user');
    }
}
