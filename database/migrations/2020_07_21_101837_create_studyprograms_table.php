<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyprogramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studyprograms', function (Blueprint $table) {
            $table->id();
            $table->string('kode_prodi', 10);
            $table->string('nama_prodi', 100);
            $table->integer('ka_prodi');
            $table->char('aktif', 1);
            $table->string('created_user', 50);
            $table->string('last_update_user', 50)->nullable();;
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
        Schema::dropIfExists('studyprograms');
    }
}
