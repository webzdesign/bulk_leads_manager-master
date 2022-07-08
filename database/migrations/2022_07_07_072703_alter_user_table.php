<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {

            $table->renameColumn('name','firstName');
            $table->string('lastName')->after('name')->nullable();
            $table->bigInteger('added_by')->after('password')->unsigned()->index()->nullable();
            $table->bigInteger('created_by')->unsigned()->after('password')->index()->nullable();

            $table->softDeletes();


            $table->foreign('added_by')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
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

    }
}
