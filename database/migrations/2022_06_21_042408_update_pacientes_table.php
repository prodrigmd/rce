<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('name');
            $table->string('lastName1');
            $table->string('lastName2');
            $table->date('dob');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('insurance');
            $table->string('hospital');
            $table->string('diagnosis');
//            status: 1=hospitalizado, 2=ambulatorio, 3=alta
            $table->integer('status');
            $table->longText('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
