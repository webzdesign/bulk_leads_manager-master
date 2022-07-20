<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToLeadFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_fields', function (Blueprint $table) {

                $table->string('columnName')->after('name'); // use this for field after specific column.

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_fields', function (Blueprint $table) {
            //
            $table->dropColumn('columnName');
        });
    }
}
