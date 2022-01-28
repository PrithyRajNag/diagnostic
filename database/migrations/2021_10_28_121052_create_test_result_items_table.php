<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_result_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('title',50);
            $table->longText('reference');
            $table->longText('description')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('result_category_id')->references('id')->on('test_result_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('test_result_items');
    }
}
