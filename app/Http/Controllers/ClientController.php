<?php

namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Models\Cashbox;
use App\Models\Client;
use App\Models\Setting;
use App\Models\Store;
use Illuminate\Http\Request;

class ClientController extends Controller
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
        if (!detectarPrivacidad("menu","clientes",$config,auth()->user()->role)) {
            return view('/layouts/backend/inicio',compact('stores2','cajaact','config'));
        }
        $clientes = Client::where('store','like',valorStore())->orderBy('id','ASC')->paginate(10);
        return view('/layouts/backend/usuarios/clientes',compact('clientes','stores2','cajaact','config'));
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
        ]);

        $file = null;
        if ($request->file("photo")) {
            $file = Uploader::uploadFile("photo", "clientes","0");
            $file = 'storage/clientes/'.$file;
        }else{
            $file = 'images/default/anonymous.png';
        }

        $request['store'] = valorStore();
        $request['foto'] = $file;

        $dato = Client::create($request->all());

        return "1";

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

     public function buscardni(Request $request)
    {
        $cliente = Client::where("dni","like",$request["dni"])->first();
        if ($cliente) {
            return $cliente;
        }else{
            return [];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $file = null;
        if ($request->file("photo")) {
            $file = Uploader::uploadFile("photo", "clientes","0");
            $file = 'storage/clientes/'.$file;
        }else{
            $client = Client::findOrFail($id);
            $file = $client->foto;
        }

        Client::findOrFail($id)-> update([
            'nombre' => $request['nombre'],
            'email' => $request['email'],
            'dni' => $request['dni'],
            'direccion' => $request['direccion'],
            'celular' => $request['celular'],
            'foto' => $file,
        ]);

        return "1";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
