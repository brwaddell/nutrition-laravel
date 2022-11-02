<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicHealthAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_health_answers', function (Blueprint $table) {
            $table->id();
            $table->text('answer');
            $table->unsignedBigInteger('question_id')->index();
            $table->unsignedBigInteger('form_id')->index();
            $table->unsignedBigInteger('patient_id')->index();
            $table->unsignedBigInteger('clinic_id')->index();
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('public_health_questions')->onDelete('cascade');
            $table->foreign('form_id')->references('id')->on('public_health_forms')->onDelete('cascade');
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
        Schema::dropIfExists('public_health_answers');
    }
}
