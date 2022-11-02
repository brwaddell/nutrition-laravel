<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirthInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birth_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index();
            $table->float('birth_weight');
            $table->enum('weight_unit', ['kg', 'g']);
            $table->float('birth_length');
            $table->enum('length_unit', ['cm', 'ml', 'm']);
            $table->float('apgars')->nullable();
            $table->integer('skin_immediately')->default(0);
            $table->integer('breastfeeding')->default(0);
            $table->integer('respiratory_distress')->default(0);
            $table->integer('jaundice')->default(0);
            $table->integer('spesis')->default(0);
            $table->integer('hospitalization')->default(0);
            $table->string('solid_foods', 50)->nullable();
            $table->integer('fresh_fruits')->default(0);
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
        Schema::dropIfExists('birth_information');
    }
}
