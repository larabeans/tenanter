<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHostTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hosts', function (Blueprint $table) {

            if (config('uuider.installed', false)) {
                $table->uuid('id')->primary('id');
            } else {
                $table->increments('id')->primary('id');
            }
            $table->string("name");
            $table->string("slug")->unique();
            $table->boolean("is_active");

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosts');
    }
}
