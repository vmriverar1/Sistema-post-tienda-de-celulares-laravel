<?php

use App\Http\Middleware\Stores;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//AJAX
// AJAX
Route::get('/ajax/traer/{id}/{tabla}', 'AjaxController@edit');
Route::get('/ajax/destroy/{id}/{tabla}', 'AjaxController@destroy')->name('ajaxs.destroy');
Route::post('/ajax/activar', 'AjaxController@activar')->name('ajaxs.activar');
//BACKEND
Route::get('/', 'HomeController@index')->name('welcome')->middleware('auth')->middleware(Stores::class);
//SEDES
Route::post('/sede/determinar', 'HomeController@determinarStore')->name('detect-sede')->middleware('auth');
Route::get('/sede', 'StoreController@index')->name('sede')->middleware('auth');
Route::post('crear/store/store', 'StoreController@store')->name('store.store')->middleware('auth');
Route::post('/store/update/{id}', 'StoreController@update')->name('store.update')->middleware('auth');
Route::post('/cambiar-sede', 'StoreController@cambiar')->name('cambiarsede')->middleware('auth');
//USUARIOS
Route::get('/usuarios', 'UsuariosController@usuarios')->name('usuarios')->middleware('auth');
Route::post('crear/usuarios/store', 'UsuariosController@crearusuario')->name('users.store')->middleware('auth');
Route::post('/users/update/{id}', 'UsuariosController@editarusuario')->name('users.update')->middleware('auth');
//CLIENTES
Route::get('/clientes', 'ClientController@index')->name('clientes')->middleware('auth');
Route::post('crear/clientes/store', 'ClientController@store')->name('clients.store')->middleware('auth');
Route::post('/clients/update/{id}', 'ClientController@update')->name('clients.update')->middleware('auth');
//´PROVEEDORES
Route::get('/proveedores', 'SupplierController@index')->name('proveedor')->middleware('auth');
Route::post('crear/suppliers/store', 'SupplierController@store')->name('suppliers.store')->middleware('auth');
Route::post('/suppliers/update/{id}', 'SupplierController@update')->name('suppliers.update')->middleware('auth');
//CATEGORIAS
Route::get('/categorias', 'CategoryController@index')->name('categorias')->middleware('auth');
Route::post('crear/categories/store', 'CategoryController@store')->name('categories.store')->middleware('auth');
Route::post('/categories/update/{id}', 'CategoryController@update')->name('categories.update')->middleware('auth');
//SUBCATEGORIAS
Route::get('/subcategorias', 'SubcategoryController@index')->name('subcategorias')->middleware('auth');
Route::post('crear/subcategories/store', 'SubcategoryController@store')->name('subcategories.store')->middleware('auth');
Route::post('/subcategories/update/{id}', 'SubcategoryController@update')->name('subcategories.update')->middleware('auth');
//MARCAS
Route::get('/marcas', 'BrandController@index')->name('marcas')->middleware('auth');
Route::post('crear/brands/store', 'BrandController@store')->name('brands.store')->middleware('auth');
Route::post('/brands/update/{id}', 'BrandController@update')->name('brands.update')->middleware('auth');
//PRODUCTOS
Route::get('/productos', 'ProductController@index')->name('productos')->middleware('auth');
Route::post('crear/productos/store', 'ProductController@store')->name('products.store')->middleware('auth');
Route::post('/products/update/{id}', 'ProductController@update')->name('products.update')->middleware('auth');
//CAJAS
Route::get('/cajas', 'CashboxController@index')->name('cajas')->middleware('auth');
Route::post('crear/cajas/store', 'CashboxController@store')->name('cashboxes.store')->middleware('auth');
Route::post('/cashboxes/update/{id}', 'CashboxController@update')->name('cashboxes.update')->middleware('auth');
Route::post('/abrircaja', 'CashboxController@abrir')->name('cashboxes.abrir')->middleware('auth');
Route::post('/cerrarcaja', 'CashboxController@cerrar')->name('cashboxes.cerrar')->middleware('auth');
//VENTAS
Route::get('/ventas', 'SaleController@index')->name('ventas')->middleware('auth');
Route::post('crear/ventas/store', 'SaleController@store')->name('sales.store')->middleware('auth');
Route::post('/dni/cliente', 'ClientController@buscardni')->name('dni.cliente')->middleware('auth');
//GASTOS
// Route::post('/gastos', 'SpendController@index')->name('gastos')->middleware('auth');
Route::post('crear/gastos/store', 'SpendController@store')->name('spends.store')->middleware('auth');
Route::post('crear/compras', 'SpendController@compras')->name('spends.compras')->middleware('auth');
//REPORTES
Route::get('/reporte-generales', 'ReportController@general')->name('reporte-general')->middleware('auth');
Route::get('/reporte-cajas', 'ReportController@cajas')->name('reporte-cajas')->middleware('auth');
Route::get('/reporte-ventas', 'ReportController@ventas')->name('reporte-ventas')->middleware('auth');
// CONFIGURACIONES
Route::get('/configuraciones', 'SettingController@index')->name('configuraciones')->middleware('auth');
Route::post('/configuraciones/update/1', 'SettingController@update')->name('settings.update')->middleware('auth');

// dropzone
Route::post('dropzone/upload', 'DropzoneController@upload')->name('dropzone.upload');
Route::get('dropzone/fetch', 'DropzoneController@fetch')->name('dropzone.fetch');
Route::get('dropzone/delete', 'DropzoneController@delete')->name('dropzone.delete');