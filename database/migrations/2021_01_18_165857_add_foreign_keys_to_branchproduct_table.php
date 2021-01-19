<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBranchproductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branchproduct', function (Blueprint $table) {
            $table->foreign('branchId', 'branchproduct_ibfk_1')->references('branchId')->on('branchinfo')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('productCode', 'branchproduct_ibfk_2')->references('productCode')->on('productinfo')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pharmacyId', 'branchproduct_ibfk_3')->references('pharmacyId')->on('pharmacyinfo')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branchproduct', function (Blueprint $table) {
            $table->dropForeign('branchproduct_ibfk_1');
            $table->dropForeign('branchproduct_ibfk_2');
            $table->dropForeign('branchproduct_ibfk_3');
        });
    }
}
