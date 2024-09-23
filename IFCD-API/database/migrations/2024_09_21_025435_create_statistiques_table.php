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
        Schema::create('statistiques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nbrVisite')->default(0);
            $table->unsignedBigInteger('nbrBlog')->default(0);
            $table->unsignedBigInteger('nbrAdmin')->default(0);
            $table->unsignedBigInteger('nbrAbonnement')->default(0);
            $table->unsignedBigInteger('nbrCategory')->default(0);
            $table->unsignedBigInteger('nbrTag')->default(0);
            $table->unsignedBigInteger('nbrService')->default(0);
            $table->unsignedBigInteger('nbrJob')->default(0);
            $table->unsignedBigInteger('nbrComment')->default(0);
            $table->unsignedBigInteger('nbrContact')->default(0);
            $table->unsignedBigInteger('nbrRole')->default(0);
            $table->unsignedBigInteger('nbrUser')->default(0);
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
        Schema::dropIfExists('statistiques');
    }
};
