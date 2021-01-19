<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsercartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usercart', function (Blueprint $table) {
            $table->integer('userId');
            $table->string('productCode', 77)->index('productCode');
            $table->integer('productQuantity')->nullable()->default(0);
            $table->primary(['userId', 'productCode']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usercart');
    }
}
