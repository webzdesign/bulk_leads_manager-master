<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSiteSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('added_by');
            $table->dropColumn('updated_by');
        });
        Schema::table('site_settings', function (Blueprint $table) {
            $table->bigInteger('added_by')->unsigned()->index()->nullable();
            $table->bigInteger('updated_by')->unsigned()->index()->nullable();

            $table->foreign('added_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('site_settings', function (Blueprint $table) {
            $table->integer('added_by');
            $table->integer('updated_by');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('added_by');
            $table->dropColumn('updated_by');
            $table->dropForeign(['added_by']);
            $table->dropForeign(['updated_by']);
        });
    }
}
