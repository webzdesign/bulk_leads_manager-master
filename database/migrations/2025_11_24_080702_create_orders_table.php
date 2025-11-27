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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
             $table->timestamp('order_date')->useCurrent();
            $table->integer('client_id');
            $table->integer('lead_type_id');
            $table->integer('age_group_id');
            $table->integer('qty');
            $table->enum('gender',['0','1'])->comment('0=Male, 1=Female')->nullable();
            $table->integer('state_id')->nullable();
            $table->enum('status',['0','1'])->comment('0=Pending, 1=Done')->default(0);
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
