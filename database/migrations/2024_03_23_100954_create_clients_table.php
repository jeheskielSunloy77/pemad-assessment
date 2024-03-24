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
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('segment', 128);
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('company', 128);
            $table->text('address');
            $table->string('phone', 50);
            $table->enum('timezone', ['WIB', 'WITA', 'WIT']);
            $table->text('description');
            $table->text('website');
            $table->string('primary_contact_salutation', 50);
            $table->string('primary_contact_email', 100);
            $table->string('primary_contact_phonemob', 50);
            $table->string('primary_contact_skype', 100);
            $table->string('primary_contact_jobtitle', 100);
            $table->string('primary_contact_phone', 50);
            $table->string('additional_contact_salutation', 50);
            $table->string('additional_contact_name', 100);
            $table->string('additional_contact_email', 100);
            $table->string('additional_contact_phonemob', 50);
            $table->string('additional_contact_skype', 100);
            $table->string('additional_contact_jobtitle', 100);
            $table->string('additional_contact_phone', 50);
            $table->enum('currency', ['IDR', 'USD', 'GBP', 'EUR']);
            $table->integer('rate_per_word')->default(0);
            $table->integer('rate_per_minute')->default(0);
            $table->integer('rate_per_hour')->default(0);
            $table->integer('rate_per_day')->default(0);
            $table->integer('rate_per_sheet')->default(0);
            $table->integer('rate_per_piece')->default(0);
            $table->string('lang_from', 712);
            $table->string('lang_to', 712);
            $table->string('lang_from_custom', 1424);
            $table->string('lang_to_custom', 1424);
            $table->string('price_currency', 1424);
            $table->string('price_t', 712)->default('0');
            $table->string('price_e', 712)->default('0');
            $table->string('price_tep', 712)->default('0');
            $table->string('price_hourly', 712)->default('0');
            $table->string('price_minim', 712)->default('0');
            $table->text('price_note');
            $table->text('trems_signed');
            $table->text('trems_pinalti');
            $table->text('trems_special');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
