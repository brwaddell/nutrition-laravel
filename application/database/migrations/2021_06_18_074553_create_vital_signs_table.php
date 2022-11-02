<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitalSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index();
            $table->unsignedBigInteger('clinic_id')->index();
            $table->integer('height')->default(0);
            $table->string('height_unit')->default('cm');
            $table->integer('weight')->default(0);
            $table->string('weight_unit')->default('kg');
            $table->string('head_circumference')->default(0);
            $table->string('scapular_circumference')->default(0);
            $table->integer('edema')->default(0);
            $table->integer('mesure_recumbent')->default(0);
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
        Schema::dropIfExists('vital_signs');
    }
}
