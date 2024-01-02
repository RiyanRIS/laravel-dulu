<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratTable extends Migration
{
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->date('tanggal_kirim');
            $table->string('perihal');
            $table->unsignedBigInteger('id_pengirim');
            $table->unsignedBigInteger('id_penerima');
            $table->string('status'); // Misalnya: Dalam Proses, Selesai, Ditolak, dll.
            $table->string('file_path')->nullable(); // Kolom untuk menyimpan path file terlampir
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_pengirim')->references('id')->on('pegawai')->onDelete('cascade');
            $table->foreign('id_penerima')->references('id')->on('pegawai')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('surat');
    }
}
