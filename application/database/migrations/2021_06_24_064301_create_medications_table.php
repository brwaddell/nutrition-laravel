<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index();
            $table->unsignedBigInteger('clinic_id')->index();
            $table->unsignedBigInteger('doctor_id')->index();
            $table->unsignedBigInteger('drug_id')->index();
            $table->unsignedBigInteger('encounter_id')->index()->nullable();
            $table->text('description')->nullable();
            $table->string('dosage', 51)->default('1-0-1');
            $table->integer('order_qty')->default(1);
            $table->integer('period')->default(1);
            $table->string('dosage_form', 51)->nullable();
            $table->text('notes')->nullable();
            $table->integer('status')->default(0); // Pending = 0, Confirmed = 1, Canceled = 2
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('vaccines')->onDelete('cascade');
            $table->foreign('drug_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->foreign('encounter_id')->references('id')->on('clinical_encounters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medications');
    }
}
