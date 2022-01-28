<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('invoice_number', 10);
            $table->double('tax')->default(0);
            $table->double('bonus')->default(0);
            $table->double('overtime')->default(0);
            $table->double('due')->default(0);
            $table->double('net_salary');
            $table->date('payment_date');
            $table->string('issuer',50);
            $table->json('description')->nullable();
            $table->foreignId('profile_id')->references('id')->on('profiles')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('salary_invoices');
    }
}
