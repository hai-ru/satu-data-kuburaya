<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapaianTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capaian_target', function (Blueprint $table) {
            $table->id();
            $table->string('capaian');
            $table->string('slug');
            $table->string('organization_id');
            $table->string('resource_id')->nullable();
            $table->integer('tahun')->length(4);
            $table->foreignId('ditambah_oleh')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('diubah_oleh')->nullable()->references('id')->on('users')->nullOnDelete();
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
        Schema::dropIfExists('capaian_target');
    }
}
