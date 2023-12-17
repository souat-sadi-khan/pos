<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('method_id')->nullable();
            $table->foreign('method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->string('method_has_txr_id')->nullable();
            $table->string('method_has_mob_no')->nullable();
            $table->longtext('note')->nullable();
            $table->double('subtotal',2)->nullable();
            $table->double('discount',2)->nullable();
            $table->double('order_tax',2)->nullable();
            $table->double('shiping_charge',2)->nullable();
            $table->double('other_charge',2)->nullable();
            $table->double('paid',2)->nullable();
            $table->double('due',2)->nullable();
            $table->double('payable',2)->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('sells');
    }
}
