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
        Schema::create('data_testing', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('asalSekolah');
            $table->string('rataRapor');
            $table->enum('penghasilanOrtu', [1, 2,3,4,5]); 
            $table->integer('tanggunganOrtu');
            $table->text('riwayatOrganisasi')->nullable();
            $table->text('riwayatPrestasi')->nullable();
            $table->enum('KIP', [1, 2])->default(2); // 1=ya 2=tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_testing');
    }
};
