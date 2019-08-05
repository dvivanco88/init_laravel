<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enterprises', function (Blueprint $table) {
            $table->string('name')->nullable()->change();            
            $table->string('tel')->nullable()->change();            
            $table->string('ext_tel')->nullable()->change();            
            $table->string('contact_name')->nullable()->change();            
            $table->string('email_contact')->nullable()->change();            
            $table->string('image')->nullable()->change();            
            $table->string('rfc')->nullable()->change();            
            $table->string('adress')->nullable()->change();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enterprises', function (Blueprint $table) {
            //
        });
    }
}
