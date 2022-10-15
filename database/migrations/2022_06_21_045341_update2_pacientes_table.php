<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Update2PacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
//            $table->string('name');
//            $table->string('lastName1');
            $table->string('lastName2')->nullable()->change();
            $table->date('dob')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('insurance')->nullable()->change();
            $table->string('hospital')->nullable()->change();
            $table->string('diagnosis')->nullable()->change();
//            status: 1=hospitalizado, 2=ambulatorio, 3=alta
//            $table->integer('status');
            $table->longText('description')->nullable()->change();
//            $table->timestamp('created_at')->useCurrent()->change();
//            $table->timestamp('updated_at')->useCurrent()->change();
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
