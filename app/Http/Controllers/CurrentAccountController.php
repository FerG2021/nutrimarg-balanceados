<?php

namespace App\Http\Controllers;

use App\Http\Models\CurrentAccount;
use App\Http\Models\CurrentAccountDetail;
use App\Http\Models\Sale;
use App\Http\Models\SaleProduct;
use Illuminate\Http\Request;
use Validator, Str, Config, Image;
use Carbon\Carbon;

class CurrentAccountController extends Controller
{
    // lista de cuenta corriente de todos los clientes 
    public function getListCurrentAccount(){
        $clientcas = CurrentAccount::orderBy('lastNameClient', 'asc')->get();
        $now = Carbon::now();
        
        $deudors = 0;

        // consulto si la fecha de deuda es mayor a 30 dias
        foreach ($clientcas as $clientca) {
            $dateca = Carbon::parse($clientca->datelastaction);
            $datenow = Carbon::parse($now);
            $diference = $dateca->diffInDays($datenow);
            if ($diference >= 30) {
                //fecha mayor a 30
                $deudors = 1;

                // actualizo el campo deudors en la tabla
                $id = $clientca->id;
                $clientdeudor = CurrentAccount::find($id);

                $clientdeudor->deudors = 1;
                $clientdeudor->save();

                // return view('pages.currentaccount.listca')->with('clientcas', $clientcas)->with('now', $now)->with('deudors', $deudors);
            } else {
                // actualizo el campo deudors en la tabla
                $id = $clientca->id;
                $clientdeudor = CurrentAccount::find($id);
                $clientdeudor->deudors = 0;
                $clientdeudor->save();
            }            
        }


        return view('pages.currentaccount.listca')->with('clientcas', $clientcas)->with('now', $now)->with('deudors', $deudors);
    }

    // lista de cuenta corriente - Persona
    public function getListCurrentAccountPerson(){
        $caclients = CurrentAccount::where('clientIdFirm', 0)->get();

        return view('pages.currentaccount.listcaperson')->with('caclients', $caclients);
    }

    // lista de cuenta corriente - Firma comercial
    public function getListCurrentAccountFirm(){
        $cafirms = CurrentAccount::where('clientId', 0)->get();

        return view('pages.currentaccount.listcafirm')->with('cafirms', $cafirms);
    }


    public function getDetailClientCA($id){
        $clientcadetails = CurrentAccountDetail::where('idCurrentAccount', $id)->get();

        return view('pages.currentaccount.detailclientca')->with('clientcadetails', $clientcadetails);
    }

    // detalle de cada compra del cliente en la cuenta corriente
    public function getDetailSaleClientCA($id){
        // busco el detalle de cuenta corriente por id
        // $clientca = CurrentAccountDetail::find($id);

        // tomo el id de la venta
        // $caidsale = $clientca->idSale;

        // busco la venta
        // $saledetail = Sale::find($caidsale);

        // busco los productos de la venta
        $saleproducts = SaleProduct::where('saleId', $id)->get();

        return view('pages.currentaccount.detailproductsclientca')->with('saleproducts', $saleproducts);

    }

    // pagar saldo de cuenta corriente
    public function postPayBalanceCA(Request $request, $id){
        $now = Carbon::now();

        $rules = [
            'balance' => 'required',
            'mountpay' => 'required',
            'idClient' => 'required',
        ];

       $messages = [            
            'balance.required' => 'El monto adeudado es requerido',
            'mountpay.required' => 'El monto a pagar por el cliente es requerido',  
            'idClient.required' => 'El id del cliente es requerido',       
       ];

       $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput();
        } else {
            
            if ($request->get('balance') >= $request->get('mountpay')) {
                // busco el cliente y actualizo el saldo de la cuenta corriente
                
                // pregunto si es un cliente o una firma comercial
                if ($request->get('idClient') != null && $request->get('idClientFirm') == null) {
                    // persona
                    $clientca = CurrentAccount::find($id);
                    $clientca->balance = $clientca->balance - $request->get('mountpay');
                    $clientca->datelastaction = $now->format('Y-m-d');
                    $clientca->save();

                    // agrego el detalle de pago en los detalles de la cuenta corriente del cliente, agregando un nuevo detalle 
                    $cadetail = new CurrentAccountDetail();

                    $cadetail->idCurrentAccount = $id;
                    $cadetail->idClient = $request->get('idClient');
                    $cadetail->idClientFirm = '0';
                    $cadetail->idsale = '0';
                    $cadetail->date = $now->format('Y-m-d');
                    $cadetail->typemovement = '1';
                    $cadetail->pay = $request->get('mountpay');
                    $cadetail->sale = '0';
                } else {
                    // firma comercial
                    $clientca = CurrentAccount::find($id);
                    $clientca->balance = $clientca->balance - $request->get('mountpay');
                    $clientca->datelastaction = $now->format('Y-m-d');
                    $clientca->save();

                    // agrego el detalle de pago en los detalles de la cuenta corriente del cliente, agregando un nuevo detalle 
                    $cadetail = new CurrentAccountDetail();

                    $cadetail->idCurrentAccount = $id;
                    $cadetail->idClient = '0';
                    $cadetail->idClientFirm = $request->get('idClientFirm');
                    $cadetail->idsale = '0';
                    $cadetail->date = $now->format('Y-m-d');
                    $cadetail->typemovement = '1';
                    $cadetail->pay = $request->get('mountpay');
                    $cadetail->sale = '0';
                }
                

                if ($cadetail->save()) {

                    // actulizo deudors
                    $clientcas = CurrentAccount::orderBy('lastNameClient', 'asc')->get();
                    $now = Carbon::now();
                    
                    $deudors = 0;

                    // consulto si la fecha de deuda es mayor a 30 dias
                    foreach ($clientcas as $clientca) {
                        $dateca = Carbon::parse($clientca->datelastaction);
                        $datenow = Carbon::parse($now);
                        $diference = $dateca->diffInDays($datenow);
                        if ($diference >= 30) {
                            //fecha mayor a 30
                            $deudors = 1;

                            // actualizo el campo deudors en la tabla
                            $id = $clientca->id;
                            $clientdeudor = CurrentAccount::find($id);

                            $clientdeudor->deudors = 1;
                            $clientdeudor->save();

                            // return view('pages.currentaccount.listca')->with('clientcas', $clientcas)->with('now', $now)->with('deudors', $deudors);
                        } else {
                            // actualizo el campo deudors en la tabla
                            $id = $clientca->id;
                            $clientdeudor = CurrentAccount::find($id);
                            $clientdeudor->deudors = 0;
                            $clientdeudor->save();
                        }            
                    }

                    return back()->with('message', 'Pago procesado con éxito')->with('typealert', 'alert alert-success');
                } else {
                    return back()->with('message', 'No se pudo procesar el pago')->with('typealert', 'alert alert-danger');
                }
            } else {
                return back()->with('message', 'No se puede pagar un monto mayor que la cantidad adeudada')->with('typealert', 'alert alert-danger');
            }
            
            

        }
       
    }

    // generar PDF - detalle de cuenta
    public function getPDF($id){        
        // busco el detalle de la cuenta corriente
        $cadetails = CurrentAccountDetail::where('idCurrentAccount', $id)->get();

        // busco los datos de la cuenta corriente
        $ca = CurrentAccount::find($id);

        $pdf = \PDF::loadView('pages.currentaccount.newpdf', compact('cadetails', 'ca'));
        
        return $pdf->stream('pages.currentaccount.newpdf.pdf');


    }
}
