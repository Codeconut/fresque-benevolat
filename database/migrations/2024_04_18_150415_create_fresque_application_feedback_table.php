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
        Schema::create('fresque_application_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fresque_application_id')->constrained()->onDelete('set null');
            $table->integer('rating')->nullable();
            $table->json('questions')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fresque_application_feedbacks');
    }
};
