<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegistrationInsuranceLicenceToDrivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->text('regno')->nullable()->after('car_image');
            $table->text('insuranceno')->nullable()->after('regno');
            $table->text('insuranc_image')->nullable()->after('insuranceno');
            $table->text('licenceno')->nullable()->after('insuranc_image');
            $table->text('licence_image')->nullable()->after('licenceno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            //
        });
    }
}
