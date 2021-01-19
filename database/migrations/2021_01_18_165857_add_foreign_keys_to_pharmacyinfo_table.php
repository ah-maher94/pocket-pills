<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPharmacyinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmacyinfo', function (Blueprint $table) {
            $table->foreign('userId', 'pharmacyinfo_ibfk_1')->references('userId')->on('userinfo')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharmacyinfo', function (Blueprint $table) {
            $table->dropForeign('pharmacyinfo_ibfk_1');
        });
    }
}
