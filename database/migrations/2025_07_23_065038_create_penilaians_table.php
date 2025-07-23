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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penempatan_id')->constrained('penempatan_magangs')->onDelete('cascade');
            $table->decimal('nilai_dudi', 5, 2)->nullable();
            $table->text('feedback_dudi')->nullable();
            $table->decimal('nilai_guru', 5, 2)->nullable();
            $table->text('feedback_guru')->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
