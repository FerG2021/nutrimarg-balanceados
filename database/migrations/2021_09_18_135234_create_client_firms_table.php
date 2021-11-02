<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientFirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_firms', function (Blueprint $table) {
            $table->id();
            $table->integer('typeClient');
            $table->string('cuit');
            $table->string('nameFirm');
            $table->string('socialReasonFirm');
            $table->string('phoneFirm');
            $table->string('mailFirm');
            $table->string('directionFirm');
            $table->softDeletes();
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
        Schema::dropIfExists('client_firms');
    }
}
