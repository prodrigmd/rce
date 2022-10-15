<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Update7DocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dateTime('dateSurgery')->nullable();
            $table->string('surgeon1Name')->nullable();
            $table->string('surgeon1RUT')->nullable();
            $table->string('surgeon1Specialty')->nullable();
            $table->string('surgeon2Name')->nullable();
            $table->string('surgeon2RUT')->nullable();
            $table->string('surgeon2Specialty')->nullable();
            $table->string('anesthesiaName')->nullable();
            $table->string('anesthesiaRUT')->nullable();
            $table->string('arsenaleraName')->nullable();
            $table->string('arsenaleraRUT')->nullable();
            $table->string('surgeryTime')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('history')->nullable();
            $table->string('surgeriesList')->nullable();
            $table->string('surgeriesDetail')->nullable();
            $table->string('surgeriesPosition')->nullable();
            $table->string('Interconsulta')->nullable();
            $table->string('paseMatronaYN')->nullable();
            $table->string('thromboticRisk')->nullable();
            $table->string('justification')->nullable();
            $table->string('delayRiskYN')->nullable();
            $table->string('supplies')->nullable();
            $table->string('equipment')->nullable();
            $table->string('consignaciones')->nullable();
            $table->string('bloodProducts')->nullable();
            $table->string('ambulatorioYN')->nullable();
            $table->string('diasMQ')->nullable();
            $table->string('diasUTI')->nullable();
            $table->string('diasUCI')->nullable();
            $table->string('diasTotal')->nullable();
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
