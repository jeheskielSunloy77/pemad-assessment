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
        Schema::create('quos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('quo')->default(0);
            $table->integer('quo_status')->default(0);
            $table->bigInteger('tanggal')->default(0);
            $table->integer('dari')->default(0);
            $table->integer('kepada')->default(0);
            $table->string('subjek', 200);
            $table->text('pesan');
            $table->string('inq', 200);
            $table->string('file', 100);
            $table->enum('currency', ['IDR', 'USD']);
            $table->bigInteger('totalharga')->default(0);
            $table->bigInteger('total_inqharga')->default(0)->comment('Total harga murni dari tabel inq');
            $table->integer('total')->default(0);
            $table->bigInteger('vatjml')->default(0);
            $table->text('quo_message');
            $table->bigInteger('bank_adm')->default(0);
            $table->bigInteger('shipping')->default(0);
            $table->bigInteger('discount')->default(0);
            $table->string('amount', 200);
            $table->string('est_time', 100)->default('');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quos');
    }
};
