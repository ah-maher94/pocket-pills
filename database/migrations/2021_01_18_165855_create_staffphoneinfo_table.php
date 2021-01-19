<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffphoneinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffphoneinfo', function (Blueprint $table) {
            $table->integer('staffId');
            $table->string('staffPhone', 22);
            $table->primary(['staffId', 'staffPhone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffphoneinfo');
    }
}
