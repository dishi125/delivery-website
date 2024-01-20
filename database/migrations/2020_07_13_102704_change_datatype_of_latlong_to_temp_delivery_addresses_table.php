<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDatatypeOfLatlongToTempDeliveryAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temp_delivery_addresses', function (Blueprint $table) {
            $table->decimal('lat',10, 7)->change();
            $table->decimal('long',10, 7)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temp_delivery_addresses', function (Blueprint $table) {
            //
        });
    }
}
