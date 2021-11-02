<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Str;



use App\Http\Models\Category;

class CategoriesController extends Controller
{
    public function getCategories(){
        return view('pages.categories.home');
    }

    public function postCategoryAdd(Request $request){
        //validamos la informacion
        $rules = [
            'name' => 'required',
            'icon' => 'required',
        ];

        $messages = [
            'name.required' => 'Se requiere de un nombre para la categoria',
            'icon.required' => 'Se requiere de un icono para la categoría'
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        /**hacemos uso de validator mediante una variable que recibe como parametros todos los valores requeridos y laa reglas con las cuales debe validar esos datos */
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        else:
            $c = new Category;
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icon'));
            if($c->save()): 
                return back()->with('message', 'Guardado con exito')->with('typealert', 'alert alert-success');
            else: 
            endif;
        endif;
    }
}
