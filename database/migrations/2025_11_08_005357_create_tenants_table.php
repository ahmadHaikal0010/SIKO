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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'fk_tenants_user_id'
            )->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('room_id')->constrained(
                table: 'rooms',
                indexName: 'fk_tenants_room_id'
            )->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_penghuni');
            $table->string('telpon');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->enum('pekerjaan', ['pelajar', 'karyawan', 'wirausaha', 'lainnya']);
            $table->string('nama_wali')->nullable();
            $table->string('telpon_wali')->nullable();
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
