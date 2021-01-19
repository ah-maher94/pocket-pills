<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfo', function (Blueprint $table) {
            $table->integer('userId', true);
            $table->string('userName', 25);
            $table->string('userEmail', 55);
            $table->string('userPassword', 300);
            $table->string('userPhone', 15);
            $table->enum('userRole', ['admin', 'superAdmin', 'user', 'guest'])->nullable()->default('guest');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userinfo');
    }
}
