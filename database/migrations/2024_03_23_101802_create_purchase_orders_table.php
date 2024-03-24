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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('dari')->default(0);
            $table->integer('kepada')->default(0);
            $table->string('subjek', 255);
            $table->text('pesan');
            $table->text('job');
            $table->text('pesan_po');
            $table->string('file', 100);
            $table->string('currency');
            $table->bigInteger('totalharga')->default(0);
            $table->bigInteger('totalharga_po');
            $table->integer('total')->default(0);
            $table->integer('pay')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
