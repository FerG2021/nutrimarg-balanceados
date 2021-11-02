<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Str, Config, Image;
use App\Http\Models\Provider;

class ProviderController extends Controller
{
    
    //NUEVO PROVEEDOR
    public function getNewProvider(){
        return view('pages.provider.newprovider');
    }

    public function postNewProvider(Request $request){
        $rules = [
            'cuit' => 'required|unique:App\Http\Models\Provider,cuit',
            'nameProvider' => 'required',
            'socialReason' => 'required',
            //'cuit' => 'required',
            //'direction' => 'required',
            'phone' => 'required',
            //'mail' => 'required',
        ];

       $messages = [
            'cuit.unique' => 'Ya existe un proveedor registrado con el CUIT ingresado',
            'cuit.required' => 'El CUIT del proveedor es requerido',
            'nameProvider.required' => 'El nombre del proveedor es requerido',
            'socialReason.required' => 'La razón social es requerida',
            'phone.required' => 'El teléfono es requerido',          
       ];

       $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {

            $provider = new Provider();

            $provider->nameProvider = $request->get('nameProvider');
            $provider->socialReason = $request->get('socialReason');
            $provider->cuit = $request->get('cuit');
            if ($request->get('direction' == null)) {
                $provider->direction = '---';
            } else {
                $provider->direction = $request->get('direction');
            }
            $provider->phone = $request->get('phone');
            if ($request->get('mail') == null) {
                $provider->mail = '---';
            } else {
                $provider->mail = $request->get('mail');
            }           

            if ($provider->save()) {
                return back()->with('message', 'Proveedor guardado con éxito')->with('typealert', 'alert alert-success');
            } else {                
            }
            
        }
        
        
    }

    //LISTA DE PROVEEDORES
    public function getListProvider(){

        $providers = Provider::all();

        return view('pages.provider.listprovider')->with('providers', $providers);
    }

    //EDITAR PROVEEDORES
    public function getEditProvider(Request $request, $id){

        $provider = Provider::find($id);

        return view('pages.provider.editprovider')->with('id', $id)->with('provider', $provider);
    }

    public function postEditProvider(Request $request, $id){
        $rules = [
            //'cuit' => 'required|unique:App\Http\Models\Provider,cuit',
            'nameProvider' => 'required',
            'socialReason' => 'required',
            //'cuit' => 'required',
            //'direction' => 'required',
            'phone' => 'required',
            //'mail' => 'required',
        ];

       $messages = [
            //'cuit.unique' => 'Ya existe un proveedor registrado con el CUIT ingresado',
            'cuit.required' => 'El CUIT del proveedor es requerido',
            'nameProvider.required' => 'El nombre del proveedor es requerido',
            'socialReason.required' => 'La razón social es requerida',
            'phone.required' => 'El teléfono es requerido',          
       ];

       $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {

            $provider = Provider::find($id);

            $provider->nameProvider = $request->get('nameProvider');
            $provider->socialReason = $request->get('socialReason');
            //$provider->cuit = $request->get('cuit');
            if ($request->get('direction' == null)) {
                $provider->direction = '---';
            } else {
                $provider->direction = $request->get('direction');
            }
            $provider->phone = $request->get('phone');
            if ($request->get('mail') == null) {
                $provider->mail = '---';
            } else {
                $provider->mail = $request->get('mail');
            }           

            if ($provider->save()) {
                return redirect('/provider/listprovider')->with('message', 'Proveedor actualizado con éxito')->with('typealert', 'alert alert-success');
            } else {                
            }
            
        }
    }

    public function getDeleteProvider($id){
        $provider = Provider::find($id);

        $provider->cuit = '0';
        $provider->save();
        
        $provider->delete();

        return back()->with('message', 'Proveedor eliminado con exito')->with('typealert', 'alert alert-success'); 
    }
}
