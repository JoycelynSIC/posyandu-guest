<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->increments('layanan_id');

            $table->unsignedBigInteger('jadwal_id'); // karena jadwal_id BIGINT
            $table->unsignedInteger('warga_id');     // karena warga_id INT

            $table->decimal('berat', 5, 2)->nullable();
            $table->decimal('tinggi', 5, 2)->nullable();
            $table->string('vitamin')->nullable();
            $table->boolean('konseling')->default(false);

            $table->timestamps();

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

    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
