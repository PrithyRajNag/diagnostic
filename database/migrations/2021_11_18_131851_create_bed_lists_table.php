<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bed_lists', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('bed_type_id')->references('id')->on('bed_types')->onDelete('cascade')->onUpdate('cascade');
            $table->string('bed_number',50);
            $table->string('floor_no',10);
            $table->double('price');
            $table->longText('description')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('availability')->default(true);
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
        Schema::dropIfExists('bed_lists');
    }
}
