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
        Schema::table('animators', function (Blueprint $table) {
            $table->integer('rating')->nullable();
            $table->string('cadre_type')->nullable();
            $table->text('cadre_organisation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animators', function (Blueprint $table) {
            $table->dropColumn('rating');
            $table->dropColumn('cadre_type');
            $table->dropColumn('cadre_organisation');
        });
    }
};
