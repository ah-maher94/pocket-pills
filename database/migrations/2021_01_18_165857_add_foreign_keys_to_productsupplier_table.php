<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductsupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productsupplier', function (Blueprint $table) {
            $table->foreign('supplierId', 'productsupplier_ibfk_1')->references('supplierId')->on('suppliers')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('productCode', 'productsupplier_ibfk_2')->references('productCode')->on('productinfo')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productsupplier', function (Blueprint $table) {
            $table->dropForeign('productsupplier_ibfk_1');
            $table->dropForeign('productsupplier_ibfk_2');
        });
    }
}
