<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeptSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dept_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customerID')->unsigned()->index();
            $table->integer('dept_id')->unsigned()->index();
            $table->double('saleAmountReceived')->nullable();
            $table->double('saleAmountDue')->nullable();
            $table->integer('modeOfPayment')->nullable();
            $table->string('transactionCode')->nullable();
            $table->text('remarks')->nullable();
            $table->tinyInteger('paid')->default(0);
            $table->string('paymentDueDate')->nullable();
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
        Schema::dropIfExists('dept_sales');
    }
}
