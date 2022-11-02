<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTfaAndAfaToVitalSigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vital_signs', function (Blueprint $table) {
            $table->float('subscapular_skinfold')->default(0);
            $table->float('triceps_skinfold')->default(0);
            $table->float('arm_circumference')->default(0);
            $table->float('arm_circumference_for_age')->default(0);
            $table->float('subscapular_skinfold_for_age')->default(0);
            $table->float('triceps_skinfold_for_age')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vital_signs', function (Blueprint $table) {
            $table->dropColumn(['subscapular_skinfold', 'triceps_skinfold', 'arm_circumference', 'arm_circumference_for_age', 'subscapular_skinfold_for_age', 'triceps_skinfold_for_age']);
        });
    }
}
