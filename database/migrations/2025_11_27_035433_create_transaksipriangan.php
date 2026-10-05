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
        Schema::create('transaksipriangan', function (Blueprint $table) {
            $table->id();
            $table->string('nofakturpriangan')->unique();
            $table->date('tanggal_transaksipriangan');
            $table->string('nama_pemasangpriangan');
            $table->string('alamat_pemasangpriangan');
            $table->string('id_iklanpriangan');
            $table->string('sales_iklanpriangan');
            $table->date('tanggal_muatiklanpriangan');
            $table->integer('harga_transaksipriangan');
            $table->integer('jumlahbayar_transaksipriangan');
            $table->integer('piutang_transaksipriangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksipriangan');
    }
};
