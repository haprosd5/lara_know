<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['processing', 'pendding', 'completed', 'decline'])->default('pendding');
            $table->float('grand_total');
            $table->integer('item_count');
            $table->boolean('is_paid')->default(false);
            $table->enum('payment_menthod', ['cash_delivery', 'payal', 'stripe', 'card'])->default('cash_delivery');

            $table->string('shipping_fullname');
            $table->string('shipping_address');
            $table->string('shipping_phone');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_zipcode');
            $table->string('note')->nullable();

            $table->string('billing_fullname');
            $table->string('billing_address');
            $table->string('billing_phone');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_zipcode');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
}
