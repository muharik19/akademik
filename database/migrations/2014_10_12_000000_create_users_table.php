<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nip', 20);
            $table->string('nama_lengkap', 150);
            $table->text('alamat')->nullable();
            $table->string('telp', 16)->nullable();
            $table->string('hp', 15)->nullable();
            $table->string('agama', 25);
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->char('aktif', 1);
            $table->integer('level');
            $table->string('username', 25);
            $table->string('password');
            $table->integer('pendidikanID');
            $table->dateTime('last_login')->nullable();
            $table->string('created_user', 50);
            $table->string('last_update_user', 50)->nullable();;
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
