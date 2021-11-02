<?php

namespace App\Http\Controllers;

use App\Http\Models\Sale;
use Illuminate\Http\Request;
use Validator, Str, Config, Image;
use App\Http\Models\Client;
use App\Http\Models\ClientFirm;
use App\Http\Models\Product;
use App\Http\Models\SaleProduct;
use App\Http\Models\CurrentAccount;
use App\Http\Models\CurrentAccountDetail;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function getSelectNewSale(){

        $products = Product::all();

        $now = Carbon::now();

        return view('pages.sale.selectnewsale')->with('now', $now)->with('products', $products);
    }

    // 
    // CONSUMIDOR FINAL
    // 

    // DETALLE DE VENTA - CONSUMIDOR FINAL
    public function postNewSaleCF(Request $request){

        $sale = new Sale();

        $sale->typeBuyer = '3';
        $sale->idClient = '0';
        $sale->idClientFirm = '0';
        $sale->nameSeller = $request->get('nameSeller');
        $sale->nameBuyer = 'Consumidor final';
        $sale->dateSale = $request->get('dateBudget');
        $sale->totalPrice = '0';

        if ($sale->save()) {
            return redirect('/sale'.'/'.$sale->id.'/'.'addsaleproductscf')->with('message', 'Se comenzó a generar una nueva venta...')->with('typealert', 'alert alert-primary');
        } else {                
        }                
    }

    // AGREGAR PRODUCTOS A LA VENTA - CONSUMIDOR FINAL
    public function getAddSaleProductsCF($id){
        $products = Product::orderBy('name', 'asc')->get();
        $productconsults = Product::orderBy('code', 'asc')->get();

        $saleproducts = SaleProduct::where('saleId', $id)->get();

        return view('pages.sale.saledetailcf')->with('products', $products)->with('productconsults', $productconsults)->with('id', $id)->with('saleproducts', $saleproducts);
    }

    public function postAddNewSaleProduct(Request $request, $id){
        $rules = [
            'nameProduct' => 'required',
            'pricesale' => 'required',
            // 'typesalebag' => 'required',            
            'cant' => 'required',
            //'mail' => 'required',
        ];

        $messages = [            
            'nameProduct.required' => 'El nombre del producto es requerido',
            'pricesale.required' => 'El precio de venta es requerido',
            // 'typesalebag.required' => 'La forma de venta es requerida',
            'cant.required' => 'La cantidad a vender es requerida',          
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {
            // valido si tiene nombre del producto
            if ($request->get('nameProduct') == "Seleccione un producto") {
                return redirect('/sale'.'/'.$id.'/'.'addsaleproductscf')->withErrors($validator)->with('message', 'Se debe ingresar el nombre del producto a vender')->withInput();
            } else {
                // validar el tipo de venta
                if ($request->get('tipesaleinput') == 0) {
                    // forma de venta por unidad
                    if ($request->get("typesalebag") == 4) {
                        $product = Product::find($request->get('idProduct'));

                        if ($product->stock < $request->get('cant')) {
                            return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                        } else {
                            $saleproduct = new SaleProduct();

                            $saleproduct->saleId = $id;
                            $saleproduct->idProduct = $request->get('idProduct');
                            $saleproduct->name = $request->get('nameProduct');
                            $saleproduct->cantBagSale = '0';
                            $saleproduct->cantKgSale = '0';
                            $saleproduct->cantMountSale = '0';
                            $saleproduct->cantProduct = $request->get('cant');
                            $saleproduct->priceProductSale = $request->get('pricesale');
                            $saleproduct->subtotal = $request->get('cant') * $request->get('pricesale');

                            if ($saleproduct->save()) {
                                return redirect('/sale'.'/'.$id.'/'.'addsaleproductscf')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                            } else {                
                            }
                        }
                        

                    } else {
                        return back()->with('message', 'Se debe seleccionar forma de venta por unidad')->with('typealert', 'alert alert-danger');
                    }                    

                } else {
                    // forma de venta por bolsa
                    if ($request->get('typesalebag') == 1) {
                        $productbag = Product::find($request->get('idProduct'));

                        if ($productbag->stock >= $request->get('cant')) {
                            $saleproduct = new SaleProduct();

                            $saleproduct->saleId = $id;
                            $saleproduct->idProduct = $request->get('idProduct');
                            $saleproduct->name = $request->get('nameProduct');
                            $saleproduct->cantBagSale = $request->get('cant');
                            $saleproduct->cantKgSale = '0';
                            $saleproduct->cantMountSale = '0';
                            $saleproduct->cantProduct = '0';
                            $saleproduct->priceProductSale = $request->get('pricesale');
                            $saleproduct->subtotal = $request->get('cant') * $request->get('pricesale');

                            if ($saleproduct->save()) {
                                return redirect('/sale'.'/'.$id.'/'.'addsaleproductscf')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                            } else {                
                            }

                        } else {
                            return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                        }
                        

                    } else {
                        // venta por kilos
                        if ($request->get('typesalebag') == 2) {
                            $productbag = Product::find($request->get('idProduct'));

                            // saco la cantidad total de kilos que tengo segun las bolsas en stock
                            $canttotalkg = $productbag->kgbag * $productbag->stock; 

                            if ($canttotalkg >= $request->get('cant')) {
                                
                                $saleproduct = new SaleProduct();

                                $saleproduct->saleId = $id;
                                $saleproduct->idProduct = $request->get('idProduct');
                                $saleproduct->name = $request->get('nameProduct');
                                $saleproduct->cantBagSale = '0';
                                $saleproduct->cantKgSale = $request->get('cant');
                                $saleproduct->cantMountSale = '0';
                                $saleproduct->cantProduct = '0';
                                $saleproduct->priceProductSale = $request->get('pricekg');
                                $saleproduct->subtotal = $request->get('cant') * $request->get('pricekg');

                                if ($saleproduct->save()) {
                                    return redirect('/sale'.'/'.$id.'/'.'addsaleproductscf')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                                } else {                
                                }


                            } else {
                                return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                            }
                            

                        } else {
                            // venta por monto
                            if ($request->get('typesalebag') == 3) {
                                $productbag = Product::find($request->get('idProduct'));

                                // saco la cantidad en pesos que puedo sacar segun el stock disponible
                                $canttotalprice = ($productbag->stock * $productbag->kgbag) * $productbag->pricekg;

                                if ($canttotalprice >= $request->get('cant')) {
                                    $saleproduct = new SaleProduct();

                                    $saleproduct->saleId = $id;
                                    $saleproduct->idProduct = $request->get('idProduct');
                                    $saleproduct->name = $request->get('nameProduct');
                                    $saleproduct->cantBagSale = '0';
                                    $saleproduct->cantKgSale = '0';
                                    $saleproduct->cantMountSale = $request->get('cant');
                                    $saleproduct->cantProduct = '0';
                                    $saleproduct->priceProductSale = $request->get('cant');
                                    $saleproduct->subtotal = $request->get('cant');

                                    if ($saleproduct->save()) {
                                        return redirect('/sale'.'/'.$id.'/'.'addsaleproductscf')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                                    } else {                
                                    }

                                } else {
                                    return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                                }
                                

                            } else {
                                return  back()->with('message', 'Para realizar una venta de un producto por bolsa no se puede seleccionar "Venta por unidad"')->with('typealert', 'alert alert-danger');
                            }
                            
                        }
                        
                    }
                    
                }
                
            }
            
        }
    }

    // eliminar un producto de la lista de venta
    public function getDeleteSaleProductCF($id){
        $productsale = SaleProduct::find($id);        
        
        $productsale->delete();
        return back()->with('message', 'Producto eliminado de la lista de venta con éxito')->with('typealert', 'alert alert-success'); 
    }

    // confirmar venta - consumidor final
    public function postAddNewSaleConfirmCF(Request $request){
        $rules = [
            'totalBudgetInput6' => 'required',
            'idSaleInput' => 'required',            
        ];

        $messages = [            
            'totalBudgetInput6.required' => 'El precio total de la venta es requerido',
            'idSaleInput.required' => 'El id de la venta es requerido',               
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {
           
            $id = $request->get('idSaleInput');
            $sale = Sale::find($id);

            $sale->totalPrice = $request->get('totalBudgetInput6');

            if ($sale->save()) {
                

                // actualizo el stock de los productos
                $productsales = SaleProduct::where('saleId', $id)->get();
                
                foreach ($productsales as $productsale) {
                    $product = Product::find($productsale->idProduct);

                    // venta por unidad
                    if ($productsale->cantProduct != 0) {
                        $product->stock = $product->stock - $productsale->cantProduct;
                    } else {
                        // venta por bolsa
                        if ($productsale->cantBagSale != 0) {
                            $product->stock = $product->stock - $productsale->cantBagSale;
                        } else {
                            // venta por kilo
                            if ($productsale->cantKgSale != 0) {
                                $kgsale = $productsale->cantKgSale;
                                $kgstockrest = $kgsale / $product->kgbag;
                                $product->stock = $product->stock - $kgstockrest;
                            } else {
                                // venta por monto
                                if ($productsale->cantMountSale != 0) {
                                    $cantstockamount = $productsale->cantMountSale / $product->pricekg;
                                    $product->stock = $product->stock - $cantstockamount;
                                } else {
                                    # code...
                                }
                                
                            }
                            
                        }
                        
                    }

                    $product->save();
                    
                }

                return redirect('/sale/selectnewsale')->with('message', 'Venta realizada con éxito')->with('typealert', 'alert alert-success');

            } else { 

            }    

        }

    }


    // cancelar venta - Consumidor final
    public function getCancelNewSaleCF($id){
        $sale = Sale::find($id);

        $sale->delete();

        return redirect('/sale/selectnewsale')->with('message', 'Venta cancelada con éxito')->with('typealert', 'alert alert-success');    
    }

    // historial de ventas - Consumidor final
    public function getListSalesCF(){
        $sales = Sale::where('totalPrice', '>', 0)->where('typeBuyer', 3)->orderBy('id', 'desc')->get();

        return view('pages.sale.listsales')->with('sales', $sales);
    }


    // 
    // PERSONA
    // 

    // nueva venta - Persona
    public function getNewSaleP(){
        $clients = Client::orderBy('lastNameClient', 'asc')->get();

        return view('pages.sale.newsalep')->with('clients', $clients);
    }

    // nueva venta - Persona - añadir nuevo cliente
    public function postAddNewClientSale(Request $request){
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

    // nueva venta - Persona
    public function postNewSaleP(Request $request){
        $rules = [
            'nameSeller' => 'required',
            'nameBuyer' => 'required',
            'dateSale' => 'required',            
        ];

        $messages = [            
            'nameSeller.required' => 'El nombre del vendedor es requerido',
            'nameBuyer.required' => 'El nombre del cliente es requerido',
            'dateSale.required' => 'La fecha de venta es requerida',
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {

            $sale = new Sale();

            $sale->typeBuyer = '1';
            $sale->idClient = $request->get('idClient');
            $sale->idClientFirm = '0';
            $sale->nameSeller = $request->get('nameSeller');
            $sale->nameBuyer = $request->get('nameClient');
            $sale->dateSale = $request->get('dateSale');
            $sale->totalPrice = '0';

            // buscar id, nombre y apellido del cliente
            $idclient = $request->get('idClient');
            $clients = Client::find($idclient);
            

            if ($sale->save()) {
                return redirect('/sale'.'/'.$sale->id.'/'.'addsaleproductsp')->with('message', 'Se comenzó a generar una nueva venta')->with('typealert', 'alert alert-primary')->with('clients', $clients);
            } else {                
            }           
        }
    }

    // detalles de nueva venta - Persona
    public function getAddSaleProductsP($id){

        $saleproducts = SaleProduct::where('saleId', $id)->get();

        $products = Product::orderBy('name', 'asc')->get();

        $productconsults = Product::orderBy('code', 'asc')->get();

        // buscar id, nombre y apellido del cliente
        // $idclient = $request->get('idClient');
        $sale = Sale::find($id);

        $clients = Client::where('id', $sale->idClient)->get();
      

        return view('pages.sale.saledetailp')->with('id', $id)->with('saleproducts', $saleproducts)->with('products', $products)->with('productconsults', $productconsults)->with('clients', $clients)->with('sale', $sale);
    }

    // añadir nuevo producto a la lista de ventas - Persona
    public function postAddNewSaleProductP($id, Request $request){
        $rules = [
            'nameProduct' => 'required',
            'pricesale' => 'required',
            // 'typesalebag' => 'required',            
            'cant' => 'required',
            //'mail' => 'required',
        ];

        $messages = [            
            'nameProduct.required' => 'El nombre del producto es requerido',
            'pricesale.required' => 'El precio de venta es requerido',
            // 'typesalebag.required' => 'La forma de venta es requerida',
            'cant.required' => 'La cantidad a vender es requerida',          
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {
            // valido si tiene nombre del producto
            if ($request->get('nameProduct') == "Seleccione un producto") {
                return redirect('/sale'.'/'.$id.'/'.'addsaleproductsp')->withErrors($validator)->with('message', 'Se debe ingresar el nombre del producto a vender')->withInput();
            } else {
                // validar el tipo de venta
                if ($request->get('tipesaleinput') == 0) {
                    // forma de venta por unidad
                    if ($request->get("typesalebag") == 4) {

                        $saleproduct = new SaleProduct();

                        $saleproduct->saleId = $id;
                        $saleproduct->idProduct = $request->get('idProduct');
                        $saleproduct->name = $request->get('nameProduct');
                        $saleproduct->cantBagSale = '0';
                        $saleproduct->cantKgSale = '0';
                        $saleproduct->cantMountSale = '0';
                        $saleproduct->cantProduct = $request->get('cant');
                        $saleproduct->priceProductSale = $request->get('pricesale');
                        $saleproduct->subtotal = $request->get('cant') * $request->get('pricesale');

                        if ($saleproduct->save()) {
                            return redirect('/sale'.'/'.$id.'/'.'addsaleproductsp')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                        } else {                
                        }

                    } else {
                        return back()->with('message', 'Se debe seleccionar forma de venta por unidad')->with('typealert', 'alert alert-danger');
                    }                    

                } else {
                    // forma de venta por bolsa
                    if ($request->get('typesalebag') == 1) {
                        $productbag = Product::find($request->get('idProduct'));

                        if ($productbag->stock >= $request->get('cant')) {
                            $saleproduct = new SaleProduct();

                            $saleproduct->saleId = $id;
                            $saleproduct->idProduct = $request->get('idProduct');
                            $saleproduct->name = $request->get('nameProduct');
                            $saleproduct->cantBagSale = $request->get('cant');
                            $saleproduct->cantKgSale = '0';
                            $saleproduct->cantMountSale = '0';
                            $saleproduct->cantProduct = '0';
                            $saleproduct->priceProductSale = $request->get('pricesale');
                            $saleproduct->subtotal = $request->get('cant') * $request->get('pricesale');

                            if ($saleproduct->save()) {
                                return redirect('/sale'.'/'.$id.'/'.'addsaleproductsp')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                            } else {                
                            }

                        } else {
                            return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                        }
                        

                    } else {
                        // venta por kilos
                        if ($request->get('typesalebag') == 2) {
                            $productbag = Product::find($request->get('idProduct'));

                            // saco la cantidad total de kilos que tengo segun las bolsas en stock
                            $canttotalkg = $productbag->kgbag * $productbag->stock; 

                            if ($canttotalkg >= $request->get('cant')) {
                                
                                $saleproduct = new SaleProduct();

                                $saleproduct->saleId = $id;
                                $saleproduct->idProduct = $request->get('idProduct');
                                $saleproduct->name = $request->get('nameProduct');
                                $saleproduct->cantBagSale = '0';
                                $saleproduct->cantKgSale = $request->get('cant');
                                $saleproduct->cantMountSale = '0';
                                $saleproduct->cantProduct = '0';
                                $saleproduct->priceProductSale = $request->get('pricekg');
                                $saleproduct->subtotal = $request->get('cant') * $request->get('pricekg');

                                if ($saleproduct->save()) {
                                    return redirect('/sale'.'/'.$id.'/'.'addsaleproductsp')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                                } else {                
                                }


                            } else {
                                return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                            }
                            

                        } else {
                            // venta por monto
                            if ($request->get('typesalebag') == 3) {
                                $productbag = Product::find($request->get('idProduct'));

                                // saco la cantidad en pesos que puedo sacar segun el stock disponible
                                $canttotalprice = ($productbag->stock * $productbag->kgbag) * $productbag->pricekg;

                                if ($canttotalprice >= $request->get('cant')) {
                                    $saleproduct = new SaleProduct();

                                    $saleproduct->saleId = $id;
                                    $saleproduct->idProduct = $request->get('idProduct');
                                    $saleproduct->name = $request->get('nameProduct');
                                    $saleproduct->cantBagSale = '0';
                                    $saleproduct->cantKgSale = '0';
                                    $saleproduct->cantMountSale = $request->get('cant');
                                    $saleproduct->cantProduct = '0';
                                    $saleproduct->priceProductSale = $request->get('cant');
                                    $saleproduct->subtotal = $request->get('cant');

                                    if ($saleproduct->save()) {
                                        return redirect('/sale'.'/'.$id.'/'.'addsaleproductsp')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                                    } else {                
                                    }

                                } else {
                                    return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                                }
                                

                            } else {
                                return  back()->with('message', 'Para realizar una venta de un producto por bolsa no se puede seleccionar "Venta por unidad"')->with('typealert', 'alert alert-danger');
                            }
                            
                        }
                        
                    }
                    
                }
                
            }
            
        }
    }

    // guardar venta - Persona
    public function postAddNewSaleConfirmP(Request $request){
        $rules = [
            'totalBudgetInput6' => 'required',
            'idSaleInput' => 'required',
            'totalPayClient' => 'required',              
        ];

        $messages = [            
            'totalBudgetInput6.required' => 'El precio total de la venta es requerido',
            'idSaleInput.required' => 'El id de la venta es requerido',
            'totalPayClient.required' => 'El monto pagado por el cliente es requerido',               
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {
           
            $id = $request->get('idSaleInput');
            $sale = Sale::find($id);

            $sale->totalPrice = $request->get('totalBudgetInput6');

            if ($sale->save()) {
                
                // actualizo el stock de los productos                
                $productsales = SaleProduct::where('saleId', $id)->get();
                
                foreach ($productsales as $productsale) {
                    $product = Product::find($productsale->idProduct);

                    // venta por unidad
                    if ($productsale->cantProduct != 0) {
                        $product->stock = $product->stock - $productsale->cantProduct;
                    } else {
                        // venta por bolsa
                        if ($productsale->cantBagSale != 0) {
                            $product->stock = $product->stock - $productsale->cantBagSale;
                        } else {
                            // venta por kilo
                            if ($productsale->cantKgSale != 0) {
                                $kgsale = $productsale->cantKgSale;
                                $kgstockrest = $kgsale / $product->kgbag;
                                $product->stock = $product->stock - $kgstockrest;
                            } else {
                                // venta por monto
                                if ($productsale->cantMountSale != 0) {
                                    $cantstockamount = $productsale->cantMountSale / $product->pricekg;
                                    $product->stock = $product->stock - $cantstockamount;
                                } else {
                                    # code...
                                }
                                
                            }
                            
                        }
                        
                    }

                    $product->save();
                    
                }


                // pregunto si la cantidad pagada por el cliente es menor a la cantidad total de la venta
                if ($request->get('totalPayClient') < $request->get('totalBudgetInput6')) {
                    // pregunto si ya existe el cliente en cuenta corriente

                    $clientcas = CurrentAccount::where('clientId',$request->get('idClientInput'))->get();
                    

                    $clientId = null;
                    
                    foreach ($clientcas as $clientca) {
                        $clientId =  $clientca->clientId;
                    }
                    
                    if ($clientId != null) {
    
                        $clientca->balance = $clientca->balance + ($request->get('totalBudgetInput6') - $request->get('totalPayClient'));
                        $clientca->datelastaction = $request->get('dateSale');
                        $clientca->save();

                        // guardo los detalles de la compra que se guarda en la cuenta corriente

                        $cadetail = new CurrentAccountDetail();

                        $cadetail->idCurrentAccount = $clientca->id;
                        $cadetail->idClient = $request->get('idClientInput');
                        $cadetail->idClientFirm = '0';
                        $cadetail->idSale = $request->get('idSaleInput');
                        // 0 - compra // 1 - pago
                        $cadetail->date = $request->get('dateSale');
                        $cadetail->typemovement = '0';
                        $cadetail->sale = $request->get('totalBudgetInput6') - $request->get('totalPayClient');
                        $cadetail->pay = '0';

                        $cadetail->save();

                    } else {

                        
                        $currentaccount = new CurrentAccount();

                        $currentaccount->clientId = $request->get('idClientInput');
                        $currentaccount->clientIdFirm = '0';
                        $currentaccount->dniClient = $request->get('dniClient');
                        $currentaccount->nameClient = $request->get('nameClientInput');
                        $currentaccount->lastNameClient = $request->get('lastNameClientInput');
                        $currentaccount->balance = $currentaccount->balance + ($request->get('totalBudgetInput6') - $request->get('totalPayClient'));
                        $currentaccount->datelastaction = $request->get('dateSale');

                        $currentaccount->save();

                        // guardo los detalles de la compra que se guarda en la cuenta corriente

                        $cadetail = new CurrentAccountDetail();

                        $cadetail->idCurrentAccount = $currentaccount->id;
                        $cadetail->idClient = $request->get('idClientInput');
                        $cadetail->idClientFirm = '0';
                        $cadetail->idSale = $request->get('idSaleInput');
                        // 0 - compra // 1 - pago
                        $cadetail->typemovement = '0';
                        $cadetail->date = $request->get('dateSale');
                        $cadetail->sale = $request->get('totalBudgetInput6') - $request->get('totalPayClient');
                        $cadetail->pay = '0';

                        $cadetail->save();
                    }
                    

                } else {
                    return back()->with('message', 'El pago del cliente no puede ser mayor al monto total de la compra')->with('typealert', 'alert alert-danger');
                }

                // actualizo el campo deudors si corresponde
                // pregunto por la fecha, si es superior a 30 actualizo el campor deudors

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
                

                return redirect('/sale/selectnewsale')->with('message', 'Venta realizada con éxito')->with('typealert', 'alert alert-success');

            } else { 

            }    

        }
    }

    // cancelar la venta - Personas
    public function getCancelNewSaleP($id){
        $sale = Sale::find($id);

        $sale->delete();

        return redirect('/sale/selectnewsale')->with('message', 'Venta cancelada con éxito')->with('typealert', 'alert alert-success'); 
    }

    // historial de ventas - Personas
    public function getListSalesP(){
        $sales = Sale::where('totalPrice', '>', 0)->where('typeBuyer', 1)->orderBy('id', 'desc')->get();

        return view('pages.sale.listsales')->with('sales', $sales);
    }

    // 
    // FIRMA COMERCIAL
    // 

    // nueva venta - Firma comercial
    public function getNewSaleFC(){
        $clientfirms = ClientFirm::orderBy('nameFirm', 'asc')->get();

        return view('pages.sale.newsalefc')->with('clientfirms', $clientfirms);
    }

    public function postNewSaleFC(Request $request){
        $rules = [
            'nameSeller' => 'required',
            'nameBuyer' => 'required',
            'dateSale' => 'required',            
        ];

        $messages = [            
            'nameSeller.required' => 'El nombre del vendedor es requerido',
            'nameBuyer.required' => 'El nombre de la firma comercial es requerido',
            'dateSale.required' => 'La fecha de venta es requerida',
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {

            $sale = new Sale();

            $sale->typeBuyer = '2';
            $sale->idClient = '0';
            $sale->idClientFirm = $request->get('idClient');
            $sale->nameSeller = $request->get('nameSeller');
            $sale->nameBuyer = $request->get('nameClient');
            $sale->dateSale = $request->get('dateSale');
            $sale->totalPrice = '0';


            if ($sale->save()) {
                return redirect('/sale'.'/'.$sale->id.'/'.'addsaleproductsfc')->with('message', 'Se comenzó a generar una nueva venta...')->with('typealert', 'alert alert-primary');
            } else {                
            }           
        }
    }

    // añadir nuevo cliente - firma comercial
    public function postAddNewClientFirmSale(Request $request){
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


    // detalles de venta - Firma comercial
    public function getAddSaleProductsFC($id){

        // busco los productos que pertenecen a la venta para mostrarlos en la tabla
        $saleproducts = SaleProduct::where('saleId', $id)->get();

        // busco los productos en stock para mostrarlos en el modal
        $products = Product::orderBy('name', 'asc')->get();

        // busco los productos en stock para mostrar en el modal de consulta
        $productconsults = Product::orderBy('code', 'asc')->get();

        // buscar id, nombre y apellido del cliente
        // $idclient = $request->get('idClient');
        $sale = Sale::find($id);

        $clients = ClientFirm::where('id', $sale->idClientFirm)->get();

        return view('pages.sale.saledetailfc')->with('id', $id)->with('saleproducts', $saleproducts)->with('products', $products)->with('productconsults', $productconsults)->with('sale', $sale)->with('clients', $clients);
    }


    // agregar un nuevo producto a la venta - Firma comercial
    public function postAddNewSaleProductFC($id, Request $request){
        $rules = [
            'nameProduct' => 'required',
            'pricesale' => 'required',
            // 'typesalebag' => 'required',            
            'cant' => 'required',
            //'mail' => 'required',
        ];

        $messages = [            
            'nameProduct.required' => 'El nombre del producto es requerido',
            'pricesale.required' => 'El precio de venta es requerido',
            // 'typesalebag.required' => 'La forma de venta es requerida',
            'cant.required' => 'La cantidad a vender es requerida',          
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {
            // valido si tiene nombre del producto
            if ($request->get('nameProduct') == "Seleccione un producto") {
                return redirect('/sale'.'/'.$id.'/'.'addsaleproductsfc')->withErrors($validator)->with('message', 'Se debe ingresar el nombre del producto a vender')->withInput();
            } else {
                // validar el tipo de venta
                if ($request->get('tipesaleinput') == 0) {
                    // forma de venta por unidad
                    if ($request->get("typesalebag") == 4) {

                        $saleproduct = new SaleProduct();

                        $saleproduct->saleId = $id;
                        $saleproduct->idProduct = $request->get('idProduct');
                        $saleproduct->name = $request->get('nameProduct');
                        $saleproduct->cantBagSale = '0';
                        $saleproduct->cantKgSale = '0';
                        $saleproduct->cantMountSale = '0';
                        $saleproduct->cantProduct = $request->get('cant');
                        $saleproduct->priceProductSale = $request->get('pricesale');
                        $saleproduct->subtotal = $request->get('cant') * $request->get('pricesale');

                        if ($saleproduct->save()) {
                            return redirect('/sale'.'/'.$id.'/'.'addsaleproductsfc')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                        } else {                
                        }

                    } else {
                        return back()->with('message', 'Se debe seleccionar forma de venta por unidad')->with('typealert', 'alert alert-danger');
                    }                    

                } else {
                    // forma de venta por bolsa
                    if ($request->get('typesalebag') == 1) {
                        $productbag = Product::find($request->get('idProduct'));

                        if ($productbag->stock >= $request->get('cant')) {
                            $saleproduct = new SaleProduct();

                            $saleproduct->saleId = $id;
                            $saleproduct->idProduct = $request->get('idProduct');
                            $saleproduct->name = $request->get('nameProduct');
                            $saleproduct->cantBagSale = $request->get('cant');
                            $saleproduct->cantKgSale = '0';
                            $saleproduct->cantMountSale = '0';
                            $saleproduct->cantProduct = '0';
                            $saleproduct->priceProductSale = $request->get('pricesale');
                            $saleproduct->subtotal = $request->get('cant') * $request->get('pricesale');

                            if ($saleproduct->save()) {
                                return redirect('/sale'.'/'.$id.'/'.'addsaleproductsfc')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                            } else {                
                            }

                        } else {
                            return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                        }
                        

                    } else {
                        // venta por kilos
                        if ($request->get('typesalebag') == 2) {
                            $productbag = Product::find($request->get('idProduct'));

                            // saco la cantidad total de kilos que tengo segun las bolsas en stock
                            $canttotalkg = $productbag->kgbag * $productbag->stock; 

                            if ($canttotalkg >= $request->get('cant')) {
                                
                                $saleproduct = new SaleProduct();

                                $saleproduct->saleId = $id;
                                $saleproduct->idProduct = $request->get('idProduct');
                                $saleproduct->name = $request->get('nameProduct');
                                $saleproduct->cantBagSale = '0';
                                $saleproduct->cantKgSale = $request->get('cant');
                                $saleproduct->cantMountSale = '0';
                                $saleproduct->cantProduct = '0';
                                $saleproduct->priceProductSale = $request->get('pricekg');
                                $saleproduct->subtotal = $request->get('cant') * $request->get('pricekg');

                                if ($saleproduct->save()) {
                                    return redirect('/sale'.'/'.$id.'/'.'addsaleproductsfc')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                                } else {                
                                }


                            } else {
                                return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                            }
                            

                        } else {
                            // venta por monto
                            if ($request->get('typesalebag') == 3) {
                                $productbag = Product::find($request->get('idProduct'));

                                // saco la cantidad en pesos que puedo sacar segun el stock disponible
                                $canttotalprice = ($productbag->stock * $productbag->kgbag) * $productbag->pricekg;

                                if ($canttotalprice >= $request->get('cant')) {
                                    $saleproduct = new SaleProduct();

                                    $saleproduct->saleId = $id;
                                    $saleproduct->idProduct = $request->get('idProduct');
                                    $saleproduct->name = $request->get('nameProduct');
                                    $saleproduct->cantBagSale = '0';
                                    $saleproduct->cantKgSale = '0';
                                    $saleproduct->cantMountSale = $request->get('cant');
                                    $saleproduct->cantProduct = '0';
                                    $saleproduct->priceProductSale = $request->get('cant');
                                    $saleproduct->subtotal = $request->get('cant');

                                    if ($saleproduct->save()) {
                                        return redirect('/sale'.'/'.$id.'/'.'addsaleproductsfc')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                                    } else {                
                                    }

                                } else {
                                    return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                                }
                                

                            } else {
                                return  back()->with('message', 'Para realizar una venta de un producto por bolsa no se puede seleccionar "Venta por unidad"')->with('typealert', 'alert alert-danger');
                            }
                            
                        }
                        
                    }
                    
                }
                
            }
            
        }
    }


    // confirmar la venta - Firma comercial
    public function postAddNewSaleConfirmFC(Request $request){
        $rules = [
            'totalBudgetInput6' => 'required',
            'idSaleInput' => 'required',
            'totalPayClient' => 'required',              
        ];

        $messages = [            
            'totalBudgetInput6.required' => 'El precio total de la venta es requerido',
            'idSaleInput.required' => 'El id de la venta es requerido',
            'totalPayClient.required' => 'El monto pagado por el cliente es requerido',               
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        } else {
           
            $id = $request->get('idSaleInput');
            $sale = Sale::find($id);

            $sale->totalPrice = $request->get('totalBudgetInput6');

            if ($sale->save()) {
                
                // actualizo el stock de los productos
                $productsales = SaleProduct::where('saleId', $id)->get();
                
                foreach ($productsales as $productsale) {
                    $product = Product::find($productsale->idProduct);

                    // venta por unidad
                    if ($productsale->cantProduct != 0) {
                        $product->stock = $product->stock - $productsale->cantProduct;
                    } else {
                        // venta por bolsa
                        if ($productsale->cantBagSale != 0) {
                            $product->stock = $product->stock - $productsale->cantBagSale;
                        } else {
                            // venta por kilo
                            if ($productsale->cantKgSale != 0) {
                                $kgsale = $productsale->cantKgSale;
                                $kgstockrest = $kgsale / $product->kgbag;
                                $product->stock = $product->stock - $kgstockrest;
                            } else {
                                // venta por monto
                                if ($productsale->cantMountSale != 0) {
                                    $cantstockamount = $productsale->cantMountSale / $product->pricekg;
                                    $product->stock = $product->stock - $cantstockamount;
                                } else {
                                    # code...
                                }
                                
                            }
                            
                        }
                        
                    }

                    $product->save();
                    
                }


                // pregunto si la cantidad pagada por el cliente es menor a la cantidad total de la venta
                if ($request->get('totalPayClient') < $request->get('totalBudgetInput6')) {
                    // pregunto si ya existe el cliente en cuenta corriente
                    
                    $clientcas = CurrentAccount::where('clientIdFirm',$request->get('idClientInput'))->get();
                    

                    $clientId = null;
                    
                    foreach ($clientcas as $clientca) {
                        $clientId =  $clientca->clientIdFirm;
                    }

                    if ($clientId != null) {
    
                        $clientca->balance = $clientca->balance + ($request->get('totalBudgetInput6') - $request->get('totalPayClient'));
                        $clientca->datelastaction = $request->get('dateSale');
                        $clientca->save();

                        // guardo los detalles de la compra que se guarda en la cuenta corriente

                        $cadetail = new CurrentAccountDetail();

                        $cadetail->idCurrentAccount = $clientca->id;
                        $cadetail->idClient = '0';
                        $cadetail->idClientFirm = $request->get('idClientInput');
                        $cadetail->idSale = $request->get('idSaleInput');
                        // 0 - compra // 1 - pago
                        $cadetail->date = $request->get('dateSale');
                        $cadetail->typemovement = '0';
                        $cadetail->sale = $request->get('totalBudgetInput6') - $request->get('totalPayClient');
                        $cadetail->pay = '0';

                        $cadetail->save();

                    } else {

                        
                        $currentaccount = new CurrentAccount();

                        $currentaccount->clientId = '0';
                        $currentaccount->clientIdFirm = $request->get('idClientInput');
                        $currentaccount->dniClient = $request->get('dniClient');
                        $currentaccount->nameClient = $request->get('nameClientInput');
                        $currentaccount->lastNameClient = $request->get('lastNameClientInput');
                        $currentaccount->balance = $currentaccount->balance + ($request->get('totalBudgetInput6') - $request->get('totalPayClient'));
                        $currentaccount->datelastaction = $request->get('dateSale');

                        $currentaccount->save();

                        // guardo los detalles de la compra que se guarda en la cuenta corriente

                        $cadetail = new CurrentAccountDetail();

                        $cadetail->idCurrentAccount = $currentaccount->id;
                        $cadetail->idClient = '0';
                        $cadetail->idClientFirm = $request->get('idClientInput');
                        $cadetail->idSale = $request->get('idSaleInput');
                        // 0 - compra // 1 - pago
                        $cadetail->typemovement = '0';
                        $cadetail->date = $request->get('dateSale');
                        $cadetail->sale = $request->get('totalBudgetInput6') - $request->get('totalPayClient');
                        $cadetail->pay = '0';

                        $cadetail->save();
                    }
                    

                } else {
                    return back()->with('message', 'El pago del cliente no puede ser mayor al monto total de la compra')->with('typealert', 'alert alert-primary');
                }

                // actualizo el campo deudors si corresponde
                // pregunto por la fecha, si es superior a 30 actualizo el campor deudors

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
                

                return redirect('/sale/selectnewsale')->with('message', 'Venta realizada con éxito')->with('typealert', 'alert alert-success');

            } else { 

            }    

        }
    }

    // cancelar la venta - Firma comercial
    public function getCancelNewSaleFC($id){
        $sale = Sale::find($id);

        $sale->delete();

        return redirect('/sale/selectnewsale')->with('message', 'Venta cancelada con éxito')->with('typealert', 'alert alert-success'); 
    }

    // 
    // HISTORIAL DE VENTAS
    // 
    
    // historial de ventas
    public function getListSales(){
        $sales = Sale::where('totalPrice', '>', 0)->orderBy('id', 'desc')->get();

        return view('pages.sale.listsales')->with('sales', $sales);
    }

    // filtrar ventas por fecha
    public function postFilterDateSale(Request $request){
        $rules = [
            'dateinit' => 'required',
            'datefinish' => 'required',                       
        ];

        $messages = [            
            'dateinit.required' => 'La fecha de inicio es requerida',
            'datefinish.required' => 'La fecha de finalización es requerida',
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/sale/listsales')->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput();
        } else {
            $sales = Sale::where([['dateSale', '>=', $request->get('dateinit')], ['dateSale', '<=', $request->get('datefinish')]])->get();

            $dateinit = $request->get('dateinit');
            $datefinish = $request->get('datefinish');

            return view('pages.sale.listsales')->with('sales', $sales);
        }


        
    }

    // detalle de ventas
    public function getSaleDetail($id){
        $sale = Sale::find($id);

        $saleproducts = SaleProduct::where('saleId', $id)->get();

        return view('pages.sale.saledetails')->with('id', $id)->with('saleproducts', $saleproducts)->with('sale', $sale);
    }    

    // generar PDF de las ventas
    public function getpdf($id){
        $pdf = resolve('dompdf.wrapper');

        //$pdf->loadHTML('<h1>Test</h1>');

        
        $saleproducts = SaleProduct::where('saleId', $id)->get();

        $sale = Sale::find($id);

        $pdf = \PDF::loadView('pages.sale.newpdf', compact('saleproducts', 'sale'));

        //return $pdf->download('pages.budget.newpdf.pdf');


        // $budgetproducts = BudgetProduct::where('budgetId', $id);
        

        // return $pdf->stream('pages.budget.newpdf.pdf',compact('budgetproducts'));


        return $pdf->stream('pages.sale.newpdf.pdf');
    }
}
