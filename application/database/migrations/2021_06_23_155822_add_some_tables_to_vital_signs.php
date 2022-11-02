<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeTablesToVitalSigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vital_signs', function (Blueprint $table) {
            $table->float('wfh')->default(0)->after('mesure_recumbent');
            $table->float('wfhp')->default(0)->after('wfh');
            $table->float('wfa')->default(0)->after('wfhp');
            $table->float('wfap')->default(0)->after('wfa');
            $table->float('hfa')->default(0)->after('wfap');
            $table->float('hfap')->default(0)->after('hfa');
            $table->float('cfa')->default(0)->after('hfap');
            $table->float('cfap')->default(0)->after('cfa');
            $table->float('bmi')->default(0)->after('cfap');
            $table->float('bfa')->default(0)->after('bmi');
            $table->float('bfap')->default(0)->after('bfa');
            $table->float('sfa')->default(0)->after('bfap');
            $table->float('sfap')->default(0)->after('sfa');
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
            $table->dropColumn(['wfh', 'wfhp', 'wfa', 'wfap', 'hfa', 'hfap', 'cfa', 'cfap', 'bmi', 'bfa', 'bfap', 'sfa', 'sfap']);
        });
    }
}
