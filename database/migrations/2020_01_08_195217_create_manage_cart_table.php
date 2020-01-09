<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_cart', function (Blueprint $table) {
            $table->bigInteger('cart_id')->unsigned();
            $table->bigInteger('merchant_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('qty')->default(1);

            $table->foreign('cart_id')->references('id')->on('carts')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('merchant_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_cart');
    }
}
