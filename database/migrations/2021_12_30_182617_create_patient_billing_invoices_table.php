<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientBillingInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_billing_invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('invoice_number');
            $table->string('pid');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('phone_number',14);
            $table->json('details');
            $table->double('vat')->default(0);
            $table->double('discount')->default(0);
            $table->double('hospital_discount')->default(0);
            $table->double('total');
            $table->double('net_total');
            $table->string('issuer');
            $table->longText('note')->nullable();
            $table->double('bed_cost')->default(0);
            $table->double('package_cost')->default(0);
            $table->double('service_cost')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_billing_invoices');
    }
}
