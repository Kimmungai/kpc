<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('booking_id')->unsigned()->index()->nullable();
            $table->integer('dept_sales_id')->unsigned()->index()->nullable();
            $table->integer('report_id')->unsigned()->index()->nullable();
            $table->integer('product_id')->unsigned()->index()->nullable();
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->integer('dept_id')->unsigned()->index()->nullable();
            $table->tinyInteger('paid')->default(0);
            $table->text('description')->nullable();
            $table->text('title')->nullable();
            $table->integer('bookedQuantity')->default(0);
            $table->float('price')->default(0.00);
            $table->float('total')->default(0.00);
            $table->float('amountDue')->default(0.00);
            $table->float('amountReceived')->default(0.00);
            $table->float('balance')->default(0.00);
            $table->tinyInteger('modeOfPayment')->nullable();
            $table->string('transactionCode')->nullable();
            $table->string('paymentDueDate')->nullable();
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
        Schema::dropIfExists('revenues');
    }
}
