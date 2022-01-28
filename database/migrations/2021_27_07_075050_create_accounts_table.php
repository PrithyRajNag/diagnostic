<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('account_name',50);
            $table->string('type',6);
            $table->string('reference_number',20);
            $table->longText('description')->nullable();
            $table->enum('status', ['PAID', 'UNPAID', 'DUE'])->default('UNPAID');
            $table->timestamps();
            $table->softDeletes();
//            $table->foreignId('test_invoice_id')->nullable()->references('id')->on('test_invoices')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
