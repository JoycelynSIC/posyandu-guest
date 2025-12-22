<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('catatan_imunisasi');
        Schema::create('catatan_imunisasi', function (Blueprint $table) {
            $table->id('imunisasi_id');
            $table->unsignedBigInteger('warga_id');
            $table->string('jenis_vaksin');
            $table->date('tanggal');
            $table->string('lokasi')->nullable();
            $table->string('nakes')->nullable();

            // karena kamu PAKAI file_name langsung
            $table->string('file_name')->nullable();

            $table->timestamps();

            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catatan_imunisasi');
    }
};
