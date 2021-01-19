<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserfavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userfavorite', function (Blueprint $table) {
            $table->foreign('userId', 'userfavorite_ibfk_1')->references('userId')->on('userinfo')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('productCode', 'userfavorite_ibfk_2')->references('productCode')->on('productinfo')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userfavorite', function (Blueprint $table) {
            $table->dropForeign('userfavorite_ibfk_1');
            $table->dropForeign('userfavorite_ibfk_2');
        });
    }
}
