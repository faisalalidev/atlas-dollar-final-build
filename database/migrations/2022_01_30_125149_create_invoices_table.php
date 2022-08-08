<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->double('invoice_sub_total')->default(0);
            $table->double('invoice_tax_total')->default(0);
            $table->string('invoice_number')->unique();
            $table->string('invoice_ordered')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('invoice_type')->nullable();
            $table->string('invoice_status')->nullable();
            $table->string('invoice_department')->nullable();
            $table->string('invoice_book_month')->nullable();
            $table->string('invoice_customer')->nullable();
            $table->string('invoice_ship_to')->nullable();
            $table->string('invoice_salesman')->nullable();
            $table->json('invoice_shipping')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
