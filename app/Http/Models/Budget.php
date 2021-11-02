<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class Budget extends Model
{
    use softDeletes;

    protected $dates = ['delete_at'];
    protected $table = 'budgets';
    protected $hidden = ['created_at', 'update_at'];

    
    
    //Relacion uno a muchos - Un presupuesto puede tener muchos productos
    public function products(){
        return $this->hasMany('App\Http\Models\BudgetProduct');
    }
}
