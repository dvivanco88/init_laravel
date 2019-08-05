<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnterprisesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');            
            $table->string('tel');
            $table->string('ext_tel');
            $table->string('contact_name');
            $table->string('email_contact');
            $table->string('image');
            $table->string('rfc');
            $table->string('adress');
            $table->boolean('is_active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('enterprises');
    }
}
