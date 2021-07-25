<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_students', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 10)->nullable();
            $table->string('nama_mahasiswa', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->char('jk', 1)->nullable();
            $table->string('telp', 16)->nullable();
            $table->string('hp', 15)->nullable();
            $table->string('agama', 25)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('prodi_id')->nullable();
            $table->integer('jurusan_id')->nullable();
            $table->integer('kelas_id')->nullable();
            $table->char('kategori_kelas', 3)->nullable();
            $table->char('aktif', 1)->nullable();
            $table->date('tanggal_upload')->nullable();
            $table->string('created_user', 50)->nullable();
            $table->string('keterangan', 150)->nullable();
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
        Schema::dropIfExists('temp_students_success');
    }
}
