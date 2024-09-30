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
        Schema::create('compagnies', function (Blueprint $table) {
            $table->id();
            $table->string('year')->nullable();
            $table->string('newOpa')->nullable();
            $table->string('departement')->nullable();
            $table->string('arrondissement')->nullable();
            $table->string('village')->nullable();
            $table->string('adresse')->nullable();
            $table->string('typeOpa')->nullable();
            $table->string('juridique')->nullable();
            $table->string('denominationOpa')->nullable();
            $table->string('dateCreaction')->nullable();
            $table->string('personneContact')->nullable();
            $table->string('contact')->nullable();
            $table->string('courriel')->nullable();
            $table->string('maillon')->nullable();
            $table->string('totalMembre')->nullable();
            $table->string('nbrHomme')->nullable();
            $table->string('nbrFemme')->nullable();
            $table->string('nbrJFemme')->nullable();
            $table->string('nbrJHomme')->nullable();
            $table->string('services')->nullable();
            $table->string('position')->nullable();
            $table->string('gestionOpa')->nullable();
            $table->string('administrationOpa')->nullable();
            $table->string('surveillanceOpa')->nullable();
            $table->string('bureauOpa')->nullable();
            $table->string('state')->default('new');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('compagnies');
    }
};
