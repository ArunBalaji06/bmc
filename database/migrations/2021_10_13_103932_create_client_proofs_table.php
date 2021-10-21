<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientProofsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_proofs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('client_detail_id')->nullable(false);
            $table->foreign('client_detail_id')->references('id')->on('client_details')->onDelete('cascade')->onUpdate('cascade');
            $table->string('client_proof_front');
            $table->string('client_proof_back');
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
        Schema::dropIfExists('client_proofs');
    }
}
