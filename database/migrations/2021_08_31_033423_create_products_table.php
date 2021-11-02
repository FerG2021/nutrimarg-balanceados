<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->unique();
            $table->string('name');
            $table->string('image');
            $table->integer('tipesale');
            $table->decimal('pricebuy',9,2); 
            $table->integer('porcpricesale');
            $table->decimal('pricesale',9,2);
            $table->decimal('pricekg',9,2);
            $table->integer('kgbag');
            $table->decimal('stock',9,2);
            $table->decimal('stockmin',9,2);
            $table->integer('expiration');
            $table->date('date');
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
        Schema::dropIfExists('products');
    }
}
