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
        Schema::create('jurnal_harians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penempatan_id')->constrained('penempatan_magangs')->onDelete('cascade');
            $table->date('tanggal');
            $table->text('kegiatan');
            $table->string('foto_kegiatan')->nullable();
            $table->enum('status_verifikasi', ['pending', 'disetujui', 'revisi'])->default('pending');
            $table->text('catatan_pembimbing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal_harians');
    }
};
