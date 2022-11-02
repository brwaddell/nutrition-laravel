<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaternalHealthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maternal_healths', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index();
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
            $table->float('menarche_age');
            $table->string('last_menstrual_period', 50);
            $table->string('menstrual_pattern', 50);
            $table->string('cycle_length', 50);
            $table->string('duration_flow', 50);
            $table->string('amount_flow', 50);
            $table->integer('pain')->nullable(0);
            $table->integer('bleeding')->nullable(0);
            $table->integer('vasmotor')->nullable(0);
            $table->integer('hormone_therapy')->nullable(0);
            $table->integer('menopause')->nullable(0);
            $table->string('bleeding_pattern', 50);
            $table->integer('contraception')->nullable(0);
            $table->string('contraception_method', 50);
            $table->string('previous_contraception_method', 50);
            $table->text('pap_smear_result');
            $table->integer('pap_smear_history')->default(0);
            $table->integer('infections_history')->default(0);
            $table->integer('sti_history')->default(0);
            $table->integer('vaginitis_history')->default(0);
            $table->integer('pelvic_history')->default(0);
            $table->integer('fertility')->default(0);
            $table->integer('desire_fertility')->default(0);
            $table->string('diagnosis', 50);
            $table->string('explain', 50);
            $table->string('include_types_one', 50);
            $table->text('difficulty')->nullable();
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
        Schema::dropIfExists('maternal_healths');
    }
}
