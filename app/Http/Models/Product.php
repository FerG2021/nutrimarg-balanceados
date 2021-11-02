<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Product extends Model
{
   use softDeletes;

   //protected $dates = ['delete_at'];
   protected $table = 'products';
   protected $hidden = ['created_at', 'update_at'];


   //relacion uno a muchos inversa - un producto pertenece a un presupuesto
   public function budget(){
      return $this->belongsTo('App\Http\Models\Budget');
   }
}
