<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('inventory_id')->default(0);
            $table->double('level')->default(0);
            $table->double('department')->default(0);
            $table->double('regular')->default(0);
            $table->double('sale')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_prices');
    }
}
