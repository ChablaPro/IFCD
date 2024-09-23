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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('comNumber')->nullable();
            $table->string('comEmail')->nullable();
            $table->string('approveEmail')->nullable();
            $table->string('tweetToken')->nullable();
            $table->string('linkedInToken')->nullable();
            $table->string('urlBase')->nullable();
            $table->string('linkedInClientID')->nullable();
            $table->string('linkedInRedirectUri')->nullable();
            $table->string('linkedInClientSecret')->nullable();
            $table->string('linkedInScope')->nullable();
            $table->string('tweeterClientID')->nullable();
            $table->string('tweeterClientSecret')->nullable();
            $table->json('roles')->nullable();
            $table->string('websiteState')->default('coming');
            $table->string('twilioNumber')->nullable();
            $table->string('twilioSid')->nullable();
            $table->string('twilioToken')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
