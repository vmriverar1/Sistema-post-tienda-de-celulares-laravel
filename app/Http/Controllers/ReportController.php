<?php

namespace App\Http\Controllers;

use App\Models\Cashbox;
use App\Models\Product;
use App\Models\Report;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Spend;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function general()
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
        if (!detectarPrivacidad("menu","rgenerales",$config,auth()->user()->role)) {
            return view('/layouts/backend/inicio',compact('stores2','cajaact','config'));
        }

        $productosmas = Product::where('store','like',valorStore())->orderBy('ventas','DESC')->paginate(20);
        $productosmenos = Product::where('store','like',valorStore())->orderBy('ventas','ASC')->paginate(20);

        $tiendas = Store::get();
        $totatoal = 0;
        $ingresotoal = 0;
        $egresotoal = 0;
        $saldotoal = 0;
        foreach ($tiendas as $key => $value) {
            $idtienda = $value["id"];
            $cajas = Cashbox::where('sede','like',$idtienda)->where('estado','like','ABIERTA')->get();
            if (count($cajas)>0) {
                $ingreso = 0;
                $egreso = 0;
                $saldo = 0;
                $total = 0;
                foreach ($cajas as $key => $value2) {
                    $ingreso = $ingreso + $value2["ingreso"];
                    $egreso = $egreso + $value2["egreso"];
                    $saldo = $saldo + $value2["saldo"];
                    $total = $total + $ingreso + $saldo - $egreso;
                    $totatoal = $totatoal + $total;
                    $ingresotoal = $ingresotoal + $ingreso;
                    $egresotoal = $egresotoal + $egreso;
                    $saldotoal = $saldotoal + $saldo;
                }
                $value["ingreso"] = $ingreso;
                $value["egreso"] = $egreso;
                $value["saldo"] = $saldo;
                $value["total"] = $total;
            }else{
                $value["ingreso"] = 0;
                $value["egreso"] = 0;
                $value["saldo"] = 0;
                $value["total"] = 0;
            }
        }




        return view('/layouts/backend/reportes/general',compact('stores2','cajaact','config','productosmas','productosmenos','tiendas','totatoal',"ingresotoal","egresotoal","saldotoal"));
    }
    public function cajas()
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
        $fecha = fechaHoy("fecha");
        $store = valorStore();
        $cajasdata = Report::whereDate('created_at', 'like', $fecha)->get();
        for ($i=0; $i < count($cajasdata); $i++) {
            $data = json_decode($cajasdata[$i]->datos,true);
            $cajasdata[$i]->ingreso =  $data["ingreso"];
            $cajasdata[$i]->egreso =  $data["egreso"];
            $cajasdata[$i]->saldo =  $data["saldo"];
            $cajasdata[$i]->total =  $data["ingreso"] + $data["saldo"] - $data["egreso"];
            $cajasdata[$i]->nombre =  $data["nombre"];
            $tienda =  Store::findOrFail($cajasdata[$i]->store);
            $cajasdata[$i]->tienda =  $tienda["nombre"];
        }

        if (count($cajas)==0) {
            $cajaact = "eliminar";
        }else{
            $cajaact = "continua";
        }
        if (!detectarPrivacidad("menu","rventas",$config,auth()->user()->role)) {
            return view('/layouts/backend/inicio',compact('stores2','cajaact','config'));
        }
        return view('/layouts/backend/reportes/cajas',compact('stores2','cajaact','config','cajasdata'));
    }
    public function ventas()
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
        $cajas = Cashbox::where('sede','like',valorStore())->where('responsable','like',auth()->user()->id)->get();
        if (count($cajas)==0) {
            $cajaact = "eliminar";
        }else{
            $cajaact = "continua";
        }
        $config = Setting::first();
        if (!detectarPrivacidad("menu","rventas",$config,auth()->user()->role)) {
            return view('/layouts/backend/inicio',compact('stores2','cajaact','config'));
        }
        $fecha = fechaHoy("fecha");
        $ventas = Sale::where('store','like',valorStore())->whereDate('created_at', 'like', $fecha)->get();
        $gastos = Spend::where('store','like',valorStore())->whereDate('created_at', 'like', $fecha)->get();

        foreach ($ventas as $key => $value) {
            $pedidos = json_decode($value["pedido"],true);
            $pedidohtml = "";
            foreach ($pedidos as $key => $value2) {
                $pedidohtml = $value2["nombre"]."<br>";
            }
            $value["pedido"] = $pedidohtml;
            $usuario = User::findOrFail($value["trabajador"]);
            $value["caja"] = $usuario["name"];
        }

        foreach ($gastos as $key => $value) {
            $usuario = User::findOrFail($value["responsable"]);
            if ($value["tipo"] == "PRODUCTOS") {
                $pedido = json_decode($value["productos"],true);
                $html = "";
                foreach ($pedido as $key => $value2) {
                    $html = $html.$value2["nombre"]."<br>";
                }
                $value["productos"] = $html;
            }
            $value["responsable"] = $usuario["name"];
        }



        return view('/layouts/backend/reportes/ventas',compact('ventas','gastos','stores2','cajaact','config'));
    }
    public function index()
    {
        //
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
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
