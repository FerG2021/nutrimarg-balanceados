<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\softDeletes;

class Category extends Model
{
    use softDeletes;

    protected $dates = ['delete_at'];
    protected $table = 'categories';
    protected $hidden = ['created_at', 'update_at'];
}
