<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryBarcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_barcodes', function (Blueprint $table) {
            $table->id();
            $table->integer('alt_supply_id')->default(0);
            $table->integer('inventory_id')->default(0);
            $table->integer('supplier_id')->default(0);
            $table->string('barcode');
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
        Schema::dropIfExists('inventory_barcodes');
    }
}
