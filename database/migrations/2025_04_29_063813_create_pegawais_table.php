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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->foreignId('golongan_id')->constrained('golongans')->onDelete('cascade');
            $table->foreignId('eselon_id')->constrained('eselons')->onDelete('cascade');
            $table->string('jabatan')->nullable();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->string('tempat_tugas')->nullable();
            $table->string('agama')->nullable(); // string biasa
            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('npwp')->nullable();
            $table->string('foto')->nullable(); // upload file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
