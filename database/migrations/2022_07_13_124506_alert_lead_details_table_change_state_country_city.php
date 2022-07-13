<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlertLeadDetailsTableChangeStateCountryCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_details', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('country');
        });

        Schema::table('lead_details', function (Blueprint $table) {
            $table->bigInteger('country_id')->unsigned()->index()->nullable()->after('address');
            $table->bigInteger('state_id')->unsigned()->index()->nullable()->after('address');
            $table->bigInteger('city_id')->unsigned()->index()->nullable()->after('address');

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_details', function (Blueprint $table) {
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
        });

        Schema::table('lead_details', function (Blueprint $table) {
            $table->dropColumn('city_id');
            $table->dropColumn('state_id');
            $table->dropColumn('country_id');
        });
    }
}
