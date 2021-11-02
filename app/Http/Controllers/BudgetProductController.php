<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Str, Config, Image;
use App\Http\Models\Product;
use App\Http\Models\Budget;
use App\Http\Models\BudgetProduct;
use Livewire\Component;
use Carbon\Carbon;

class BudgetProductController extends Controller
{
    

    public function getNewBudget(Request $request){
        $now = Carbon::now();

        return view('pages.budget.newbudget')->with('now', $now);
    }

    public function postNewBudget(Request $request){
        $rules = [
            //'code' => 'required|unique:App\Http\Models\Product,code',
            'nameSeller' => 'required',
            'nameClient' => 'required',            
            'dateBudget' => 'required'            
       ];

       $messages = [
            'nameSeller.required' => 'El nombre del vendedor es requerido',
            'nameClient.required' => 'El nombre del cliente es requerido',
            'dateBudget.required' => 'La fecha de emisión del presupuesto es requerida'
       ];

       $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        else:                        
            $budget = new Budget();

            $budget->nameSeller = $request->get('nameSeller');
            $budget->nameClient = $request->get('nameClient');
            $budget->date = $request->get('dateBudget');
            $budget->totalPrice = 0;

            if($budget->save()):
                return redirect('/budget'.'/'.$budget->id.'/'.'addnewbudget')->with('message', 'Se comenzó a generar nuevo presupuesto...')->with('typealert', 'alert alert-primary');
            else:
            endif;  
        endif;
    }

    public function getAddNewBudget(Request $request, $id){
        // $buscarpor = $request->get('buscarpor');
        // $products = Product::where('name', 'like', '%'.$buscarpor.'%')->orderBy('name', 'asc')->paginate(25);    
        // $data = ['products' => $products];      

        $buscarpor = $request->get('buscarpor');
        $date = date('Y-m-d');
        $products = Product::where('name', 'like', '%'.$buscarpor.'%')->where([['date', '<', $date],['date', '<>', '2001-01-01'],])->get();    
        $data = ['products' => $products];  

        $products = Product::orderBy('name', 'asc')->get();
        
        $budgetproducts = BudgetProduct::where('budgetId', '=', $id)->get();

        

        return view('pages.budget.addnewbudget',compact('buscarpor'), $data)->with('products', $products)->with('budgetproducts', $budgetproducts)->with('id', $id);
    }

    public function postAddNewBudget(Request $request){
        $rules = [
            //'code' => 'required|unique:App\Http\Models\Product,code',
            'totalBudgetInput3' => 'required',
            'idInput' => 'required',                               
       ];

       $messages = [
            'totalBudgetInput3.required' => 'El precio total del presupuesto es requerido',
            'idInput.required' => 'El id del presupuesto es requerido',            
       ];

       $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()):
           return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        else:                        
           
            $id = $request->get('idInput');

            $budget = Budget::find($id);

            $budget->totalPrice = $request->get('totalBudgetInput3');

           if($budget->save()):
               return redirect('/budget.newbudget')->with('message', 'Presupuesto guardado con exito')->with('typealert', 'alert alert-success');
           else:
                return back()->with('message', 'No se pudo gurdar')->with('typealert', 'alert alert-success');
           endif;  
        endif;         
    }



    public function getAddNewBudgetProduct($id){

        $products = Product::orderBy('name', 'asc')->get();      

        return view('pages.budget.addnewbudgetproduct')->with('products', $products)->with('id', $id);
        
    }

    public function postAddNewBudgetProduct(Request $request){
        
        $rules = [
            //'code' => 'required|unique:App\Http\Models\Product,code',
            'nameSelectForm' => 'required',
            'cantBudgetForm' => 'required',            
            'pricesaleForm' => 'required'            
        ];

        $messages = [
            'nameSelectForm.required' => 'El nombre del producto es requerido',
            'cantBudgetForm.required' => 'La cantidad es requerida',
            'pricesaleForm.required' => 'El precio de venta es requerido'
        ];

       $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        else:                        
            $budgetproduct = new BudgetProduct();

            $budgetproduct->name = $request->get('nameSelectForm');
            $budgetproduct->cantProduct = $request->get('cantBudgetForm');
            $budgetproduct->priceProduct = $request->get('pricesaleForm');
            $subtotal = $request->get('cantBudgetForm') * $request->get('pricesaleForm'); 
            $budgetproduct->subtotal = $subtotal;
            $budgetproduct->budgetId = $request->get('idBudget');

            if($budgetproduct->save()):
                return back()->with('message', 'Producto agregado a la lista con éxito')->with('typealert', 'alert alert-success');
            else:
            endif;  
        endif;
    }

    public function getDeleteBudgetProduct($id){
        $budgetproduct = BudgetProduct::find($id);

        $budgetproduct->delete();
        return back()->with('message', 'Producto eliminado de la lista con éxito')->with('typealert', 'alert alert-success');
    }


    //LISTA DE PRESUPUESTOS
    public function getListBudget(){

        $budgets = Budget::where('totalPrice', '>', 0)->orderBy('id', 'desc')->get();

        return view('pages.budget.listbudget')->with('budgets', $budgets);
    }


    //DETALLE DE PRESUPUESTO
    public function getBudgetDetail($id){

        $budgetproducts = BudgetProduct::where('budgetId', '=', $id)->get();

        $budget = Budget::find($id);

        return view('pages.budget.budgetdetail')->with('budgetproducts', $budgetproducts )->with('budget', $budget)->with('id', $id);

    }

    public function getPdf($id){
        //$pdf = resolve('dompdf.wrapper');

        //$pdf->loadHTML('<h1>Test</h1>');

        
        $budgetproducts = BudgetProduct::where('budgetId', $id)->get();

        $budget = Budget::find($id);

        $pdf = \PDF::loadView('pages.budget.newpdf', compact('budgetproducts', 'budget'));

        //return $pdf->download('pages.budget.newpdf.pdf');


        // $budgetproducts = BudgetProduct::where('budgetId', $id);
        

        // return $pdf->stream('pages.budget.newpdf.pdf',compact('budgetproducts'));


        return $pdf->stream('pages.budget.newpdf.pdf');
    }
}
