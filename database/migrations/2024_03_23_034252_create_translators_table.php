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
        Schema::create('translators', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('title', 128);
            $table->string('first_name', 128);
            $table->string('middle_name', 128)->nullable();
            $table->string('last_name', 128);
            $table->enum('gender', ['Male', 'Female']);
            $table->date('date_of_birth');
            $table->enum('nationality', ['ID', 'UK', 'SP', 'MY', 'SG', 'US']);
            $table->enum('country', ['ID', 'UK', 'SP', 'MY', 'SG', 'US']);
            $table->enum('time_zone', ['WIB', 'WITA', 'WIT']);
            $table->string('income_tax', 128);
            $table->string('telp_home', 64);
            $table->string('telp_office', 64);
            $table->string('webpage', 128);
            $table->string('secondary_email', 128);
            $table->string('msn', 128);
            $table->string('whatsapp', 64);
            $table->string('skype', 128);
            $table->string('other', 128);
            $table->string('edu_institution', 512);
            $table->string('edu_major', 512);
            $table->string('edu_degree', 512);
            $table->string('edu_year', 512);
            $table->string('edu_graduate', 512);
            $table->date('translating_since');
            $table->string('service_summary', 128);
            $table->string('soft_tools', 512);
            $table->string('langfrom1', 256);
            $table->string('langto1', 256);
            $table->string('lang', 712);
            $table->string('level', 10);
            $table->string('bidang', 712);
            $table->string('score', 512);
            $table->string('langrate', 712);
            $table->string('langrate_editor', 712);
            $table->string('wh_fullweek', 128);
            $table->string('wh_fullweek_not', 128);
            $table->string('wh_parttime', 128);
            $table->string('capacity_daily', 128);
            $table->string('charge_currency', 128);
            $table->string('servicesfee_word', 256);
            $table->string('servicesfee_hour', 256);
            $table->string('servicesfee_minute', 256);
            $table->string('servicesfee_character', 256);
            $table->string('payment_paypal', 128);
            $table->string('bank_owner_name', 128);
            $table->string('bank_acc_number', 128);
            $table->string('bank_name', 128);
            $table->string('bank_branch', 128);
            $table->text('bank_address');
            $table->string('bank_swift', 128);
            $table->string('bank_iban', 128);
            $table->text('bank_owner_address');
            $table->string('bank_owner_city', 128);
            $table->string('bank_owner_zip', 128);

            $table->foreign('user_id')->references('id')->on('pmd_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translators');
    }
};
