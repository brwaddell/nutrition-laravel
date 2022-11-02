<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parental_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index();
            $table->string('parent_type', 50);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('dob', 50)->nullable();
            $table->string('language', 50);
            $table->string('racial_identity', 50)->nullable();
            $table->string('martial_status', 50);
            $table->string('cell_phone', 50)->nullable();
            $table->string('whatsapp', 50)->nullable();
            $table->string('district', 50);
            $table->string('dpi_no', 50)->nullable();
            $table->string('occupation', 50);
            $table->integer('is_migrant')->default(0);
            $table->integer('primary_caregiver')->default(1);
            $table->string('caregiver_info', 155);
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
        Schema::dropIfExists('parental_information');
    }
}
