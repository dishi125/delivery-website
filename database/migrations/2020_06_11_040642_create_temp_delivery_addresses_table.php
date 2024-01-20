<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempDeliveryAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_delivery_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->integer('user_id');
            $table->string('to_form')->nullable();
            $table->string('name');
            $table->integer('company_id')->nullable();
            $table->integer('country_id');
            $table->text('street_add');
            $table->string('street_add1')->nullable();
            $table->string('mobile');
            $table->string('mobile1')->nullable();
            $table->string('email');
            $table->string('sms_verification');
            $table->integer('price')->nullable();
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
        Schema::dropIfExists('temp_delivery_addresses');
    }
}
