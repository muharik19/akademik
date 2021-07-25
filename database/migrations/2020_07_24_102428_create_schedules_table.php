<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('jurusan_id');
            $table->integer('makul_id');
            $table->string('kategori_jadwal', 3);
            $table->string('ruang', 20);
            $table->integer('kelas_id');
            $table->string('hari', 10);
            $table->char('jam_mulai', 10);
            $table->char('jam_selesai', 10);
            $table->integer('dosen_id');
            $table->string('created_user', 50)->nullable();
            $table->string('last_update_user', 50)->nullable();
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
        Schema::dropIfExists('Schedules');
    }
}
