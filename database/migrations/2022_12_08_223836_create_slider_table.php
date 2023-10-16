<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug');
            $table->text('deskripsi')->nullable();
            $table->string('gambar');
            $table->boolean('is_judul_show')->default(true);
            $table->boolean('is_deskripsi_show')->default(true);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('slider');
    }
}
