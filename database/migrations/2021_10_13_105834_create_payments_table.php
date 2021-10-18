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
            $table->uuid('id')->primary();
            $table->uuid('request_id')->nullable(false);
            $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade')->onUpdate('cascade');
            $table->string('days')->nullable();
            $table->string('price')->nullable();
            $table->string('advance_payment')->nullable();
            $table->string('total_payment')->nullable()->comment("1-paid, 0-not paid");
            $table->string('rental')->nullable()->comment("1-rental done, 0-not rented");
            $table->string('damage_amount')->nullable();
            $table->string('damage_payment_status')->nullable()->comment("1-paid, 0-not paid");
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
        Schema::dropIfExists('payments');
    }
}
