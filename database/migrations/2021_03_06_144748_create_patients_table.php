<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('pid',12);


            $table->string('first_name',30);
            $table->string('last_name',30);
            $table->string('phone_no',14)->unique();;
            $table->string('blood_group',3)->nullable();
            $table->integer('age')->nullable();
            $table->string('gender',6)->nullable();
            $table->string('religion')->nullable();
            $table->longText('address')->nullable();
            $table->date('dob')->nullable();


            $table->string('attendee_name',40)->nullable();
            $table->string('attendee_relation',10)->nullable();
            $table->string('attendee_phone_no',14)->nullable();


            $table->dateTime('admit_date')->nullable();
            $table->dateTime('discharge_date')->nullable();


            $table->foreignId('doctor_id')->nullable()->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');
            $table->date('assign_date')->nullable();
            $table->date('release_date')->nullable();


            $table->foreignId('package_id')->nullable()->references('id')->on('packages')->onDelete('cascade')->onUpdate('cascade');

            $table->boolean('status')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('patients');
    }
}
