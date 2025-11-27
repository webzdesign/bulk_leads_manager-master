<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
              $table->bigInteger('lead_type_id')->unsigned()->index()->nullable();
            $table->string('file_name')->nullable();
            $table->dateTime('uploaded_datetime');
            $table->integer('status')->comment('0-pending, 1-processing, 2-error, 3-success');
            $table->bigInteger('rows')->default(0);
            $table->bigInteger('duplicate_row')->default(0);
            $table->bigInteger('invalid_row')->default(0);
            $table->bigInteger('total_row')->default(0);
            $table->bigInteger('added_by')->unsigned()->index()->nullable();
            $table->bigInteger('updated_by')->unsigned()->index()->nullable();
            $table->softDeletes();

            $table->foreign('lead_type_id')->references('id')->on('lead_types');
            $table->foreign('added_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
