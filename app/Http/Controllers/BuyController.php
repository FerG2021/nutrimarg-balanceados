<?php

namespace App\Http\Controllers;

use App\Http\Models\Buy;
use Illuminate\Http\Request;
use Validator, Str, Config, Image;
use Livewire\Component;
use Carbon\Carbon;
use App\Http\Models\Provider;
use App\Http\Models\Product;
use App\Http\Models\BuyProduct;

class BuyController extends Controller
{
    public function getNewBuy(){
        $now = Carbon::now();

        $providers = Provider::orderBy('nameProvider', 'asc')->get();

        return view('pages.buy.newbuy')->with('now', $now)->with('providers', $providers);
    }

    public function postNewBuy(Request $request){
        $rules = [
            //'code' => 'required|unique:App\Http\Models\Product,code',
            'nameSeller' => 'required',
            'nameProvider' => 'required',            
            'date' => 'required'            
       ];

       $messages = [
            'nameSeller.required' => 'El nombre del comprador es requerido',
            'nameProvider.required' => 'El nombre del proveedor es requerido',
            'date.required' => 'La fecha de compra es requerida'
       ];

       $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        else:                        
            $buy = new Buy();

            $buy->nameSeller = $request->get('nameSeller');
            $buy->nameProvider = $request->get('nameProvider');
            $buy->date = $request->get('date');
            $buy->totalPrice = 0;

            if($buy->save()):
                return redirect('/buy'.'/'.$buy->id.'/'.'addnewbuy')->with('message', 'Se comenzó a generar nueva venta...')->with('typealert', 'alert alert-primary');
                // return back()->with('message', 'Se comenzó a generar nuevo compra...')->with('typealert', 'alert alert-primary');
            else:
            endif;  
        endif;
    }


    public function getAddNewBuy($id){
        
        $products = Product::orderBy('name', 'asc')->get();
        $productconsults = Product::orderBy('code', 'asc')->get();

        $buyproducts = BuyProduct::where('buyId', $id)->get();
        
        return view('pages.buy.addnewbuy')->with('id', $id)->with('products', $products)->with('buyproducts', $buyproducts)->with('productconsults', $productconsults);
    }

    //AGREGAR UN NUEVO PRODUCTO A LA COMPRA
    public function postAddNewBuy(Request $request, $id){
        $rules = [
            //'code' => 'required|unique:App\Http\Models\Product,code',
            'nameProduct' => 'required',
            'cant' => 'required',            
            'pricebuy' => 'required',
            'porcsale' => 'required'            
        ];

        $messages = [
            'nameProduct.required' => 'El nombre del producto es requerido',
            'cant.required' => 'La cantidad a comprar es requerida',
            'pricebuy.required' => 'El precio de compra es requerido',
            'porcsale.required' => 'El porcentaje para la venta es requerido',
        ];

       $validator = Validator::make($request -> all(), $rules, $messages);

        if ($request->get('nameProduct') == 'Seleccione un producto') {
            return redirect('/buy'.'/'.$id.'/'.'addnewbuy')->with('message', 'Se ha producido un error - Se debe seleccionar un producto')->with('typealert', 'alert alert-danger')->withInput();
        } else {
            if ($validator->fails()):
                return redirect('/buy'.'/'.$id.'/'.'addnewbuy')->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
            else:                        
                $buyproduct = new BuyProduct();
    
                $buyproduct->buyId = $request->get('buyId');
                $buyproduct->idProduct = $request->get('idProduct');
                $buyproduct->name = $request->get('nameProduct');
                $buyproduct->cantProduct = $request->get('cant');
                $buyproduct->priceProductBuy = $request->get('pricebuy');
                $subtotal = $request->get('cant') * $request->get('pricebuy');         
                $buyproduct->subtotal = $subtotal;
                $buyproduct->porcPriceSale = $request->get('porcsale');
                $cant = $request->get('cant');
    
                if($buyproduct->save()):
                    
                    // $idProduct = $request->get('idProduct');
                    
                    // $product = Product::find($idProduct);
    
                    // $product->stock = $product->stock + $cant;
    
                    // $product->save();
    
                    return back()->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                else:
                endif;  
            endif;
        }
        
    }

    // QUITAR PRODUCTO DE LA LISTA
    public function getDeleteBuyProduct($id){
        $buyproduct = BuyProduct::find($id);

        $buyproduct->delete();
        return back()->with('message', 'Producto eliminado de la lista de compra con éxito')->with('typealert', 'alert alert-success');
    }

    // AGREGAR NUEVO PRODUCTO
    public function postAddNewProduct(Request $request){
        $rules = [
            'code' => 'required|unique:App\Http\Models\Product,code',
            'name' => 'required',
            'image' => 'image',
            'pricebuy' => 'required',
            'porcpricesale' => 'required',
            // 'stock' => 'required',
            'stockmin' => 'required',
            //'date' => 'required'

       ];

       $messages = [
            'code.unique' => 'Ya existe un producto registrado con el código ingresado',
            'code.required' => 'El código del producto es requerido',
            'name.required' => 'El nombre del producto es requerido',
            'image.image' => 'El archivo debe ser una imagen',
            'pricebuy.required' => 'El precio de compra es requerido',
            'porcpricesale.required' => 'El porcentaje para el precio de venta es requerido',
            // 'stock.required' => 'El stock es requerido',
            'stockmin.required' => 'El stock mínimo es requerido',
            //'date.required' => 'La fecha de vencimiento es requerida'
       ];

       $validator = Validator::make($request -> all(), $rules, $messages);

       if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        else:
                        
            //$path = '/'.date('Y-m-d');
            //$fileExt = trim($request->file('img')->getClientOriginalExtension());
            //$upload_path = Config::get('filesystems.disks.uploads.root');
           // $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

            //$filename = rand(1,999).'-'.$name.'.'.$fileExt;   
            //$file_file = $upload_path.'/'.$path.'/'.$filename;       
            

            $product = new Product;
            $product->code = $request->input('code');
            $product->name = $request->input('name');
            //$product->image = $filename;
            $product->image = 'imagedefault.png';
            $product->file_path = date('Y-m-d');
            $product->tipesale = $request->input('tipesale');
            if($request->input('tipesale') == '0'):
                $product->pricekg = '0';
                $product->kgbag = '0';
            else: 
                $product->pricekg = $request->input('pricekg');
                $product->kgbag = $request->input('kgbag');
            endif;
            $product->pricebuy = $request->input('pricebuy');
            $product->porcpricesale = $request->input('porcpricesale');
            $porc = $request->input('porcpricesale') / 100;
            $pricesale = ($porc * $request->input('pricebuy')) + $request->input('pricebuy'); 
            $product->pricesale = $pricesale;
            //$product->pricekg = $request->input('pricekg');
            //$product->kgbag = $request->input('kgbag');
            // $product->stock = $request->input('stock');
            $product->stock = 0;
            $product->stockmin = $request->input('stockmin');
            $product->expiration = $request->input('expiration');
            if($request->input('expiration') == '0'):
                $product->date = '2001-01-01'; 
            else: 
                if ($request->input('date') == null) {
                    return back()->with('message', 'Si el producto tiene fecha de vencimiento se debe ingresar una fecha')->with('typealert', 'alert alert-danger');
                } else {
                    $product->date = $request->input('date');
                }
            endif;
            //$product->date = $request->input('date');
            if($product->save()): 
                //if($request->hasFile('img')): 
                   // $fl = $request->img->storeAs($path, $filename, 'uploads');
                   // $img = Image::make($file_file);
                   // $img->fit(256,256, function($constraint){
                   //     $constraint->upsize();
                   // });
                   // $img->save($upload_path.'/'.$path.'/t'.$filename);
                //endif;
                return back()->with('message', 'Producto guardado con exito')->with('typealert', 'alert alert-success');
            else: 
            endif;            
        endif;
    }

    // CONFIRMAR COMPRA
    public function postAddNewBuyConfirm(Request $request){
        $rules = [
            //'code' => 'required|unique:App\Http\Models\Product,code',
            'totalBudgetInput3' => 'required',
            'idBuyInput' => 'required',                               
       ];
    
       $messages = [
            'totalBudgetInput3.required' => 'El precio total de la compra es requerido',
            'idBuyInput.required' => 'El id de la compra es requerido',            
       ];
    
       $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        else:                        
        
            if ($request->get('totalBudgetInput3') == 0) {
                return back()->with('message', 'No se puede gurdar una compra con monto igual a 0')->with('typealert', 'alert alert-danger');
            } else {
                $id = $request->get('idBuyInput');

                $buy = Buy::find($id);

                $buy->totalPrice = $request->get('totalBudgetInput3');

                if($buy->save()):

                    // busco los productos comprados para actulizar datos en tabla products
                    $productsBuy = BuyProduct::where('buyId', $id)->where('deleted_at', null)->get();

                    $products = Product::all();

                    foreach ($productsBuy as $productBuy) {
                        $product = Product::find($productBuy->idProduct);

                        $product->stock = $product->stock + $productBuy->cantProduct;
                        $product->pricebuy = $productBuy->priceProductBuy;
                        $product->porcpricesale = $productBuy->porcPriceSale;
                        $porc = $productBuy->porcPriceSale / 100;
                        $product->pricesale = ($productBuy->priceProductBuy * $porc) + $productBuy->priceProductBuy;

                        $product->save();
                    }

                    return redirect('/buy/newbuy')->with('message', 'Compra guardada con éxito')->with('typealert', 'alert alert-success');
                else:
                    return back()->with('message', 'No se pudo gurdar la compra')->with('typealert', 'alert alert-success');
                endif;  
            }
            

        endif;         
    }

    // CANCELAR COMPRA
    public function getCancelNewBuy($id){
        $buy = Buy::find($id);

        $buy->delete();
        return redirect('/buy/newbuy')->with('message', 'Compra cancelada con éxito')->with('typealert', 'alert alert-success');
    }

    // lista de compras
    public function getListBuy(){

        $buys = Buy::orderBy('id','desc')->where('totalPrice', '>', 0)->get();

        return view('pages.buy.listbuy')->with('buys', $buys);
    }

    
    // detalle de compra
    public function getBuyDetail($id){
        $buyproducts = BuyProduct::where('buyId', $id)->get();

        $buy = Buy::find($id);

        return view('pages.buy.buydetail')->with('buyproducts', $buyproducts)->with('buy', $buy)->with('id', $id);
    }


    //generar PDF
    public function getPdf($id){
        //$pdf = resolve('dompdf.wrapper');

        //$pdf->loadHTML('<h1>Test</h1>');

        
        $buyproducts = BuyProduct::where('buyId', $id)->get();

        $buy = Buy::find($id);

        $pdf = \PDF::loadView('pages.buy.newpdf', compact('buyproducts', 'buy'));

        //return $pdf->download('pages.budget.newpdf.pdf');


        // $budgetproducts = BudgetProduct::where('budgetId', $id);
        

        // return $pdf->stream('pages.budget.newpdf.pdf',compact('budgetproducts'));


        return $pdf->stream('pages.buy.newpdf.pdf');
    }
}

