<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('user_id')->constrained();
            $table->string('slogan')->nullable();
            $table->text('short_description')->nullable();
            $table->string('city');
            $table->string('district');
            $table->text('address');
            $table->unsignedBigInteger('location_id');
            $table->string('profile_picture_url')->nullable();
            $table->string('cover_photo_url')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website_url')->nullable();
            $table->string('fiscal_attribute')->nullable();
            $table->string('identification_code')->nullable();
            $table->string('control_digit')->nullable();
            $table->string('registration_prefix')->nullable();
            $table->string('county_code')->nullable();
            $table->integer('order_number')->nullable();
            $table->year('registration_year')->nullable();
            $table->integer('min_people')->nullable();
            $table->integer('max_people')->nullable();
            $table->decimal('pret_min_nunta', 10, 2)->nullable();
            $table->decimal('pret_min_botez', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
