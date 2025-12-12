<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kader_posyandu', function (Blueprint $table) {
            $table->id('kader_id');
            $table->unsignedBigInteger('posyandu_id');
            $table->unsignedBigInteger('warga_id');
            $table->string('peran')->nullable();
            $table->date('mulai_tugas');
            $table->date('akhir_tugas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kader_posyandu');
    }

};
