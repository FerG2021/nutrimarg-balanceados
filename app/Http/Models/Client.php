<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Client extends Model
{
    use HasFactory;
    use softDeletes;

   //protected $dates = ['delete_at'];
   protected $table = 'clients';
   protected $hidden = ['created_at', 'update_at'];
}
