<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pacientes_id')->nullable();
            $table->unsignedBigInteger('documents_type_id');
            $table->unsignedBigInteger('documents_detail_id');
            $table->string('patientName');
            $table->string('patientAge');
            $table->string('patientRUT');
            $table->string('patientAddress');
            $table->string('patientCity');
            $table->longText('description');
            $table->date('date')->nullable()->useCurrent();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
