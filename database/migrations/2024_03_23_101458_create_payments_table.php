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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('pay_num')->default(0);
            $table->integer('dari')->default(0);
            $table->integer('kepada')->default(0);
            $table->string('subjek', 200);
            $table->text('pesan');
            $table->string('job', 200);
            $table->string('file', 100);
            $table->string('currency', 200);
            $table->bigInteger('totalharga')->default(0);
            $table->integer('total')->default(0);
            $table->bigInteger('totalharga_po')->default(0);
            $table->string('adddesc1', 200);
            $table->bigInteger('addjml1')->default(0);
            $table->string('adddesc2', 200);
            $table->bigInteger('addjml2')->default(0);
            $table->string('reddesc1', 200);
            $table->bigInteger('redjml1')->default(0);
            $table->string('reddesc2', 200);
            $table->bigInteger('redjml2')->default(0);
            $table->text('pay_message');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
