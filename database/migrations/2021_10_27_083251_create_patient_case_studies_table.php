<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientCaseStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_case_studies', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('patient_id');
            $table->string('food_allergies',100);
            $table->string('tendency_bleed',100);
            $table->string('heart_disease', 100);
            $table->string('high_blood_pressure',100);
            $table->string('diabetic',100);
            $table->string('surgery',100);
            $table->string('accident', 100);
            $table->string('other',150);
            $table->string('family_medical_history',100);
            $table->string('current_medication',100);
            $table->string('female_pregnancy',100);
            $table->string('brest_feeding', 100);
            $table->string('health_insurance',100);
            $table->string('low_income',100);
            $table->string('reference',100);
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_case_studies');
    }
}
