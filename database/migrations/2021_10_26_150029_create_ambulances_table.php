<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulances', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('vehicle_number', 50);
            $table->string('vehicle_model', 50);
            $table->string('driver_name', 50);
            $table->string('driver_phone_number', 50);
            $table->string('driver_license', 50);
            $table->json('present_address');
            $table->json('permanent_address');
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
        Schema::dropIfExists('ambulances');
    }
}
