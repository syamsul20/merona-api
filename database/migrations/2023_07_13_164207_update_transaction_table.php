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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('nama',255);
            $table->string('email',255);
            $table->string('phone',255);
            $table->string('alamat',255);
            $table->string('kota',255);
            $table->string('kurir',255);
            $table->string('payment_method',255);
            $table->string('total_amount',255);
            $table->string('fee',255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) { 
            $table->dropColumn('nama');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('alamat');
            $table->dropColumn('kota');
            $table->dropColumn('kurir');
            $table->dropColumn('payment_method');
            $table->dropColumn('total_amount');
            $table->dropColumn('fee');
        });
    }
};
