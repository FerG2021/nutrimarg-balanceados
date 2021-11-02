<?php

namespace App\Http\Controllers;

use App\Http\Models\Client;
use App\Http\Models\ClientFirm;
use Illuminate\Http\Request;
use Validator, Str, Config, Image;

class ClientController extends Controller
{

    // SELECCIONAR TIPO DE CLIENTE
    public function getSelectClient(){
        return view('pages.client.selectclient');
    }

    // AÑADIR NUEVO CLIENTE
    public function getNewClient(){
        return view('pages.client.newclient');
    }

    public function postNewClient(Request $request){
        $rules = [
            'dniClient' => 'required|unique:App\Http\Models\Client,dni',
            'nameClient' => 'required',
            'lastnameClient' => 'required',
            'directionClient' => 'required',            
            'phoneClient' => 'required',
            //'mail' => 'required',
        ];

        $messages = [
            'dniClient.unique' => 'Ya existe un cliente registrado con el DNI ingresado',
            'dniClient.required' => 'El DNI del cliente es requerido',
            'nameClient.required' => 'El nombre del cliente es requerido',
            'lastnameClient.required' => 'El apellido del cliente es requerido',
            'directionClient.required' => 'La dirección del cliente es requerida',
            'phoneClient.required' => 'El teléfono del cliente es requerido',          
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {

            $client = new Client();

            $client->dni = $request->get('dniClient');
            $client->typeClient = '1';
            $client->nameClient = $request->get('nameClient');
            $client->lastNameClient = $request->get('lastnameClient');
            $client->directionClient = $request->get('directionClient');
            $client->phoneClient = $request->get('phoneClient');

            if ($request->get('mailClient') == null) {
                $client->mailClient = '---';
            } else {
                $client->mailClient = $request->get('mailClient');
            }

            if ($client->save()) {
                return back()->with('message', 'Cliente guardado con éxito')->with('typealert', 'alert alert-success');
            } else {                
            }           
        }
    }

    // LISTA DE CLIENTES
    public function getListClient(){

        $clients = Client::orderBy('lastnameClient', 'asc')->get();

        return view('pages.client.listclient')->with('clients', $clients);
    }

    // EDITAR CLIENTE
    public function getEditClient($id){
        $client = Client::find($id);

        return view('pages.client.editclient')->with('id', $id)->with('client', $client);
    }
    
    public function postEditClient($id, Request $request){
        $rules = [
            // 'dniClient' => 'required|unique:App\Http\Models\Client,dni',
            'nameClient' => 'required',
            'lastnameClient' => 'required',
            'directionClient' => 'required',            
            'phoneClient' => 'required',
            //'mail' => 'required',
        ];

        $messages = [
            // 'dniClient.unique' => 'Ya existe un cliente registrado con el DNI ingresado',
            'dniClient.required' => 'El DNI del cliente es requerido',
            'nameClient.required' => 'El nombre del cliente es requerido',
            'lastnameClient.required' => 'El apellido del cliente es requerido',
            'directionClient.required' => 'La dirección del cliente es requerida',
            'phoneClient.required' => 'El teléfono del cliente es requerido',          
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {

            $client = Client::find($id);

            $client->dni = $request->get('dniClient');
            $client->nameClient = $request->get('nameClient');
            $client->lastNameClient = $request->get('lastnameClient');
            $client->directionClient = $request->get('directionClient');
            $client->phoneClient = $request->get('phoneClient');

            if ($request->get('mailClient') == null) {
                $client->mailClient = '---';
            } else {
                $client->mailClient = $request->get('mailClient');
            }

            if ($client->save()) {
                return redirect('/client/listclient')->with('message', 'Cliente actualizado con éxito')->with('typealert', 'alert alert-success');
            } else {                
            }           
        }
    }


    // ELIMINAR CLIENTE
    public function getDeleteClient($id){
        $client = Client::find($id);

        $client->dni = '0';
        $client->save();

        $client->delete();

        return back()->with('message', 'Cliente eliminado con exito')->with('typealert', 'alert alert-success'); 
    }



    // 
    // CLIENTE FIRMA
    // 

    // NUEVO CLIENTE FIRMA
    
    public function getNewClientFirm(){
        return view('pages.client.newclientfirm');
    }

    public function postNewClientFirm(Request $request){
        $rules = [
            'cuitClientFirm' => 'required|unique:App\Http\Models\ClientFirm,cuit',
            'nameFirm' => 'required',
            'socialReasonFirm' => 'required',
            'directionFirm' => 'required',            
            'phoneFirm' => 'required',
            //'mail' => 'required',
        ];

        $messages = [
            'cuitClientFirm.unique' => 'Ya existe una firma registrado con el CUIT ingresado',
            'cuitClientFirm.required' => 'El CUIT de la firma es requerido',
            'nameFirm.required' => 'El nombre de la firma es requerido',
            'socialReasonFirm.required' => 'La razón social de la firma es requerido',
            'directionFirm.required' => 'La dirección de la firma es requerida',
            'phoneFirm.required' => 'El teléfono de la firma es requerido',          
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {

            $clientFirm = new ClientFirm();

            $clientFirm->cuit = $request->get('cuitClientFirm');
            $clientFirm->typeClient = '1';
            $clientFirm->nameFirm = $request->get('nameFirm');
            $clientFirm->socialReasonFirm = $request->get('socialReasonFirm');
            $clientFirm->directionFirm = $request->get('directionFirm');
            $clientFirm->phoneFirm = $request->get('phoneFirm');

            if ($request->get('mailFirm') == null) {
                $clientFirm->mailFirm = '---';
            } else {
                $clientFirm->mailFirm = $request->get('mailFirm');
            }

            if ($clientFirm->save()) {
                return back()->with('message', 'Cliente (Firma) guardado con éxito')->with('typealert', 'alert alert-success');
            } else {                
            }           
        }
    }

    public function getListClientFirm(){
        $clientFirms = ClientFirm::orderBy('nameFirm', 'asc')->get();

        return view('pages.client.listclientFirm')->with('clientFirms', $clientFirms);
    }

    public function getEditClientFirm($id){
        $clientfirm = ClientFirm::find($id);

        return view('pages.client.editclientfirm')->with('id', $id)->with('clientfirm', $clientfirm);
    }

    public function postEditClientFirm($id, Request $request){
        $rules = [
            // 'cuitClientFirm' => 'required|unique:App\Http\Models\ClientFirm,cuit',
            'nameFirm' => 'required',
            'socialReasonFirm' => 'required',
            'directionFirm' => 'required',            
            'phoneFirm' => 'required',
            //'mail' => 'required',
        ];

        $messages = [
            // 'cuitClientFirm.unique' => 'Ya existe una firma registrado con el CUIT ingresado',
            'cuitClientFirm.required' => 'El CUIT de la firma es requerido',
            'nameFirm.required' => 'El nombre de la firma es requerido',
            'socialReasonFirm.required' => 'La razón social de la firma es requerido',
            'directionFirm.required' => 'La dirección de la firma es requerida',
            'phoneFirm.required' => 'El teléfono de la firma es requerido',          
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {

            $clientfirm = ClientFirm::find($id);

            $clientfirm->cuit = $request->get('cuitClientFirm');            
            $clientfirm->nameFirm = $request->get('nameFirm');
            $clientfirm->socialReasonFirm = $request->get('socialReasonFirm');
            $clientfirm->directionFirm = $request->get('directionFirm');
            $clientfirm->phoneFirm = $request->get('phoneFirm');

            if ($request->get('mailFirm') == null) {
                $clientfirm->mailFirm = '---';
            } else {
                $clientfirm->mailFirm = $request->get('mailFirm');
            }

            if ($clientfirm->save()) {
                return redirect('/client/listclientfirm')->with('message', 'Cliente (Firma) actualizado con éxito')->with('typealert', 'alert alert-success');
            } else {                
            }           
        }
    }

    // ELIMINAR CLIENTE FIRMA
        public function getDeleteClientFirm($id){
            $clientfirm = ClientFirm::find($id);

            $clientfirm->cuit = '0';
            $clientfirm->save();

            $clientfirm->delete();

            return back()->with('message', 'Cliente (Firma) eliminado con éxito')->with('typealert', 'alert alert-success'); 
        }


}