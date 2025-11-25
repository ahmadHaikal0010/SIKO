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
        Schema::create('rental_extensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained(
                table: 'tenants',
                indexName: 'fk_rental_extensions_tenant_id',
            )->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_extensions');
    }
};
