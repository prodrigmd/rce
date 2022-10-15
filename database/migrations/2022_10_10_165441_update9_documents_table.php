<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Update9DocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->renameColumn('surgeon1Name', 'surgeonName');
            $table->renameColumn('surgeon1RUT', 'surgeonRUT');
            $table->renameColumn('surgeon1Specialty', 'surgeonSpecialty');
            $table->dropColumn(['surgeon2Name','surgeon2RUT','surgeon2Specialty']);
//            $table->renameColumn('description')->nullable()->change();
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
