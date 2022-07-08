<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('auto_delete_rec_after')->nullable();
            $table->integer('disallow_import_lead_older')->nullable();
            $table->integer('frequency_of_deleted_archives')->nullable();
            $table->integer('no_of_time_lead_download')->nullable();
            $table->string('email_from_address')->nullable();
            $table->string('email_from_name')->nullable();
            $table->string('deleted_lead_email_one')->nullable();
            $table->string('deleted_lead_email_two')->nullable();
            $table->string('bcc_email_address')->nullable();
            $table->string('reply_to_email')->nullable();
            $table->integer('added_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('site_settings');
    }
}
