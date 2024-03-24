<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// CREATE TABLE pmd_inquiries (
//     id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
//     pm_id BINARY(16) NOT NULL,
//     client_id BINARY(16) NOT NULL,
//    ponum VARCHAR(100)  COMMENT 'Clients PO Number',
//    nama VARCHAR(120) ,
//    job_type VARCHAR(128) NOT NULL,
//    langfrom VARCHAR(4) ,
//    langto VARCHAR(4) ,
//    langfrom_custom VARCHAR(20) ,
//    langto_custom VARCHAR(20) ,
//    ratetype VARCHAR(10) ,
//    unit VARCHAR(10),
//    total decimal(12,3) NOT NULL DEFAULT 0.000,
//    rate bigint(20) NOT NULL DEFAULT 0,
//    currency Currency,
//    total bigint(20) NOT NULL DEFAULT 0,
//    catatan TEXT ,
//    status ENUM ('pending', 'proposed', 'approved') DEFAULT 'pending',
//    inquiry_date DATE NOT NULL,
//    approval_date DATE NOT NULL,
//    file_source TEXT ,
//    project int(11) NOT NULL DEFAULT 0 COMMENT '-1: unprojected',
//    division VARCHAR(128) NOT NULL,
//    client_status VARCHAR(128) NOT NULL,
//    bank_adm bigint(20) NOT NULL,
//    vat10 VARCHAR(10) NOT NULL,
//    shipping bigint(20) NOT NULL,
//    discount bigint(20) NOT NULL,
//    daily_volume VARCHAR(512) NOT NULL,
//    amount VARCHAR(512) NOT NULL,
//    cat_tool VARCHAR(128) NOT NULL,
//    ongoing_status VARCHAR(512) NOT NULL,
//    trados VARCHAR(512) NOT NULL,
//    min_currency VARCHAR(20) NOT NULL,
//    min_charge bigint(20) NOT NULL,
//    vendor VARCHAR(128) NOT NULL,
//    est_time_frame VARCHAR(128) NOT NULL,
//    last_update bigint(20) NOT NULL,
//    quo int(2) NOT NULL,
//    project_field VARCHAR(256) NOT NULL
//  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pm_id');
            $table->uuid('client_id');
            $table->string('ponum', 100)->comment('Clients PO Number');
            $table->string('nama', 120);
            $table->string('job_type', 128);
            $table->string('langfrom', 4);
            $table->string('langto', 4);
            $table->string('langfrom_custom', 20);
            $table->string('langto_custom', 20);
            $table->string('ratetype', 10);
            $table->string('unit', 10);
            $table->decimal('total', 12, 3)->default(0.000);
            $table->bigInteger('rate')->default(0);
            $table->string('currency');
            $table->bigInteger('total')->default(0);
            $table->text('catatan');
            $table->enum('status', ['pending', 'proposed', 'approved'])->default('pending');
            $table->date('inquiry_date');
            $table->date('approval_date');
            $table->text('file_source');
            $table->integer('project')->default(0)->comment('-1: unprojected');
            $table->string('division', 128);
            $table->string('client_status', 128);
            $table->bigInteger('bank_adm');
            $table->string('vat10', 10);
            $table->bigInteger('shipping');
            $table->bigInteger('discount');
            $table->string('daily_volume', 512);
            $table->string('amount', 512);
            $table->string('cat_tool', 128);
            $table->string('ongoing_status', 512);
            $table->string('trados', 512);
            $table->string('min_currency', 20);
            $table->bigInteger('min_charge');
            $table->string('vendor', 128);
            $table->string('est_time_frame', 128);
            $table->bigInteger('last_update');
            $table->integer('quo')->default(0);
            $table->string('project_field', 256);

            $table->timestamps();

            $table->foreign('pm_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
