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
        Schema::create('jarak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('testing_id');
            $table->unsignedBigInteger('training_id');
            $table->integer('jarak');
            $table->timestamps();
            $table->foreign('testing_id')->references('id')->on('data_testing')->onDelete('cascade');
            $table->foreign('training_id')->references('id')->on('data_training')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jarak');
    }
};
