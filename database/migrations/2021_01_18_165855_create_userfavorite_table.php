<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserfavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userfavorite', function (Blueprint $table) {
            $table->integer('userId');
            $table->string('productCode', 77)->index('productCode');
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
        Schema::dropIfExists('userfavorite');
    }
}
