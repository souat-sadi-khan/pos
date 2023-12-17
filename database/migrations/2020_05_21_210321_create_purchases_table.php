<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->date('purchase_date')->nullable();
            $table->string('purchase_ref_no')->nullable();
            $table->string('invoice')->nullable();
            $table->longText('purchase_note')->nullable();
            $table->string('purchase_attatchment')->nullable();
            $table->string('supplier_id')->nullable();
            $table->string('purchase_number_of_product')->nullable();
            $table->string('purchase_subtotal')->nullable();
            $table->string('purchase_order_tax')->nullable();
            $table->string('purchase_shiping_charge')->nullable();
            $table->string('purchase_other_charge')->nullable();
            $table->string('purchase_discount')->nullable();
            $table->string('purchase_payable_amount')->nullable();
            $table->unsignedBigInteger('purchase_payment_method_id')->nullable();
            $table->foreign('purchase_payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->string('purchase_paid_amount')->nullable();
            $table->string('purchase_due_amount')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
