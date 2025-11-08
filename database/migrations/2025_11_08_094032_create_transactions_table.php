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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained(
                table: 'tenants',
                indexName: 'fk_transactions_tenant_id'
            )->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('jumlah_bayar', 15, 2);
            $table->date('tanggal_bayar');
            $table->date('periode_mulai');
            $table->date('periode_selesai');
            $table->enum('metode_pembayaran', ['cash', 'bank_transfer', 'e_wallet', 'cicilan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
