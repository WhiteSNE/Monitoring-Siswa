<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nisn', 20)->unique();
            $table->string('nama_lengkap');
            $table->text('alamat')->nullable();
            $table->date('tanggal_lahir');
            $table->string('no_telepon', 20)->nullable();
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('restrict');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
