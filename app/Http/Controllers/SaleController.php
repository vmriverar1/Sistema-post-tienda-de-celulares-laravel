<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cashbox;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Store;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;

class SaleController extends Controller
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

        $cajas = Cashbox::where('sede','like',valorStore())->where('responsable','like',auth()->user()->id)->get();
        $config = Setting::first();
        if (count($cajas)==0) {
            $cajaact = "eliminar";
             return view('layouts/backend/caja-error',compact('stores2','cajaact','config'));
        }else{
            $cajaact = "continua";
            if ($cajas[0]->estado == "CERRADA") {
                return view('layouts/backend/caja-cerrada',compact('stores2','cajaact','config'));
            }
        }
        $cats = Category::where('store','like',valorStore())->where('estado','like','1')->get();
        $subs = Subcategory::where('store','like',valorStore())->where('estado','like','1')->get();
        $brands = Brand::get();
        $cajas = Cashbox::where('sede','like',valorStore())->get();
        foreach ($cajas as $key => $value) {
            $usuarios = User::findOrFail($value["responsable"]);
            $value["cajero"] = $usuarios->name;
        }
        return view('layouts/backend/ventas',compact('cats','subs','brands','stores2','cajas','cajaact','config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $caja = Cashbox::where('sede','like',valorStore())->where('responsable','like',auth()->user()->id)->first();
        if ($caja->estado == "CERRADA") {
            RETURN "NO";
        }
        $request["nota"] = ($request["nota"] == null) ? "Sin nota" : $request["nota"];
        $request["tipo"] = ($request["tipo"] == null) ? "TIENDA" : $request["tipo"];
        $request["cliente"] = ($request["cliente"] == null) ? "Anonimo" : $request["cliente"];
        $request["descuento"] = ($request["descuento"] == null) ? "0" : $request["descuento"];
        $request["igv"] = ($request["igv"] == null) ? "0" : $request["igv"];
        $request["tipo_descuento"] = ($request["descuento"] > 0) ? "NORMAL" : "NINGUNO";
        $request["vuelto"] = ($request["vuelto"] < 0) ? "0" : $request["vuelto"];
        $request["trabajador"] = auth()->user()->id;
        $request["caja"] = $caja->id;
        $request['store'] = valorStore();
        $pedido = json_decode($request["pedido"],true);
        foreach ($pedido as $key => $value) {
            $producto = Product::findOrFail($value["idProd"]);
            $stock = $producto->stock - $value["cantidad"];
            if ($stock<0) {
                return "error";
            }
            $ventas = $producto->ventas + $value["cantidad"];
            $imeis = json_decode($producto->imei,true);
            if ($value["imei"] != "vacio") {
                $arr = [];
                for ($i=0; $i < count($imeis); $i++) {
                    $imaidata = $imeis[$i];
                    if ($value["imei"] != $imaidata) {
                        array_push($arr, $imaidata);
                    }
                }
                $imei = json_encode($arr);
            }else{
                $imei = $producto->imei;
            }
            Product::findOrFail($producto->id)->update([
                'stock' => $stock,
                'ventas' => $ventas,
                'imei' => $imei
            ]);
        }
        $totalcaja = $caja->ingreso + $request['total'];

        Cashbox::findOrFail($caja->id)->update([
            'ingreso' => $totalcaja
        ]);
        $dato = Sale::create($request->all());
        return "1";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
