<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipeToInfografik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('infografik', function (Blueprint $table) {
            $table->enum('tipe',['image','embed'])->nullable();
            $table->longtext('embed_script')->nullable();
            $table->longtext('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('tipe', 'embed_script','link'))
        {
            Schema::table('users', function (Blueprint $table)
            {
                $table->dropColumn('tipe');
                $table->dropColumn('embed_script');
                $table->dropColumn('link');
            });
        }
    }
}
