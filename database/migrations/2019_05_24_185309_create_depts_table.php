<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('org_id')->unsigned()->index()->nullable();
            $table->string('name')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->string('avatar')->nullable();
            $table->double('targetCosts')->nullable();
            $table->double('targetRevenues')->nullable();
            $table->integer('bookingCapacity')->nullable();
            $table->integer('staffCapacity')->nullable();
            $table->double('stockCapacity')->nullable();
            $table->mediumText('address')->nullable();
            $table->mediumText('deptDetails')->nullable();
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
        Schema::dropIfExists('depts');
    }
}
