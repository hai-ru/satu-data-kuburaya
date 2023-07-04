<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPdfLinkToInfografik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('infografik', function (Blueprint $table) {
            $table->longtext('pdf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('pdf'))
        {
            Schema::table('infografik', function (Blueprint $table) {
                $table->dropColumn('pdf');
            });
        }
    }
}
