<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsEmailVerifiedInDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->integer('is_email_verified')->default(0)->after('email');
        });
        Schema::table('web_users', function (Blueprint $table) {
            $table->integer('is_email_verified')->default(0)->after('email');
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
            $table->dropColumn('is_email_verified');
        });
        Schema::table('web_users', function (Blueprint $table) {
            $table->dropColumn('is_email_verified');
        });
    }
}
