<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKgcmToPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('packagekg')->after('weight');
            $table->integer('dimesionl')->after('packagekg');
            $table->integer('dimesionw')->after('dimesionl');
            $table->integer('dimesionh')->after('dimesionw');
            $table->renameColumn('delivery_id', 'to_address_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->renameColumn('to_address_id', 'delivery_id');
        });
    }
}
