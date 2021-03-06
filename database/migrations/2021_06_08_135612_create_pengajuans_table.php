<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->increments('id_pengajuan');
            $table->string('no_pengajuan'); //PJN-2100(tahun)0001(nomernya)
            $table->integer('id_mustahik');
            $table->text('pengajuan_kegiatan');
            $table->bigInteger('jumlah_pengajuan');
            $table->integer('jenis_pengajuan'); //konsumtif/produktif
            $table->integer('asnaf');
            $table->bigInteger('jumlah_realisasi');
            $table->date('tgl_realisasi');
            $table->integer('status_pengajuan'); //proses/realisasi/ditolak
            $table->string('deskripsi_kegiatan');
            $table->string('buktirealisasi');
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
        Schema::dropIfExists('pengajuans');
    }
}
