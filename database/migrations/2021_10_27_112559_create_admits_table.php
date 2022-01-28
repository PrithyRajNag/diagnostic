<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admits', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('patient_id');
            $table->foreignId('doctor_id');
            $table->foreignId('package_id');
            $table->date('admission_date');
            $table->date('discharge_date');
            $table->string('guardian_name',50);
            $table->string('guardian_contact',50);
            $table->json('address');
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
        Schema::dropIfExists('admits');
    }
}
