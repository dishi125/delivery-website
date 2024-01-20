<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_package', function (Blueprint $table) {
            $table->id();
            $table->integer('to_address_id');
            $table->integer('weight');
            $table->string('packagekg');
            $table->integer('dimesionl')->nullable();
            $table->integer('dimesionw')->nullable();
            $table->integer('dimesionh')->nullable();
            $table->string('dimesions');
            $table->integer('dvalue')->nullable();
            $table->string('image')->nullable();
            $table->date('date');
            $table->time('time');
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
        Schema::dropIfExists('temp_package');
    }
}
