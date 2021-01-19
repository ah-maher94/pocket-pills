<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchproductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchproduct', function (Blueprint $table) {
            $table->integer('pharmacyId');
            $table->string('productCode', 77)->index('productCode');
            $table->integer('branchId')->index('branchId');
            $table->integer('productQuantity')->nullable()->default(0);
            $table->primary(['pharmacyId', 'productCode', 'branchId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branchproduct');
    }
}
