<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntermittentHealthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intermittent_healths', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index();
            $table->unsignedBigInteger('clinic_id')->index();
            $table->integer('diarrhealasttwoweeks')->default(0);
            $table->integer('stoolswithbloodormucus')->default(0);
            $table->integer('morethanthreediarrhealstoolorliquid')->default(0);
            $table->integer('toiletmorethantimesthanusual')->default(0);
            $table->integer('acutegastrointestinalinfection')->default(0);
            $table->integer('anyofthefollowinglasttwoweeks')->default(0);
            $table->integer('hadstoolswithbloodormucus')->default(0);
            $table->integer('diarrhealast')->default(0);
            $table->integer('cough')->default(0);
            $table->integer('resipiratorydistrees')->default(0);
            $table->integer('intercostalretractions')->default(0);
            $table->integer('fever')->default(0);
            $table->integer('fastorrapidbreathing')->default(0);
            $table->integer('greenoryellowmucous')->default(0);
            $table->integer('hospitalizationinthelasttwoweeks')->default(0);
            $table->integer('numberofdayshospitalized')->nullable();
            $table->integer('none')->default(0);
            $table->integer('reflux')->default(0);
            $table->integer('diarrhea')->default(0);
            $table->integer('abdominalpain')->default(0);
            $table->integer('rash')->default(0);
            $table->integer('glassitis')->default(0);
            $table->integer('difficulytyswallowing')->default(0);
            $table->integer('anyantihistaminicorsteroid')->default(0);
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intermittent_healths');
    }
}
