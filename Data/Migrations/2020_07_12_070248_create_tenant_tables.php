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

            if(config('uuider.installed', false)) {
                $table->uuid('id')->primary('id');
            } else {
                $table->increments('id')->primary('id');
            }

            $table->string("slug")->unique();
            $table->string("name");
            $table->boolean("is_active");

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
