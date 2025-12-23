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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'complaints_user_id_foreign',
            )->onDelete('cascade')->onUpdate('cascade');
            $table->string('judul_keluhan');
            $table->text('isi_keluhan');
            $table->date('tanggal_ajukan');
            $table->enum('status', ['menunggu', 'ditanggapi', 'selesai'])->default('menunggu');
            $table->text('tanggapan')->nullable();
            $table->date('tanggal_tanggapan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
