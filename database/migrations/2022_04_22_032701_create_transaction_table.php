<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();

            $table->foreignId('site_id')->constrained('site')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ketua_kelompok_id')->constrained('ketua_kelompok')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_booking')->nullable();
            $table->longText('anggota_kelompok')->nullable();
            $table->date('tanggal_berangkat')->nullable();
            $table->date('tanggal_pulang')->nullable();
            $table->integer('jumlah_pengunjung')->nullable();
            $table->integer('total_harga')->nullable();
            $table->enum('status',['pending','disetujui','dibatalkan'])->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
