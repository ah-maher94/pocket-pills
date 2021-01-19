<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBranchinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branchinfo', function (Blueprint $table) {
            $table->foreign('pharmacyId', 'branchinfo_ibfk_1')->references('pharmacyId')->on('pharmacyinfo')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branchinfo', function (Blueprint $table) {
            $table->dropForeign('branchinfo_ibfk_1');
        });
    }
}
