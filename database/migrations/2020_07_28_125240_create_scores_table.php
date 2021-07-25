<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 10);
            $table->integer('makul_id');
            $table->float('uts');
            $table->float('uas');
            $table->float('nilai');
            $table->integer('sks');
            $table->float('mutu');
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
        Schema::dropIfExists('scores');
    }
}
