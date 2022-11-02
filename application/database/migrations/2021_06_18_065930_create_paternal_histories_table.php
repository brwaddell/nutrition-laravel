<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaternalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paternal_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index();
            $table->float('age');
            $table->float('height');
            $table->enum('height_unit', ['cm', 'ml', 'm']);
            $table->float('weight');
            $table->enum('weight_unit', ['kg', 'g']);
            $table->float('abdominal_circumference');
            $table->enum('circum_unit', ['cm', 'ml', 'm']);
            $table->float('bmi');
            $table->string('schooling', 50)->nullable();
            $table->string('occupation', 50);
            $table->string('martial_status', 50);
            $table->integer('father_live')->default(0);
            $table->integer('provide_expenses')->default(0);
            $table->integer('us_migrant')->default(0);
            $table->string('guatemala_department', 50)->nullable();
            $table->float('migrant_time', 50)->nullable();
            $table->integer('remittance_send')->default(0);
            $table->string('medical_illness', 155)->nullable();
            $table->float('age_sex', 50)->nullable();
            $table->float('age_first_child', 50)->nullable();
            $table->string('interpregnancy_period', 50);
            $table->integer('children')->default(0);
            $table->integer('partner_children')->default(0);
            $table->float('age_pregnancy')->nullable();
            $table->string('contraception', 50);
            $table->integer('child_planning')->default(0);
            $table->integer('alcohol')->default(0);
            $table->string('other', 155)->nullable();
            $table->integer('substance_abuse')->default(0);
            $table->text('optional')->nullable();
            $table->integer('family_members')->default(0);
            $table->string('grandparents_health', 155)->nullable();
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
        Schema::dropIfExists('paternal_histories');
    }
}
