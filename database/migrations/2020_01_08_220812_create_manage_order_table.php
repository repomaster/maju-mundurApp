<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_order', function (Blueprint $table) {
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('merchant_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->decimal('price', 20, 2);
            $table->integer('qty');
            $table->decimal('sub_total', 20, 2);

            $table->foreign('order_id')->references('id')->on('orders')
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
        Schema::dropIfExists('manage_order');
    }
}
