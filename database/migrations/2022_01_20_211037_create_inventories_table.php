<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('inventory_id')->unique();
            $table->string('sub_category');
            $table->string('part_number')->nullable();
            $table->string('item_number')->nullable();
            $table->string('supplier_part_number')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->text('description')->nullable();
            $table->text('description2')->nullable();
            $table->double('whole_sale')->default(0);
            $table->double('extra')->default(0);
            $table->double('freight')->default(0);
            $table->double('duty')->default(0);
            $table->double('landed')->default(0);
            $table->string('unit_of_measure')->nullable();
            $table->double('measurement1')->default(0);
            $table->double('measurement2')->default(0);
            $table->string('size1')->nullable();
            $table->string('size2')->nullable();
            $table->string('size3')->nullable();
            $table->boolean('marked_deleted')->default(false);
            $table->boolean('e_commerce')->default(true);
            $table->double('kit_type')->default(0);
            $table->double('weight')->default(0);
            $table->double('in_stock')->default(0);
            $table->string('start_sale_date')->nullable();
            $table->string('end_sale_date')->nullable();
            $table->string('inventory_selling_comment')->nullable();
            $table->string('inventory_invoice_comment')->nullable();
            $table->string('inventory_web_comment')->nullable();
            $table->string('status')->nullable();
            $table->json('sta')->nullable();
            $table->json('alt_supply')->nullable();
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
        Schema::dropIfExists('inventories');
    }
}
