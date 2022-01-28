<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->date('date');
            $table->date('due_payment_date')->nullable();
            $table->double('vat')->default(0);
            $table->double('tax')->default(0);
            $table->double('discount')->default(0);
            $table->double('hospital_discount')->default(0);
            $table->double('bonus')->default(0);
            $table->double('total');
            $table->double('paid_amount')->default(0);
            $table->double('due')->default(0);
            $table->string('pay_to',50);
            $table->string('paid_by',50)->nullable();
            $table->string('reference_number',20);
            $table->enum('status', ['PAID', 'UNPAID', 'DUE'])->default('UNPAID');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('account_id')->nullable()->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
