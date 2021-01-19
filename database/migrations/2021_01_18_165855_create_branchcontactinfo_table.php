<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchcontactinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchcontactinfo', function (Blueprint $table) {
            $table->integer('pharmacyId')->index('pharmacyId');
            $table->integer('branchId')->primary();
            $table->string('phoneNumber', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branchcontactinfo');
    }
}
