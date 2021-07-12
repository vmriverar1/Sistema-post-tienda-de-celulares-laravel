<?php

namespace App\Http\Controllers;

use App\Models\Cashbox;
use App\Models\Report;
use App\Models\Setting;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class CashboxController extends Controller
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
        if (count($cajas)==0) {
            $cajaact = "eliminar";
        }else{
            $cajaact = "continua";
        }
        $config = Setting::first();
        if (!detectarPrivacidad("menu","cajas",$config,auth()->user()->role)) {
            return view('/layouts/backend/inicio',compact('stores2','cajaact','config'));
        }
        $cajas = Cashbox::orderBy('estado','ASC')->paginate(10);
        $stores = Store::orderBy('id','ASC')->paginate(10);
        $usuarios = User::get();
        foreach ($cajas as $key => $value) {
            $value["total"] = $value["ingreso"]+$value["saldo"]+$value["egreso"];
            $usuario = User::findOrFail($value["responsable"]);
            $tienda = Store::findOrFail($value["sede"]);
            $value["responsable"] = $usuario["name"];
            $value["sede"] = $tienda["nombre"];
        }
        return view('layouts/backend/cajas',compact('cajas','usuarios','stores','stores2','cajaact','config'));
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

    public function abrir(Request $request)
    {
        $caja = Cashbox::where('sede','like',valorStore())->where('responsable','like',auth()->user()->id)->first();
        if ($request["monto"] == null) {
            $request["monto"] == 0;
        }
        Cashbox::findOrFail($caja->id)->update([
            'saldo' => $request["monto"],
            'estado' => 'ABIERTA'
        ]);
        return "1";
    }

    public function cerrar(Request $request)
    {
        $caja = Cashbox::where('sede','like',valorStore())->where('responsable','like',auth()->user()->id)->first();
        if ($caja->estado == "CERRADA") {
            RETURN "NO";
        }
        $store = valorStore();
        $arr = [];
        $arr["ingreso"] = $caja["ingreso"];
        $arr["egreso"] = $caja["egreso"];
        $arr["saldo"] = $caja["saldo"];
        $arr["id-responsable"] = auth()->user()->id;
        $arr["nombre"] = auth()->user()->name;

        $dato = Report::create([
            'tipo' => "cerrar-caja",
            'store' => $store,
            'datos' => json_encode($arr)
        ]);

        Cashbox::findOrFail($caja->id)->update([
            'ingreso' => 0,
            'egreso' => 0,
            'saldo' => 0,
            'estado' => 'CERRADA'
        ]);

        return "1";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'responsable' => 'required',
            'sede' => 'required',
        ]);

        $cajas = Cashbox::where('sede','like',$request['sede'])->where('responsable','like',auth()->user()->id)->get();

        if (count($cajas) > 0) {
            return "caja repetida";
        }

        $dato = Cashbox::create([
            'responsable' => $request['responsable'],
            'sede' => $request['sede'],
        ]);

        return "1";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cashbox  $cashbox
     * @return \Illuminate\Http\Response
     */
    public function show(Cashbox $cashbox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cashbox  $cashbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Cashbox $cashbox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cashbox  $cashbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'responsable' => 'required',
            'sede' => 'required',
        ]);

        $respuesta = Cashbox::findOrFail($id)->update($request->all());
        return "1";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cashbox  $cashbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cashbox $cashbox)
    {
        //
    }
}
