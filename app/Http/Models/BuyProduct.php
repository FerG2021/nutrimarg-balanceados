<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class BuyProduct extends Model
{
    use HasFactory;
    use softDeletes;

   //protected $dates = ['delete_at'];
   protected $table = 'buy_products';
   protected $hidden = ['created_at', 'update_at'];
}
