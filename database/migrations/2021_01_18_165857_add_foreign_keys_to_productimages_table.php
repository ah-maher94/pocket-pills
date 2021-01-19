<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productimages', function (Blueprint $table) {
            $table->foreign('productCode', 'productimages_ibfk_1')->references('productCode')->on('productinfo')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productimages', function (Blueprint $table) {
            $table->dropForeign('productimages_ibfk_1');
        });
    }
}
