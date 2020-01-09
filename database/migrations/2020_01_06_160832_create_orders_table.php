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
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('payment_option_id')->unsigned();
            $table->string('order_code');
            $table->decimal('sub_total', 20, 2);
            $table->decimal('fee', 20, 2);
            $table->decimal('total', 20, 2);
            $table->enum('status', ['onprogress', 'pending', 'done', 'cancel'])->default('onprogress');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->text('shipping_address');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('payment_option_id')->references('id')->on('payment_options')
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
        Schema::dropIfExists('orders');
    }
}
