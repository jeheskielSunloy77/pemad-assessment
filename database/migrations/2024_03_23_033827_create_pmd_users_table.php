<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// CREATE TABLE pmd_user (
//     id BINARY(16) PRIMARY KEY DEFAULT (UUID_TO_BIN(UUID())),
//   status ENUM ('Aktif', 'Non Aktif') DEFAULT 'Aktif',
//   name VARCHAR(128) ,
//   email VARCHAR(128) ,
//   address TEXT,
//   phone VARCHAR(50) ,
//   pic VARCHAR(128) ,
//   password TEXT,
//   role ENUM ('Translator', 'In-House' ,'Editor', 'Project Manager', 'Manager', 'Finance',  'Director') NOT NULL ,
//   description TEXT ,
//   tanggal bigint(20) NOT NULL DEFAULT 0,
//   currency Currency,
//   word int(11) NOT NULL DEFAULT 0,
//   minute int(11) NOT NULL DEFAULT 0,
//   hour int(11) NOT NULL DEFAULT 0,
//   day int(11) NOT NULL DEFAULT 0,
//   sheet int(11) NOT NULL DEFAULT 0,
//   th_word int(11) NOT NULL DEFAULT 0,
//   th_minute int(11) NOT NULL DEFAULT 0,
//   th_hour int(11) NOT NULL DEFAULT 0,
//   th_day int(11) NOT NULL DEFAULT 0,
//   th_sheet int(11) NOT NULL DEFAULT 0,
//   langrate VARCHAR(712) NOT NULL,
//   rt_quality decimal(10,2) NOT NULL,
//   rt_responsiv decimal(10,2) NOT NULL,
//   rt_puncuality decimal(10,2) NOT NULL,
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pmd_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status', ['Aktif', 'Non Aktif'])->default('Aktif');
            $table->string('name', 128);
            $table->string('email', 128);
            $table->text('address');
            $table->string('phone', 50);
            $table->string('pic', 128);
            $table->text('password');
            $table->enum('role', ['Translator', 'In-House', 'Editor', 'Project Manager', 'Manager', 'Finance', 'Director'])->default('Translator');
            $table->text('description');
            $table->string('currency');
            $table->integer('word')->default(0);
            $table->integer('minute')->default(0);
            $table->integer('hour')->default(0);
            $table->integer('day')->default(0);
            $table->integer('sheet')->default(0);
            $table->integer('th_word')->default(0);
            $table->integer('th_minute')->default(0);
            $table->integer('th_hour')->default(0);
            $table->integer('th_day')->default(0);
            $table->integer('th_sheet')->default(0);
            $table->string('langrate', 712);
            $table->decimal('rt_quality', 10, 2);
            $table->decimal('rt_responsiv', 10, 2);
            $table->decimal('rt_puncuality', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmd_users');
    }
};
