<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStaffinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staffinfo', function (Blueprint $table) {
            $table->foreign('branchId', 'staffinfo_ibfk_1')->references('branchId')->on('branchinfo')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staffinfo', function (Blueprint $table) {
            $table->dropForeign('staffinfo_ibfk_1');
        });
    }
}
