<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('invoice_number',10);
            $table->string('pid',12);
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->json('details');
            $table->double('vat')->default(0);
            $table->double('discount')->default(0);
            $table->double('hospital_discount')->default(0);
            $table->double('total');
            $table->double('net_total');
            $table->date('invoice_date');
            $table->date('delivery_date')->nullable();
            $table->string('issuer',50);
            $table->string('phone_number',14);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('doctor_percentage_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_invoices');
    }
}
