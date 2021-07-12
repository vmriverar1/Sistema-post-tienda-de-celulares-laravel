<?php

namespace App\Http\Controllers;

use App\Models\Cashbox;
use App\Models\Setting;
use App\Models\Store;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == "ADMIN") {
            $stores2 = Store::orderBy('id','ASC')->get();
        }else{
            $sedes = json_decode(auth()->user()->stores,true);
            $stores2 = Store::where(function ($query) use ($sedes) {
                for ($i=0; $i < count($sedes); $i++) {
                    $query->orWhere('id', 'like', $sedes[$i]["id"]);
                }
            })
            ->get();
        }
        if (!determinarStore()) {
            return view('/layouts/backend/select-store',compact('stores2'));
        }
        $config = Setting::first();
        $cajas = Cashbox::where('sede','like',valorStore())->where('responsable','like',auth()->user()->id)->get();
        if (count($cajas)==0) {
            $cajaact = "eliminar";
        }else{
            $cajaact = "continua";
        }
        if (auth()->user()->role != "ADMIN") {
            return view('/layouts/backend/inicio',compact('stores2','cajaact','config'));
        }

        // $ventas = Sale::where('store','like',valorStore())->get();
        // $gastos = Spend::where('store','like',valorStore())->get();


        $tipos1 = ["categorias","subcategorias","marcas","cajas","compraprod","productos","usuarios","clientes","proveedores","sedes","rgenerales","rventas","rcajas"];
        $titulosmenu = ["Categorias","Subcategorias","Marcas","Cajas","Compra de productos","Productos","Usuarios","Clientes","Proveedores","Sedes","Reportes generales","Reporte de ventas","Reporte de caja"];
        $usuariosbd = ["USUARIO","CAJA","ENCARGADO"];
        $usuarios = ["Empleado","Caja","Sub-administrador"];
        //parte 2
        $tipos2 = ["categorias","subcategorias","marcas","cajas","productos","usuarios","clientes","proveedores","sedes","caja","ventas","gastos"];
        $titulosmenu2 = ["Crear Categorias","Crear Subcategorias","Crear Marcas","Crear Cajas","Crear Productos","Crear Usuarios","Crear Clientes","Crear Proveedores","Crear Sedes","Cerrar caja","Crear Ventas","Crear Gastos"];
        // parte 3
        $titulosmenu3 = ["Categorias","Subcategorias","Marcas","Cajas","Productos","Usuarios","Clientes","Proveedores","Sedes","Caja chica","Ventas","Gastos"];
        // $areas =


        return view('/layouts/backend/configuraciones',compact('tipos1','usuarios','usuariosbd','titulosmenu','titulosmenu2','titulosmenu3','tipos2','stores2','cajaact','config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $respuesta = Setting::findOrFail(1)->update($request->all());
        return "1";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
