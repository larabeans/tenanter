<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenantTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {

            if(config('uuider.installed', false)) $table->uuid('id')->primary('id');
            else $table->increments('id')->primary('id');

            $table->string("slug")->unique();
            $table->string("name");
            $table->string("domain");
            $table->boolean("is_active");
            $table->text('configuration')->nullable();


            $table->timestamps();
            $table->softDeletes();

        });
//        Schema::table('tenants', function (Blueprint $table) {
//
//
//        });



    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
