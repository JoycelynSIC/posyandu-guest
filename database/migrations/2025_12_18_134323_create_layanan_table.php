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
        Schema::create('layanan', function (Blueprint $table) {

            // PK
            $table->id('layanan_id');

            // FK
            $table->unsignedBigInteger('jadwal_id'); // ke jadwal.jadwal_id
            $table->unsignedBigInteger('warga_id');     // ke warga.warga_id

            // Data layanan
            $table->decimal('berat', 5, 2)->nullable();
            $table->decimal('tinggi', 5, 2)->nullable();
            $table->string('vitamin', 255)->nullable();
            $table->boolean('konseling')->default(false);

            // Timestamp
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('jadwal_id')
                ->references('jadwal_id')
                ->on('jadwal')
                ->onDelete('cascade');

            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
