<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image');
            $table->unsignedBigInteger('enterprise_id')->nullable();
            
            $table->foreign('enterprise_id')->references('id')->on('enterprises')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_enterprise_id_foreign');
            $table->dropColumn('image');
            $table->dropColumn('enterprise_id');

        });
    }
}