<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffinfo', function (Blueprint $table) {
            $table->integer('staffId', true);
            $table->integer('branchId')->index('branchId');
            $table->string('staffName', 55);
            $table->integer('salary');
            $table->date('firingDate')->nullable();
            $table->date('hiringDate');
            $table->string('staffDepartment', 55);
            $table->string('staffEmail', 55);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffinfo');
    }
}
