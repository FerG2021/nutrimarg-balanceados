<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('buyId')->unsigned();            
            $table->foreign('buyId')->references('id')->on('buys');
            $table->integer('idProduct');
            $table->string('name');
            $table->integer('cantProduct');
            $table->decimal('priceProductBuy', 8, 2);
            $table->decimal('porcPriceSale', 8, 2);
            $table->decimal('subtotal', 8, 2);   
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
        Schema::dropIfExists('buy_products');
    }
}
