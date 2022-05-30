<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKetuaKelompokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ketua_kelompok', function (Blueprint $table) {
            $table->id();

            $table->string('nama_ketua_kelompok', 100)->nullable();
            $table->enum('jenis_kelamin', ['L','P'])->nullable();
            $table->enum('jenis_identitas', ['KTM','SIM','KTP'])->nullable();
            $table->integer('nomor_kartu_identitas')->nullable();
            $table->text('alamat_rumah')->nullable();
            $table->string('provinsi',100)->nullable();
            $table->string('kota',100)->nullable();
            $table->string('kecamatan',100)->nullable();
            $table->string('kelurahan',100)->nullable();
            $table->string('nomor_telepon',100)->nullable();
            $table->string('email',100)->nullable();

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
        Schema::dropIfExists('ketua_kelompok');
    }
}
