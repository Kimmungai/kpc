<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dept_id')->unsigned()->index()->nullable();
            $table->integer('request_by')->unsigned()->index()->nullable();
            $table->integer('approved_by')->unsigned()->index()->nullable();
            $table->integer('vat_percent')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->string('reference')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_addr')->nullable();
            $table->string('company_city')->nullable();
            $table->string('doc_title')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('requisition_number')->nullable();
            $table->string('supplier_addr')->nullable();
            $table->string('supplier_phone')->nullable();
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
        Schema::dropIfExists('requisitions');
    }
}