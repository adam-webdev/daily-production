<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode')->nullable()->unique();
            $table->string('nama')->nullable();
            $table->string('kg')->nullable();
            $table->string('mesin')->nullable();
            $table->string('lot')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('aksi')->default('update');
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
        Schema::dropIfExists('produksis');
    }
}