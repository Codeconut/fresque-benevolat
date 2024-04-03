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
        Schema::create('fresques_applications', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('fresque_id')->constrained();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('info_benevolat')->nullable();
            $table->string('info_fresque')->nullable();
            $table->string('state')->nullable();
            $table->string('token');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fresques_applications');
    }
};
