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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->nullable();
            $table->string('picture')->default('/default.jpg');
            $table->string('objectif')->nullable();
            $table->string('type')->nullable();
            $table->string('domaine')->nullable();
            $table->string('pays')->nullable();
            $table->string('etat')->nullable();
            $table->string('commune')->nullable();
            $table->string('bassin')->nullable();
            $table->string('date')->nullable();
            $table->string('lieu')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->string('state')->default('new');
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
        Schema::dropIfExists('activities');
    }
};
