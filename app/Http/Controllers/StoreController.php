<?php

namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Models\Cashbox;
use App\Models\Setting;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
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
        if (!detectarPrivacidad("menu","sedes",$config,auth()->user()->role)) {
            return view('/layouts/backend/inicio',compact('stores2','cajaact','config'));
        }
        $cajas = Cashbox::where('sede','like',valorStore())->where('responsable','like',auth()->user()->id)->get();
        if (count($cajas)==0) {
            $cajaact = "eliminar";
        }else{
            $cajaact = "continua";
        }
        $stores = Store::orderBy('id','ASC')->paginate(10);
        $usuarios = User::get();
        foreach ($stores as $key => $value) {
            $usuario = User::findOrFail($value["administrador"]);
            $value["administrador"] = $usuario["name"];
        }
        return view('/layouts/backend/sede',compact('stores','usuarios','stores2','cajaact','config'));
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
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'ruc' => 'required',
            'administrador' => 'required',
            'celular' => 'required'
        ]);



        $file = null;
        if ($request->file("photo")) {
            $file = Uploader::uploadFile("photo", "store","0");
            $file = 'storage/store/'.$file;
        }else{
            $file = 'images/default/anonymous.png';
        }



        $dato = Store::create([
            'nombre' => $request['nombre'],
            'direccion' => $request['direccion'],
            'ruc' => $request['ruc'],
            'administrador' => $request['administrador'],
            'celular' => $request['celular'],
            'foto' => $file,
        ]);

        return "1";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function cambiar(Request $request)
    {
        Session::put('store', $request->sede);
        return "1";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'ruc' => 'required',
            'administrador' => 'required',
            'celular' => 'required'
        ]);

        $file = null;
        if ($request->file("photo")) {
            $file = Uploader::uploadFile("photo", "store","0");
            $file = 'storage/store/'.$file;
        }else{
            $store = Store::findOrFail($id);
            $file = $store->foto;
        }

        Store::findOrFail($id)-> update([
            'nombre' => $request['nombre'],
            'direccion' => $request['direccion'],
            'ruc' => $request['ruc'],
            'administrador' => $request['administrador'],
            'celular' => $request['celular'],
            'foto' => $file,
        ]);

        return "1";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
