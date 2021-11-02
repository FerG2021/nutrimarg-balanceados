<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('saleId')->unsigned();            
            $table->foreign('saleId')->references('id')->on('sales');
            $table->integer('idProduct');
            $table->string('name');
            $table->decimal('cantBagSale', 8, 2);
            $table->decimal('cantKgSale', 8, 2);
            $table->decimal('cantMountSale', 8, 2);
            $table->integer('cantProduct');                        
            $table->decimal('priceProductSale', 8, 2);
            // $table->decimal('porcPriceSale', 8, 2);
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
        Schema::dropIfExists('sale_products');
    }
}
