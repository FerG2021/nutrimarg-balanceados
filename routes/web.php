<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


//login
Route::get('/', 'App\Http\Controllers\ConnectController@getLogin')->name('login'); //ruta para llamar el login
Route::post('/', 'App\Http\Controllers\ConnectController@postLogin')->name('login'); //ruta para llamar el login

//registrar usuario
Route::get('/register', 'App\Http\Controllers\ConnectController@getRegister')->name('register'); //ruta para llamar el login
Route::post('/register', 'App\Http\Controllers\ConnectController@postRegister')->name('register');

//logout
Route::get('/logout', 'App\Http\Controllers\ConnectController@getLogout')->name('logout'); //ruta para llamar el login

//pagina home
Route::get('/home', 'App\Http\Controllers\ConnectController@getHome')->name('home')->middleware('auth');

//categorias
Route::get('/categories', 'App\Http\Controllers\CategoriesController@getCategories')->name('categories')->middleware('auth');
Route::post('/category/addcategory', 'App\Http\Controllers\CategoriesController@postCategoryAdd')->middleware('auth');

// 
// USUARIOS
// 

// agregar usuario
Route::get('/user/adduser', 'App\Http\Controllers\UserController@getAddUser')->middleware('auth');
Route::post('/user/adduser', 'App\Http\Controllers\UserController@postAddUser')->middleware('auth');

// lista de usuarios
Route::get('/user/listuser', 'App\Http\Controllers\UserController@getListUser')->middleware('auth');

// editar usuarios
Route::get('/user/{id}/edituser', 'App\Http\Controllers\UserController@getEditUser')->middleware('auth');
Route::post('/user/{id}/edituser', 'App\Http\Controllers\UserController@postEditUser')->middleware('auth');

// eliminar usuario
Route::get('/user/{id}/deleteuser', 'App\Http\Controllers\UserController@getDeleteUser')->middleware('auth');

//PRODUCTOS
//nuevo producto
Route::get('/addproduct', 'App\Http\Controllers\ProductController@getAddProduct')->name('addproduct')->middleware('auth');
Route::post('/addproduct', 'App\Http\Controllers\ProductController@postAddProduct')->name('addproduct')->middleware('auth');

//productos en stock
Route::get('/productsinstock', 'App\Http\Controllers\ProductController@getProductsInStock')->name('addproduct')->middleware('auth');

//productos por vencimiento
Route::get('/productsexpiration', 'App\Http\Controllers\ProductController@getProductsExpiration')->middleware('auth');

//productos en stock minimo
Route::get('/minstock', 'App\Http\Controllers\ProductController@getMinStock')->middleware('auth');

//buscar producto
Route::get('/searchproduct', 'App\Http\Controllers\ProductController@getSearchProduct')->middleware('auth');
Route::post('/searchproduct', 'App\Http\Controllers\ProductController@postSearchProduct')->middleware('auth');

//editar producto      
Route::get('/product/{id}/edit', 'App\Http\Controllers\ProductController@getProductEdit')->middleware('auth');
Route::post('/product/{id}/edit', 'App\Http\Controllers\ProductController@postProductEdit')->middleware('auth');

//eliminar producto
Route::get('/product/{id}/delete', 'App\Http\Controllers\ProductController@getProductDelete')->middleware('auth');

//MOVIMIENTO DE PRODUCTOS
//ingreso de productos
Route::get('/movsproductsadd', 'App\Http\Controllers\ProductController@getMovsProductsAdd')->middleware('auth');
Route::get('/movsproductsadd/{id}/add', 'App\Http\Controllers\ProductController@getMovsProductsAddAdd')->middleware('auth');
Route::post('/movsproductsadd/{id}/add', 'App\Http\Controllers\ProductController@postMovsProductsAddAdd')->middleware('auth');

//salida de productos
Route::get('/movsproductsrest', 'App\Http\Controllers\ProductController@getMovsProductsRest')->middleware('auth');
Route::get('/movsproductsrest/{id}/rest', 'App\Http\Controllers\ProductController@getMovsProductsRestRest')->middleware('auth');
Route::post('/movsproductsrest/{id}/rest', 'App\Http\Controllers\ProductController@postMovsProductsRestRest')->middleware('auth');


//PRESUPUESTO
//generar presupuesto
Route::get('/budget.newbudget', 'App\Http\Controllers\BudgetProductController@getNewBudget')->middleware('auth');
Route::post('/budget.newbudget', 'App\Http\Controllers\BudgetProductController@postNewBudget')->middleware('auth');

//detalle de los productos del presupuesto
Route::get('/budget/{id}/addnewbudget', 'App\Http\Controllers\BudgetProductController@getAddNewBudget')->middleware('auth');
Route::post('/budget.addnewbudget', 'App\Http\Controllers\BudgetProductController@postAddNewBudget')->middleware('auth');


//añadir producto al presupuesto
Route::get('/budget/{id}/addnewbudgetproduct', 'App\Http\Controllers\BudgetProductController@getAddNewBudgetProduct')->middleware('auth');
Route::post('/budget.addnewbudgetproduct', 'App\Http\Controllers\BudgetProductController@postAddNewBudgetProduct')->middleware('auth');

//eliminar producto del presupuesto
Route::get('/budget/{id}/deletebudgetproduct', 'App\Http\Controllers\BudgetProductController@getDeleteBudgetProduct')->middleware('auth');


//lista de presupuestos
Route::get('/budget.listbudget', 'App\Http\Controllers\BudgetProductController@getListBudget')->middleware('auth');

//detalle de presupuesto
Route::get('/budget/{id}/budgetdetail', 'App\Http\Controllers\BudgetProductController@getBudgetDetail')->middleware('auth');

//generar PDF presupuesto
Route::get('/budget/{id}/getpdf', 'App\Http\Controllers\BudgetProductController@getPdf')->middleware('auth');


//PROVEEDORES
//añadir proveedor
Route::get('/provider/newprovider', 'App\Http\Controllers\ProviderController@getNewProvider')->middleware('auth');
Route::post('/provider/newprovider', 'App\Http\Controllers\ProviderController@postNewProvider')->middleware('auth');

//lista de proveedores
Route::get('/provider/listprovider', 'App\Http\Controllers\ProviderController@getListProvider')->middleware('auth');

//editar proveedores
Route::get('/provider/{id}/editprovider', 'App\Http\Controllers\ProviderController@getEditProvider')->middleware('auth');
Route::post('/provider/{id}/editprovider', 'App\Http\Controllers\ProviderController@postEditProvider')->middleware('auth');

//eliminar proveedor
Route::get('/provider/{id}/deleteprovider', 'App\Http\Controllers\ProviderController@getDeleteProvider')->middleware('auth');


//COMPRA
//nueva compra
Route::get('/buy/newbuy', 'App\Http\Controllers\BuyController@getNewBuy')->middleware('auth');
Route::post('/buy/newbuy', 'App\Http\Controllers\BuyController@postNewBuy')->middleware('auth');

//agregar productos compra
Route::get('/buy/{id}/addnewbuy', 'App\Http\Controllers\BuyController@getAddNewBuy')->middleware('auth');
Route::post('/buy/{id}/addnewbuy', 'App\Http\Controllers\BuyController@postAddNewBuy')->middleware('auth');
// Route::post('/buy/{id}/addnewbuy', 'App\Http\Controllers\BuyController@postAddNewProductBuy')->name('postAddNewProductBuy');

//eliminar producto de la compra
Route::get('/buy/{id}/deletebuyproduct', 'App\Http\Controllers\BuyController@getDeleteBuyProduct')->middleware('auth');

//agregar nuevo producto
Route::post('/buy/addnewproduct', 'App\Http\Controllers\BuyController@postAddNewProduct')->middleware('auth');

// confirmar la compra
Route::post('/buy/addnewbuyconfirm', 'App\Http\Controllers\BuyController@postAddNewBuyConfirm')->middleware('auth');

// cancelar la compra
Route::get('/buy/{id}/cancelnewbuy', 'App\Http\Controllers\BuyController@getCancelNewBuy')->middleware('auth');

// historial de compras
Route::get('/buy/listbuy', 'App\Http\Controllers\BuyController@getListBuy')->middleware('auth');

// detalle de compra
Route::get('/buy/{id}/buydetail', 'App\Http\Controllers\BuyController@getBuyDetail')->middleware('auth');

// generar PDF de compra
Route::get('/buy/{id}/getpdf', 'App\Http\Controllers\BuyController@getPdf')->middleware('auth');

// CLIENTES
// seleccionar cliente
Route::get('/client/selectclient', 'App\Http\Controllers\ClientController@getSelectClient')->middleware('auth');

// nuevo cliente
Route::get('/client/newclient', 'App\Http\Controllers\ClientController@getNewClient')->middleware('auth');
Route::post('/client/newclient', 'App\Http\Controllers\ClientController@postNewClient')->middleware('auth');

// lista de clientes
Route::get('/client/listclient', 'App\Http\Controllers\ClientController@getListClient')->middleware('auth');


// editar cliente
Route::get('/client/{id}/editclient', 'App\Http\Controllers\ClientController@getEditClient')->middleware('auth');
Route::post('/client/{id}/editclient', 'App\Http\Controllers\ClientController@postEditClient')->middleware('auth');


// eliminar cliente
Route::get('/client/{id}/deleteclient', 'App\Http\Controllers\ClientController@getDeleteClient')->middleware('auth');


// nuevo cliente FIRMA
Route::get('/client/newclientfirm', 'App\Http\Controllers\ClientController@getNewClientFirm')->middleware('auth');
Route::post('/client/newclientfirm
', 'App\Http\Controllers\ClientController@postNewClientFirm')->middleware('auth');

// lista de clientes FIRMA
Route::get('/client/listclientfirm', 'App\Http\Controllers\ClientController@getListClientFirm')->middleware('auth');


// editar cliente FIRMA
Route::get('/clientfirm/{id}/editclientfirm', 'App\Http\Controllers\ClientController@getEditClientFirm')->middleware('auth');
Route::post('/clientfirm/{id}/editclientfirm', 'App\Http\Controllers\ClientController@postEditClientFirm')->middleware('auth');

// eliminar cliente FIRMA
Route::get('/clientfirm/{id}/deleteclientfirm', 'App\Http\Controllers\ClientController@getDeleteClientFirm')->middleware('auth');


// 
// VENTAS
// 

// seleccionar venta
Route::get('/sale/selectnewsale', 'App\Http\Controllers\SaleController@getSelectNewSale')->middleware('auth');

// nueva venta - Consumidor final
Route::post('/sale/newsalecf', 'App\Http\Controllers\SaleController@postNewSaleCF')->middleware('auth');



// agregar los productos a la venta
Route::get('/sale/{id}/addsaleproductscf', 'App\Http\Controllers\SaleController@getAddSaleProductsCF')->middleware('auth');

// agregar un nuevo producto a la lista de venta
Route::post('/sale/{id}/addnewsaleproductcf', 'App\Http\Controllers\SaleController@postAddNewSaleProduct')->middleware('auth');

// quitar un producto de la lista de venta
Route::get('/sale/{id}/deletesaleproductcf', 'App\Http\Controllers\SaleController@getDeleteSaleProductCF')->middleware('auth');

// guardar venta - Consumidor final
Route::post('/sale/addnewsaleconfirmcf', 'App\Http\Controllers\SaleController@postAddNewSaleConfirmCF')->middleware('auth');

// cancelar venta - Consumidor final
Route::get('/sale/{id}/cancelnewsalecf', 'App\Http\Controllers\SaleController@getCancelNewSaleCF')->middleware('auth');

// HISTORIAL DE VENTAS - Consumidor final
Route::get('/sale/listsalescf', 'App\Http\Controllers\SaleController@getListSalesCF')->middleware('auth');


// 
// PERSONA
// 

// nueva venta - Persona
Route::get('/sale/newsalep', 'App\Http\Controllers\SaleController@getNewSaleP')->middleware('auth');
Route::post('/sale/newsalep', 'App\Http\Controllers\SaleController@postNewSaleP')->middleware('auth');

// nueva venta - Persona - Añadir nuevo cliente
Route::post('/sale/addnewclientsale', 'App\Http\Controllers\SaleController@postAddNewClientSale')->middleware('auth');

// agregar productos a la venta - Persona
Route::get('/sale/{id}/addsaleproductsp', 'App\Http\Controllers\SaleController@getAddSaleProductsP')->middleware('auth');

// agregar un nuevo producto a la lista de venta - Persona
Route::post('/sale/{id}/addnewsaleproductp', 'App\Http\Controllers\SaleController@postAddNewSaleProductP')->middleware('auth');

// guardar venta - Persona
Route::post('/sale/addnewsaleconfirmp', 'App\Http\Controllers\SaleController@postAddNewSaleConfirmP')->middleware('auth');

// cancelar la venta - Persona
Route::get('/sale/{id}/cancelnewsalep', 'App\Http\Controllers\SaleController@getCancelNewSaleP')->middleware('auth');

// historial de ventas - Persona
Route::get('/sale/listsalesp', 'App\Http\Controllers\SaleController@getListSalesP')->middleware('auth');

// 
// FIRMA COMERCIAL
// 

// nueva venta - Firma comercial
Route::get('/sale/newsalefc', 'App\Http\Controllers\SaleController@getNewSaleFC')->middleware('auth');
Route::post('/sale/newsalefc', 'App\Http\Controllers\SaleController@postNewSaleFC')->middleware('auth');

// nueva venta - Firma comercial - Añadir nuevo cliente
Route::post('/sale/addnewclientfirmsale', 'App\Http\Controllers\SaleController@postAddNewClientFirmSale')->middleware('auth');

// nueva venta - detalle de productos
Route::get('/sale/{id}/addsaleproductsfc', 'App\Http\Controllers\SaleController@getAddSaleProductsFC')->middleware('auth');

// agregar un nuevo producto a la lista de venta - Firma comercial
Route::post('/sale/{id}/addnewsaleproductfc', 'App\Http\Controllers\SaleController@postAddNewSaleProductFC')->middleware('auth');

// guardar venta - Firma comercial
Route::post('/sale/addnewsaleconfirmfc', 'App\Http\Controllers\SaleController@postAddNewSaleConfirmFC')->middleware('auth');

// cancelar la venta - Firma comercial
Route::get('/sale/{id}/cancelnewsalefc', 'App\Http\Controllers\SaleController@getCancelNewSaleFC')->middleware('auth');

// 
// HISTORIAL DE VENTAS
// 

// historial de ventas
Route::get('/sale/listsales', 'App\Http\Controllers\SaleController@getListSales')->middleware('auth');

// filtrar ventas por fecha
Route::post('/sale/filterdate', 'App\Http\Controllers\SaleController@postFilterDateSale')->middleware('auth');

// detalle de ventas
Route::get('/sale/{id}/saledetail', 'App\Http\Controllers\SaleController@getSaleDetail')->middleware('auth');

// generar PDF
Route::get('/sale/{id}/getpdf', 'App\Http\Controllers\SaleController@getpdf')->middleware('auth');


// 
// CUENTA CORRIENTE
// 

// lista de cuenta corriente
Route::get('/currentaccount/listcurrentaccount', 'App\Http\Controllers\CurrentAccountController@getListCurrentAccount')->middleware('auth');

// lista de cuenta corriente - Persona
Route::get('/currentaccount/listcaclient', 'App\Http\Controllers\CurrentAccountController@getListCurrentAccountPerson')->middleware('auth');

// lista de cuenta corriente - Firma comercial
Route::get('/currentaccount/listcafirm', 'App\Http\Controllers\CurrentAccountController@getListCurrentAccountFirm')->middleware('auth');

// detalle de cliente en cuenta corriente
Route::get('/currentaccount/{id}/detailclientca', 'App\Http\Controllers\CurrentAccountController@getDetailClientCA')->middleware('auth');

// detalle de cada compra del cliente en cuenta corriente
Route::get('/currentaccount/{id}/detailsaleclientca', 'App\Http\Controllers\CurrentAccountController@getDetailSaleClientCA')->middleware('auth');

// pagar saldo de cuenta corriente
Route::post('/currentaccount/{id}/paybalance', 'App\Http\Controllers\CurrentAccountController@postPayBalanceCA')->middleware('auth');

// generar PDF - cuenta corriente
Route::get('/currentaccount/{id}/getpdf', 'App\Http\Controllers\CurrentAccountController@getPDF')->middleware('auth');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();
