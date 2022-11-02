<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDesgnationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('designation', 51)->nullable();
            $table->string('contact_no', 51)->nullable();
            $table->string('address', 51)->nullable();
            $table->string('city', 51)->nullable();
            $table->string('state', 51)->nullable();
            $table->string('zip_code', 51)->nullable();
            $table->string('country', 51)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['designation', 'contact_no', 'address', 'city', 'state', 'zip_code', 'country']);
        });
    }
}
