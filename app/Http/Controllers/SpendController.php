<?php

namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Models\Cashbox;
use App\Models\Product;
use App\Models\Spend;
use Illuminate\Http\Request;

class SpendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function compras(Request $request)
    {
        $pedido = json_decode($request["productos"],true);
        $suma = 0;
        foreach ($pedido as $key => $value) {
            $producto = Product::findOrFail($value["idProd"]);
            $cantant = $producto->stock;
            $costoant = $producto->costo;
            $imei = $producto->imei;
            $cantnueva = $value["cantidad"];
            $costonueva = $value["costo"];
            $suma = $suma + ($value["cantidad"]+$value["costo"]);
            $nuevostock = $value["cantidad"]+$producto->stock;
            $media = ($cantant*$costoant + $cantnueva*$costonueva)/$nuevostock;
            if ($imei == "" || $imei == null || $imei == "[]") {
                $imai = $value["imei"];
            }else{
                $imeiant = json_decode($value["imei"],true);
                $imeinue = json_decode($producto->imei,true);
                foreach ($imeinue as $key => $value2) {
                    array_push($imeiant, $value2);
                }
                $imei = json_encode($imeiant);
            }

            Product::findOrFail($producto->id)->update([
                'stock' => $nuevostock,
                'costo' => $media,
                'imei' => $imei
            ]);
        }
        if ($request["salida"] == "CAJA") {
            $caja = Cashbox::where('sede','like',valorStore())->where('responsable','like',auth()->user()->id)->first();

            if ($caja) {
                $totalcaja = $caja->egreso + $suma;
                if ($caja->estado == "CERRADAS") {
                    RETURN "NO";
                }
                Cashbox::findOrFail($caja->id)->update([
                    'egreso' => $totalcaja
                ]);
            }
        }

        $file = null;
        if ($request->file("photo")) {
            $file = Uploader::uploadFile("photo", "gastos","0");
            $file = 'storage/gastos/'.$file;
        }else{
            $file = 'images/default/anonymous.png';
        }

        $store = valorStore();
        $request["comprobante"] = ($request["comprobante"] == null) ? "Ninguno" : $request["comprobante"];
        $request["cod_comprobante"] = ($request["cod_comprobante"] == null) ? "Ninguno" : $request["cod_comprobante"];
        // $request["igv"] = ($request["igv"] == null) ? "0" : $request["igv"];
        $request["total"] = $suma;
        Spend::create([
            'responsable' => auth()->user()->id,
            'tipo' => "PRODUCTOS",
            'salida' => $request["salida"],
            'comprobante' => $request["comprobante"],
            'cod_comprobante' => $request["cod_comprobante"],
            'productos' => $request["productos"],
            'descripcion' => "Compra de productos",
            'total' => $request["total"],
            'igv' => "0",
            'store' => $store,
            'foto' => $file
        ]);
        return $request;
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

        $request["comprobante"] = "Ninguno";
        $request["cod_comprobante"] = "Ninguno";
        $request["productos"] = "Ninguno";
        $request["igv"] = "0";
        $request["foto"] = 'images/default/anonymous.png';
        $request["responsable"] = auth()->user()->id;
        $request['store'] = valorStore();
        $caja = Cashbox::where('sede','like',valorStore())->where('responsable','like',auth()->user()->id)->first();
        $totalcaja = $caja->egreso + $request['total'];
        if ($caja->estado == "CERRADAS") {
            RETURN "NO";
        }
        if ($request["salida"] == "CAJA") {
            Cashbox::findOrFail($caja->id)->update([
                'egreso' => $totalcaja
            ]);
        }
        $dato = Spend::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function show(Spend $spend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function edit(Spend $spend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spend $spend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spend $spend)
    {
        //
    }
}
