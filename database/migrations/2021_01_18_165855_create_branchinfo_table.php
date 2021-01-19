<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchinfo', function (Blueprint $table) {
            $table->integer('branchId', true);
            $table->integer('pharmacyId')->index('pharmacyId');
            $table->string('branchOwner', 55);
            $table->string('branchCountry', 22);
            $table->string('branchCity', 15);
            $table->string('branchregion', 44)->nullable();
            $table->string('branchStreet', 44)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branchinfo');
    }
}
