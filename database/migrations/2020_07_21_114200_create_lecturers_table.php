<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dosen', 10);
            $table->string('nama_dosen', 100);
            $table->text('alamat');
            $table->string('agama', 25);
            $table->string('email', 100)->unique();
            $table->char('jk', 1);
            $table->string('telp', 16);
            $table->string('hp', 15);
            $table->integer('pendidikanID');
            $table->char('aktif', 1);
            $table->string('created_user', 50);
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
        Schema::dropIfExists('lecturers');
    }
}
