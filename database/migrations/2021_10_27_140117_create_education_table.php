<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('degree_level',50)->nullable();
            $table->string('degree',50)->nullable();
            $table->string('passing_year',20)->nullable();
            $table->string('result',5)->nullable();
            $table->string('board_university',60)->nullable();
            $table->string('major',50)->nullable();
            $table->foreignId('profile_id')->nullable()->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('education');
    }
}
