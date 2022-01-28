<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('births', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('doctor_id');
            $table->string('name',100);
            $table->string('weight',20);
            $table->string('gender',20);
            $table->string('blood_group',20);
            $table->string('mother_name',50);
            $table->string('father_name',50);
            $table->string('phone_number',20);
            $table->date('date');
            $table->time('time');
            $table->longText('note');
            $table->json('address');
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
        Schema::dropIfExists('births');
    }
}
