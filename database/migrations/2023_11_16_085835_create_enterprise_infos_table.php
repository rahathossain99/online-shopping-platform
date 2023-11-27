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
        Schema::create('enterprise_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country')->constrained()->onDelete('cascade');
            $table->string('city');
            $table->string('street')->nullable();
            $table->string('zip');
            $table->string('email');
            $table->string('mobile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enterprise_infos');
    }
};
