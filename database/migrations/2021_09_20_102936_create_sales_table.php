<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('typeBuyer');
            $table->bigInteger('idClient')->unsigned();            
            // $table->foreign('idClient')->references('id')->on('clients');
            $table->bigInteger('idClientFirm')->unsigned();            
            // $table->foreign('idClientFirm')->references('id')->on('client_firms');
            $table->string('nameSeller');
            $table->string('nameBuyer');
            $table->date('dateSale');
            $table->decimal('totalPrice', 8, 2);
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
        Schema::dropIfExists('sales');
    }
}
