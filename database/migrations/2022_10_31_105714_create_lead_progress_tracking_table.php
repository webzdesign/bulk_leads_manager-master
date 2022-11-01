<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadProgressTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_progress_tracking', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lead_id')->unsigned()->unique();
            $table->string('file_name');
            $table->bigInteger('inserted_count');
            $table->bigInteger('total_count');
            $table->integer('status')->comment('0-pending, 1-processing, 2-error, 3-success');
            $table->softDeletes();
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
        Schema::dropIfExists('lead_progress_tracking');
    }
}
