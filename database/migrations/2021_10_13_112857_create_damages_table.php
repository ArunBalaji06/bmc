<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDamagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('damages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('rental_id')->nullable(false);
            $table->foreign('rental_id')->references('id')->on('rentals')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('payment_id')->nullable(false);
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade')->onUpdate('cascade');
            $table->text('damage_description')->nullable();
            $table->string('price_for_damage')->nullable();
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
        Schema::dropIfExists('damages');
    }
}
