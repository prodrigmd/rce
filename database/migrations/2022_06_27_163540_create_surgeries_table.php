<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurgeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surgeries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('codigoFonasa')->nullable();
            //area: 1=endovascular cerebro, 2=endovascular columna, 3=percutaneo columna, 4=percutaneo H&N, 5=otro
            $table->integer('area')->nullable();
            $table->longText('template')->nullable();
            $table->longText('description')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surgeries');
    }
}
