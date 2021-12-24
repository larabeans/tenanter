<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDomainTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {
            if (config('uuider.installed', false)) {
                $table->uuid('id')->primary('id');
            } else {
                $table->increments('id')->primary('id');
            }
            $table->uuidMorphs('domainable');
            $table->string("domain")->unique();
            $table->boolean("is_primary")->default(false);
            $table->boolean("is_active")->default(false);
            $table->boolean("is_verified")->default(false);
            $table->string('dns_verification_hostname')->nullable();
            $table->string('dns_verification_code')->nullable();
            $table->timestamp('verified_at')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
}
