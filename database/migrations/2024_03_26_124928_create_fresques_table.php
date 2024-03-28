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
        Schema::create('fresques', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('cover')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('address_id')->constrained();
            $table->integer('places');
            $table->integer('places_left')->nullable();
            $table->date('date');
            $table->time('start_at');
            $table->time('end_at');
            $table->boolean('is_online')->default(false);
            $table->boolean('is_registration_open')->default(true);
            $table->text('summary')->nullable();
            $table->json('content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fresques');
    }
};
