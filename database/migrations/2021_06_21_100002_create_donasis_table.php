<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donasis', function (Blueprint $table) {
            $table->integer("id_donasi");
            $table->string("no_donasi");
            $table->string("no_bukti");
            $table->date("tgl_donasi");
            $table->decimal("total_donasi", $precision = 8, $scale = 2);
            $table->integer("metode");
            $table->integer("status_donasi");
            $table->integer("id_muzaki");
            $table->integer("id_pengguna");
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
        Schema::dropIfExists('donasis');
    }
}
