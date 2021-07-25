<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('prodi_id');
            $table->integer('dosen_id');
            $table->string('kode_makul', 10);
            $table->string('nama_makul', 100);
            $table->char('semester', 1);
            $table->integer('sks');
            $table->integer('jurusan_id');
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
        Schema::dropIfExists('courses');
    }
}
