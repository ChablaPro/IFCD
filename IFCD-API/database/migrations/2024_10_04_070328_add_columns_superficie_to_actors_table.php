<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actors', function (Blueprint $table) {
            $table->string('handicap')->nullable();
            $table->string('occupation')->nullable();
            $table->float('superficie')->nullable();
            $table->integer('nbrBetail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actors', function (Blueprint $table) {
            $table->dropColumn(['superficie', 'handicap', 'occupation', 'nbrBetail' ]);
        });
    }
};
