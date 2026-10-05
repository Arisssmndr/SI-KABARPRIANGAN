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
        Schema::create('transaksionline', function (Blueprint $table) {
            $table->id();
            $table->string('nofakturonline')->unique();
            $table->date('tanggal_transaksionline');
            $table->string('nama_pemasangonline');
            $table->string('alamat_pemasangonline');

            // Sebaiknya gunakan unsignedBigInteger atau integer jika ini relasi ke tabel lain
            // Jangan string, kecuali ID di tabel masternya memang string (UUID)
            $table->unsignedBigInteger('id_iklanonline');

            $table->string('portal_iklanonline')->nullable();
            $table->string('sales_iklanonline');
            $table->integer('total_muatiklanonline'); // Qty
            $table->date('tanggal_muatiklanonline');

            // --- BAGIAN KEUANGAN (Gunakan bigInteger untuk uang) ---
            $table->bigInteger('harga_transaksionline');
            $table->bigInteger('diskon_transaksionline');
            $table->bigInteger('insentif_transaksionline');

            // --- KOLOM YANG TADI HILANG (WAJIB DITAMBAHKAN) ---
            $table->bigInteger('komisi_transaksionline')->default(0);
            $table->bigInteger('ppn_transaksionline')->default(0);
            $table->bigInteger('totaltagihan_transaksionline')->default(0);
            // ---------------------------------------------------

            $table->bigInteger('jumlahbayar_transaksionline');
            $table->bigInteger('piutang_transaksionline');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksionline');
    }
};
