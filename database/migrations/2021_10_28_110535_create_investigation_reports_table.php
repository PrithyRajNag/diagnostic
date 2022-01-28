<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestigationReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigation_reports', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('patient_id');
            $table->foreignId('doctor_id');
            $table->date('date');
            $table->string('title', 100);
            $table->longText('description');
            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investigation_reports');
    }
}
