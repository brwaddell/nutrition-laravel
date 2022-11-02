<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicHealthQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_health_questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->enum('pattern', ['inputbox', 'selectbox', 'checkbox', 'radiobox']);
            $table->string('attributes')->nullable();
            $table->string('slug');
            $table->unsignedBigInteger('form_id')->index();
            $table->timestamps();

            $table->foreign('form_id')->references('id')->on('public_health_forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public_health_questions');
    }
}
