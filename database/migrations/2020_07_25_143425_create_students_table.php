<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 10)->nullable();
            $table->string('nama_mahasiswa', 100);
            $table->text('alamat')->nullable();
            $table->char('jk', 1);
            $table->string('telp', 16)->nullable();
            $table->string('hp', 15)->nullable();
            $table->string('agama', 25);
            $table->string('email', 100)->unique();
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->integer('prodi_id');
            $table->integer('jurusan_id');
            $table->integer('kelas_id');
            $table->char('kategori_kelas', 3);
            $table->longText('foto')->nullable();
            $table->char('aktif', 1);
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
        Schema::dropIfExists('students');
    }
}
