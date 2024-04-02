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
        Schema::create('animators', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('photo')->nullable();
            $table->string('level')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('professional_status')->nullable();
            $table->string('availability')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('fresques_animators', function (Blueprint $table) {
            $table->foreignId('fresque_id')->constrained();
            $table->foreignId('animator_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fresques_animators');
        Schema::dropIfExists('animators');
    }
};
