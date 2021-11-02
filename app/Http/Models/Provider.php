<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Provider extends Model
{
    use HasFactory;
    use softDeletes;
    
    protected $table = 'providers';
    protected $hidden = ['created_at', 'update_at'];
}
