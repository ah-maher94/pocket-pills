<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsercartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usercart', function (Blueprint $table) {
            $table->foreign('userId', 'usercart_ibfk_1')->references('userId')->on('userinfo')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('productCode', 'usercart_ibfk_2')->references('productCode')->on('productinfo')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usercart', function (Blueprint $table) {
            $table->dropForeign('usercart_ibfk_1');
            $table->dropForeign('usercart_ibfk_2');
        });
    }
}
