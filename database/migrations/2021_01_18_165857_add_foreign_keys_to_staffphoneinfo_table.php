<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStaffphoneinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staffphoneinfo', function (Blueprint $table) {
            $table->foreign('staffId', 'staffphoneinfo_ibfk_1')->references('staffId')->on('staffinfo')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staffphoneinfo', function (Blueprint $table) {
            $table->dropForeign('staffphoneinfo_ibfk_1');
        });
    }
}
