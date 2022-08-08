<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function ($table) {
            $table->string('customer_id')->unique();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('app_discount')->nullable();
            $table->string('app_discount_rule')->nullable();
            $table->string('app_discount_days')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('duty')->nullable();
            $table->string('fed_tax')->nullable();
            $table->string('auto_discount')->nullable();
            $table->string('due_days')->nullable();
            $table->string('price_schedule')->nullable();
            $table->string('contract_date')->nullable();
            $table->string('salesman')->nullable();
            $table->string('cs_type')->nullable();
            $table->string('terms')->nullable();
            $table->string('interest')->nullable();
            $table->string('tax_status')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('bank_info')->nullable();
            $table->string('ship_no')->nullable();
            $table->string('search_contract')->nullable();
            $table->string('credit_limit')->nullable();
            $table->string('standing_po')->nullable();
            $table->string('po_expiry_date')->nullable();
            $table->string('po_maximum_value')->nullable();
            $table->string('department')->nullable();
            $table->string('po_billed_so_far')->nullable();
            $table->string('gst_exempt')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('number')->nullable();
            $table->string('dis_nv')->nullable();
            $table->string('dis_stat')->nullable();
            $table->string('retail_type')->nullable();
            $table->string('foreign')->nullable();
            $table->string('last_visit')->nullable();
            $table->string('web_comments')->nullable();
            $table->string('password')->nullable();
            $table->boolean('e_commerce')->nullable();
            $table->string('eft_account')->nullable();
            $table->string('eft_bank')->nullable();
            $table->string('eft_name')->nullable();
            $table->string('timezone_id')->nullable();
            $table->double('balances')->nullable();
            $table->text('free_form_group')->nullable();
            $table->text('shipping_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
