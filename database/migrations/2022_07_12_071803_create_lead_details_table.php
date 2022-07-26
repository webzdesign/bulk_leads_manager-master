<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lead_id')->unsigned()->index()->nullable();
            $table->bigInteger('age_group_id')->unsigned()->index()->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('gender')->comment('0-male, 1-female')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->string('phone_number')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('age')->nullable();
            $table->string('zip')->nullable();
            $table->string('date_generated')->nullable();
            $table->integer('is_duplicate');
            $table->integer('is_invalid');
            $table->softDeletes();

            $table->foreign('lead_id')->references('id')->on('leads');
            $table->foreign('age_group_id')->references('id')->on('age_groups');
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
        Schema::dropIfExists('lead_details');
    }
}
