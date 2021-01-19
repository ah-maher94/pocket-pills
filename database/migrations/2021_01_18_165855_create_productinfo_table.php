<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productinfo', function (Blueprint $table) {
            $table->string('productCode', 77)->primary();
            $table->string('productName', 55);
            $table->integer('productPrice');
            $table->string('productSideEfects', 400)->nullable();
            $table->string('productdescription', 400)->nullable();
            $table->integer('productNoOfSearch')->nullable()->default(0);
            $table->string('manufacturer', 22)->nullable();
            $table->string('categoryName', 22)->nullable()->index('categoryName');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productinfo');
    }
}
