<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_reports', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('report_no');
            $table->string('invoice_number');
            $table->string('pid');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->date('invoice_date');
            $table->date('delivery_date')->nullable();
            $table->string('issuer');
            $table->string('phone_number',14);
            $table->foreignId('test_item_id');
            $table->string('report_name');
            $table->json('report');
            $table->enum('status', ['PROCESSING', 'DONE', 'DELIVERED'])->default('PROCESSING');
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
        Schema::dropIfExists('test_reports');
    }
}
