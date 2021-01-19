<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInvoicedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoicedetails', function (Blueprint $table) {
            $table->foreign('invNo', 'invoicedetails_ibfk_1')->references('invNo')->on('userinv')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('productCode', 'invoicedetails_ibfk_2')->references('productCode')->on('productinfo')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoicedetails', function (Blueprint $table) {
            $table->dropForeign('invoicedetails_ibfk_1');
            $table->dropForeign('invoicedetails_ibfk_2');
        });
    }
}
