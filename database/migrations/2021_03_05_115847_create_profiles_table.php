<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('image')->nullable();
            $table->string('phone_number')->unique();
            $table->string('gender');
            $table->date('dob');
            $table->string('nid')->nullable();
            $table->double('salary');
            $table->string('blood_group');
            $table->date('joining_date')->nullable();
            $table->json('present_address');
            $table->json('permanent_address');
            $table->string('designation',50)->nullable();
            $table->longText('biography')->nullable();
            $table->boolean('status')->default(true); //Will be Enum
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('department_id')->nullable()->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('user_type',['SUPER_ADMIN','ADMIN','INDOOR','OUTDOOR','STAFF','RECEPTIONIST','ACCOUNTANT'])->default('STAFF');
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
        Schema::dropIfExists('profiles');
    }
}
