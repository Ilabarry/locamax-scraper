<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rental_sources', function (Blueprint $table) {
            $table->id();
            $table->string('source_url');
            $table->string('source_type'); // AGENCY or PRIVATE
            $table->string('name_or_title');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('property_type')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->boolean('is_qualified')->default(false);
            $table->timestamps();

            $table->unique('source_url'); // éviter doublons
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_sources');
    }
};
