<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBranchcontactinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branchcontactinfo', function (Blueprint $table) {
            $table->foreign('pharmacyId', 'branchcontactinfo_ibfk_1')->references('pharmacyId')->on('pharmacyinfo')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('branchId', 'branchcontactinfo_ibfk_2')->references('branchId')->on('branchinfo')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branchcontactinfo', function (Blueprint $table) {
            $table->dropForeign('branchcontactinfo_ibfk_1');
            $table->dropForeign('branchcontactinfo_ibfk_2');
        });
    }
}
