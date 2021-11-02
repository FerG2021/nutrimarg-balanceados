<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Str, Config, Image;
use App\Http\Models\Product;

class ProductController extends Controller
{
   public function getAddProduct(){
       return view('pages.addproduct');
   }

   //agregar producto
   public function postAddProduct(Request $request){
       $rules = [
            'code' => 'required|unique:App\Http\Models\Product,code',
            'name' => 'required',
            'image' => 'image',
            'pricebuy' => 'required',
            'porcpricesale' => 'required',
            'stock' => 'required',
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
            'stock.required' => 'El stock es requerido',
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
                if ($request->input('pricekg') == null || $request->input('kgbag') == null) {
                    return back()->with('message', 'Para un producto de venta por bolsa se debe colocar precio por kilo y kilos por bolsa')->with('typealert', 'alert alert-danger')->withInput();
                } else {
                    $product->pricekg = $request->input('pricekg');
                    $product->kgbag = $request->input('kgbag');
                }
                
            endif;
            $product->pricebuy = $request->input('pricebuy');
            $product->porcpricesale = $request->input('porcpricesale');
            $porc = $request->input('porcpricesale') / 100;
            $product->pricesale = ($porc * $request->input('pricebuy')) + $request->input('pricebuy'); 
            // $product->pricesale = $pricesale;
            //$product->pricekg = $request->input('pricekg');
            //$product->kgbag = $request->input('kgbag');
            $product->stock = $request->input('stock');
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

   //PRODUCTOS EN ALMACEN
   public function getProductsInStock(Request $request){
        // $buscarpor = $request->get('buscarpor');
        // $products = Product::where('name', 'like', '%'.$buscarpor.'%')->orderBy('code', 'asc')->paginate(25);      
        // $data = ['products' => $products];
        // return view('pages.productsinstock', compact('buscarpor'), $data);

        $products = Product::all();

        return view('pages.productsinstock')->with('products', $products);
        

        //$products = Product::orderBy('code', 'desc')->paginate(25);        
        //$data = ['products' => $products];
        //return view('pages.productsinstock', $data);

        //$buscarpor = $request->get('buscarpor');
        //$products = Product::where('name', 'like', '%'.$buscarpor.'%')->orderBy('code', 'asc')->paginate(25);        
        //$data = ['products' => $products];   
        //return view('pages.searchproduct',  compact('buscarpor'), $data);
   }

   //EDITAR PRODUCTOS
   public function getProductEdit($id){
        
        //$p = Product::where('code', $code)->get();
        $p = Product::find($id);
        $data = ['p' => $p];
        return view('pages.editproduct', $data);

        //return key($p);
        //return $p;
   }

    public function postProductEdit($id, Request $request){
        $rules = [
            //'code' => 'required|unique:App\Http\Models\Product,code',
            'name' => 'required',
            'image' => 'image',
            'pricebuy' => 'required',
            'porcpricesale' => 'required',
            'stock' => 'required',
            'stockmin' => 'required',
            //'date' => 'required'

        ];

        $messages = [
                //'code.unique' => 'Ya existe un producto registrado con el código ingresado',
                'code.required' => 'El código del producto es requerido',
                'name.required' => 'El nombre del producto es requerido',
                'image.image' => 'El archivo debe ser una imagen',
                'pricebuy.required' => 'El precio de compra es requerido',
                'porcpricesale.required' => 'El porcentaje de precio de venta es requerido',
                'stock.required' => 'El stock es requerido',
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
            

            $product = Product::find($id);
            //$product->code = $request->input('code');
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
            //$product->pricebuy = $request->input('pricebuy');
        
            $product->pricebuy = $request->get('pricebuy');
            $product->porcpricesale = $request->get('porcpricesale');
            $porc = $request->get('porcpricesale') / 100;
            $product->pricesale = ($request->get('pricebuy') * $porc) + $request->get('pricebuy');
            $product->stock = $request->get('stock');
            $product->stockmin = $request->get('stockmin');
            $product->expiration = $request->get('expiration');
            if($request->input('expiration') == '0'):
                $product->date = '2001-01-01'; 
            else: 
                if ($request->input('date') == null) {
                    return back()->with('message', 'Si el producto tiene fecha de vencimiento se debe ingresar una fecha')->with('typealert', 'alert alert-danger');
                } else {
                    $product->date = $request->input('date');
                }
                
            endif;

            if($product->save()):                 
                return redirect('/productsinstock')->with('message', 'Producto guardado con exito')->with('typealert', 'alert alert-success');
            else: 
            endif;      

        endif;
   }


   //Eliminar producto
   public function getProductDelete($id){
        $product = Product::find($id);        
        
        $product->delete();
        return back()->with('message', 'Producto eliminado con exito')->with('typealert', 'alert alert-success'); 

   }

   //Productos por vencimiento
   public function getProductsExpiration(Request $request){       
        $buscarpor = $request->get('buscarpor');
        $date = date('Y-m-d');
        // $products = Product::where('name', 'like', '%'.$buscarpor.'%')->where([['date', '<', $date],['date', '<>', '2001-01-01'],])->get(); 
        $products = Product::where([['date', '<', $date],['date', '<>', '2001-01-01'],])->get();    
        $data = ['products' => $products];   
        return view('pages.productsexpiration')->with('products', $products); 
        
        //$date = date('Y-m-d');
        //$products = Product::where([['date', '<', $date],['date', '<>', '2001-01-01'],])->get();    
        //$data = ['products' => $products];   
        //return view('pages.productsexpiration', $data);  
        
        //$buscarpor = $request->get('buscarpor');
        //$products = Product::where('name', 'like', '%'.$buscarpor.'%')->orderBy('code', 'asc')->paginate(25);      
        //$data = ['products' => $products];
        //return view('pages.productsinstock', compact('buscarpor'), $data);
   }

   //Productos en stock mínimo
   public function getMinStock(Request $request){
        $buscarpor = $request->get('buscarpor');
        $products = Product::where('name', 'like', '%'.$buscarpor.'%')->whereColumn('stockmin', '>=', 'stock')->get();       
        $data = ['products' => $products];          
        return view('pages.stockmin', compact('buscarpor'), $data);
    
        //$products = Product::whereColumn('stockmin', '>', 'stock')->get();       
       //$data = ['products' => $products];  
       //return $products;
       //return view('pages.sotckmin', $data);

       //$buscarpor = $request->get('buscarpor');
        //$products = Product::where('name', 'like', '%'.$buscarpor.'%')->orderBy('code', 'asc')->paginate(25);        
        //$data = ['products' => $products];   
        //return view('pages.searchproduct',  compact('buscarpor'), $data);
   }

   //buscar producto
   public function getSearchProduct(Request $request){
        
        $buscarpor = $request->get('buscarpor');
        $products = Product::where('name', 'like', '%'.$buscarpor.'%')->orderBy('code', 'asc')->paginate(25);        
        $data = ['products' => $products];   
        return view('pages.searchproduct',  compact('buscarpor'), $data);
        //return view('pages.searchproduct',  $data);       
   }

   //movimiento de productos
   public function getMovsProductsAdd(Request $request){
       //$products = Product::pluck('name', 'id');
       //$data = ['products' => $products]; 
        //return view('pages.movsproductsadd', compact('products'));        

        $buscarpor = $request->get('buscarpor');
        $products = Product::where('name', 'like', '%'.$buscarpor.'%')->orderBy('code', 'asc')->paginate(25);      
        $data = ['products' => $products];
        return view('pages.movsproductsadd', compact('buscarpor'), $data);
   }

   public function getMovsProductsAddAdd($id){
    $p = Product::find($id);
    $data = ['p' => $p];
    return view('pages.movsproductsaddadd', $data);
   }

   public function postMovsProductsAddAdd($id, Request $request){
        $rules = [
            //'code' => 'required|unique:App\Http\Models\Product,code',
            'name' => 'required',
            //'image' => 'image',
            'pricebuy' => 'required',
            //'pricesale' => 'required',
            'stock' => 'required',
            //'stockmin' => 'required',
            //'date' => 'required'
            'porcpricesale' => 'required'

        ];

        $messages = [
                //'code.unique' => 'Ya existe un producto registrado con el código ingresado',
                //'code.required' => 'El código del producto es requerido',
                'name.required' => 'El nombre del producto es requerido',
                //'image.image' => 'El archivo debe ser una imagen',
                'pricebuy.required' => 'El precio de compra es requerido',
                //'pricesale.required' => 'El precio de venta es requerido',
                'stock.required' => 'El stock es requerido',
                //'stockmin.required' => 'El stock mínimo es requerido',
                //'date.required' => 'La fecha de vencimiento es requerida'
                'porcpricesale.required' => 'El porcentaje para el precio de venta es requerido'
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
            else:              
                $product = Product::find($id);           
                $product->name = $request->input('name');           
                $product->pricebuy = $request->input('pricebuy');            
                    $newstock = $product->stock + $request->input('stock');
                $product->stock = $newstock; 
                    $pricesale =  ($request->input('porcpricesale') * $request->input('pricebuy')) + $request->input('pricebuy');
                $product->pricesale = $pricesale;
                if($product->save()):                    
                    return  redirect('/movsproductsadd')->with('message', 'Compra realizada con éxito')->with('typealert', 'alert alert-success');        
                else: 
            endif;            
        endif;

    }

    public function getMovsProductsRest(Request $request){
        $buscarpor = $request->get('buscarpor');
        $products = Product::where('name', 'like', '%'.$buscarpor.'%')->orderBy('code', 'asc')->paginate(25);      
        $data = ['products' => $products];
        return view('pages.movsproductsrest', compact('buscarpor'), $data);
    }

    public function getMovsProductsRestRest($id){
        $p = Product::find($id);
        $data = ['p' => $p];
        return view('pages.movsproductsrestrest', $data);
    }

    public function postMovsProductsRestRest($id, Request $request){
       
        // TIPO DE VENTA POR UNIDAD
        $rulesunity = [            
            'name' => 'required',            
            'stock' => 'required', //cantidad de unidades a vender            
        ];

        $messagesunity = [                
                'name.required' => 'El nombre del producto es requerido',
                'stock.required' => 'La cantidad de productos a vender es requerido'               
        ];

        $validatorunity = Validator::make($request -> all(), $rulesunity, $messagesunity);       
        
        
        // TIPO DE VENTA POR BOLSA
        $rulesbag = [
            'name' => 'required',           
            'stock' => 'required', //cantidad de bolsas a vender            
            //'kgsale' => 'required', //cantidad de kilos a vender
            //'amountsale' => 'required' //cantidad de monto a vender
            'tipe' => 'required'
        ];

        $messagesbag = [               
                'name.required' => 'El nombre del producto es requerido',
                'stock.required' => 'La cantidad a vender es requerida',   
                //'kgsale.required' => 'Los kilos a vender son requeridos',
                //'amountsale.required' => 'El monto a vender es requerido'
                'tipe.required' => 'La forma de venta es requerida', 
        ];

        $validatorbag = Validator::make($request -> all(), $rulesbag, $messagesbag);

        
        if ($request->input('tipesale') == 0) {
            if ($validatorunity->fails()) {
                return back()->withErrors($validatorunity)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
            } else {
                $product = Product::find($id);                  
                if ($product->stock >= $request->input('stock')) {
                    $product->name = $request->input('name');
                    $newstock = $product->stock - $request->input('stock');
                    $product->stock = $newstock;                    
                } else {
                    return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger'); 
                }

                if ($product->save()) {
                    return  redirect('/movsproductsrest')->with('message', 'Venta realizada con éxito')->with('typealert', 'alert alert-success'); 
                } else {
                    # code...
                }
                
            }
            
        } else {
            if ($validatorbag->fails()) {
                return back()->withErrors($validatorbag)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
            } else {
                $product = Product::find($id);             
                // CANTIDAD DE BOLSAS A VENDER
                if ($request->input('tipe') == '0') {
                    if ($product->stock >= $request->input('stock')) {
                        $product->name = $request->input('name');
                        $newstock = $product->stock - $request->input('stock');
                        $product->stock = $newstock;
                    } else {
                        return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                    }
                    
                } else {
                    //KILOS VENDIDOS
                    if ($request->input('tipe') == '1') {
                        $kgsale = $request->input('stock');
                        $kgtotal = $product->stock * $product->kgbag;
                        if ($kgtotal >= $kgsale) {
                            $kgstockrest = $kgsale / $product->kgbag;
                            $product->stock = $product->stock - $kgstockrest;
                        } else {
                        return  back()->with('message', 'No hay cantidad de kilos suficientes para realizar la venta')->with('typealert', 'alert alert-danger');
                        }
                        
                    } else {
                        //MONTO VENDIDO
                        if ($request->input('tipe') == '2') {
                            $cantstockamount = $request->input('stock') / $product->pricekg;
                            $stockamount = $product->stock * $product->kgbag * $product->pricekg;
                            if($stockamount >= $request->input('stock')) {
                                $product->stock = $product->stock - $cantstockamount;
                            } else {
                                return  back()->with('message', 'No hay stock suficiente para realizar la venta')->with('typealert', 'alert alert-danger');
                            }
                            
                        } else {
                            # code...
                        }
                        
                    }
                    
                }

                if ($product->save()) {
                    return  redirect('/movsproductsrest')->with('message', 'Venta realizada con éxito')->with('typealert', 'alert alert-success'); 
                } else {
                    # code...
                }
            }
            
                
            
            
        }
        

    }


}
