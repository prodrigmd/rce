<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Update3PacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('sex');
//            Female, Male
            $table->string('rut')->nullable();
            $table->date('action_last_date')->nullable();
            $table->integer('action_last')->nullable();
            $table->date('action_next_date')->nullable();
            $table->integer('action_next')->nullable();
//action: 1=intervención, 2=hospitalizada, 3=ambulatoria, 4=otra

//            $table->longText('description')->nullable()->change();
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
