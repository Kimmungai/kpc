<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('org_id')->unsigned()->index()->nullable();
            $table->integer('dept')->nullable();
            $table->string('name')->nullable();
            $table->tinyInteger('type');
            $table->string('email')->unique()->nullable();
            $table->string('firstName')->nullable();
            $table->string('middleName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->mediumText('address')->nullable();
            $table->text('biography')->nullable();
            $table->string('avatar')->nullable();
            $table->string('idNo')->nullable();
            $table->string('idImage')->nullable();
            $table->string('passport')->nullable();
            $table->string('passportImage')->nullable();
            $table->string('org')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('DOB')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('receive_notifications')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
