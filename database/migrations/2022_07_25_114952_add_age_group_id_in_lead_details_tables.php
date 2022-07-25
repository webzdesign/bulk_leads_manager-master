<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgeGroupIdInLeadDetailsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_details', function (Blueprint $table) {
            $table->bigInteger('age_group_id')->unsigned()->index()->nullable()->after('lead_id');

            $table->foreign('age_group_id')->references('id')->on('age_groups');
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
            $table->dropColumn('age_group_id');
        });
    }
}
