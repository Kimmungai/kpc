<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('user_id')->unsigned()->index()->nullable();
             $table->integer('dept_id')->unsigned()->index()->nullable();
             $table->integer('dept_rooms_id')->unsigned()->index()->nullable();
             $table->tinyInteger('bookingType')->nullable();
            $table->tinyInteger('roomType')->nullable();
             $table->integer('numPple')->nullable();
             $table->integer('booking_num_days')->nullable();
             $table->string('chkInDate')->nullable();
             $table->string('chkOutDate')->nullable();
             $table->double('bookingAmountDue')->nullable();
             $table->tinyInteger('modeOfPayment')->nullable();
             $table->double('bookingAmountReceived')->nullable();
            $table->tinyInteger('paymentStatus')->nullable();
             $table->string('paymentDueDate')->nullable();
             $table->string('transactionCode')->nullable();
            $table->tinyInteger('board')->nullable();
            $table->tinyInteger('menu')->nullable();
            $table->text('menuDetails')->nullable();
            $table->tinyInteger('meetingHall')->nullable();
            $table->tinyInteger('tent')->nullable();
            $table->tinyInteger('paSystem')->nullable();
            $table->tinyInteger('projector')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->float('booked_prods_grand_total')->default(0.00);
            $table->integer('no_products')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
