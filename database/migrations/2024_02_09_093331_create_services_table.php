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
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description');
            $table->enum('type', ['translation', 'transcribing', 'writing', 'editing', 'proofreading', 'other'])->default('other');
            $table->enum('language', ['english', 'bahasa', 'french', 'spanish', 'german', 'italian', 'portuguese', 'dutch', 'russian', 'chinese', 'japanese', 'arabic', 'other'])->default('other');
            $table->timestamps();

            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
