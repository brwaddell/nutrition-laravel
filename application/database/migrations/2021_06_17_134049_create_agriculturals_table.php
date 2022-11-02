<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgriculturalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agriculturals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index();
            $table->integer('growing_food')->default(0);
            $table->enum('own_rent', ['own', 'rent']);
            $table->string('area_size', 55)->nullable();
            $table->string('land_condition', 155)->nullable();
            $table->integer('irrigation')->default(0);
            $table->integer('grow_food')->default(0);
            $table->string('crops_kind')->nullable();
            $table->integer('animal_husbandry')->default(0);
            $table->string('type')->nullable();
            $table->string('immunisation')->nullable();
            $table->integer('compost')->default(0);
            $table->string('seed_uses')->nullable();
            $table->integer('fertilisers')->default(0);
            $table->integer('decrease_production')->default(0);
            $table->integer('pets')->default(0);
            $table->string('explain')->nullable();
            $table->unsignedBigInteger('clinic_id')->index();
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
        Schema::dropIfExists('agriculturals');
    }
}
