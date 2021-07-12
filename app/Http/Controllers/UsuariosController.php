<?php

namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Models\Cashbox;
use App\Models\Ciudades;
use App\Models\Setting;
use App\Models\Store;
use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{

    public function usuarios()
    {
        if (auth()->user()->role == "ADMIN") {
            $stores2 = Store::orderBy('id','ASC')->get();
            $usuarios = User::orderBy('id','DESC')->paginate(10);
        }else{
            $sedes = json_decode(auth()->user()->stores,true);
            $stores2 = Store::where(function ($query) use ($sedes) {
                for ($i=0; $i < count($sedes); $i++) {
                    $query->orWhere('id', 'like', $sedes[$i]["id"]);
                }
            })
            ->get();
            $usuarios = User::where('store','like',valorStore())->orderBy('id','DESC')->paginate(10);
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
        if (!detectarPrivacidad("menu","usuarios",$config,auth()->user()->role)) {
            return view('/layouts/backend/inicio',compact('stores2','cajaact','config'));
        }
        $tiendas = Store::get();
        for ($i=0; $i < count($usuarios); $i++) {
            $tienda = arrNombre($usuarios[$i]->stores,["tipo"],["store"],[$tiendas]);
            $usuarios[$i]->stores = $tienda;
        }
        return view('/layouts/backend/usuarios/usuarios',compact('usuarios','tiendas','stores2','cajaact','config'));
    }

    // public function clientes()
    // {
    //     $usuarios = User::where('role','like','USUARIO')->orderBy('id','ASC')->paginate(10);
    //     return view('/layouts/backend/usuarios/clientes',compact('usuarios'));
    // }



    function crearusuario(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);

        $file = null;
        if ($request->file("photo")) {
            $file = Uploader::uploadFile("photo", "usuarios","0");
            $file = 'storage/usuarios/'.$file;
        }else{
            $file = 'images/default/anonymous.png';
        }

        $dato = User::create([
            'name' => $request['name'],
            'direccion' => $request['direccion'],
            'celular' => $request['celular'],
            'stores' => $request['stores'],
            'role' => $request['role'],
            'dni' => "3333333",
            'estado' => "0",
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'foto' => $file,
        ]);

        return "1";
    }

    public function editarusuario(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'stores' => 'required',
            'role' => 'required'
        ]);

        $store = User::findOrFail($id);

        $file = null;
        if ($request->file("photo")) {
            $file = Uploader::uploadFile("photo", "store","0");
            $file = 'storage/store/'.$file;
        }else{

            $file = $store->foto;
        }

        if ($request['password']) {
            $pass = bcrypt($request['password']);
        }else{
            $pass = $store->password;
        }

        User::findOrFail($id)-> update([
            'name' => $request['name'],
            'direccion' => $request['direccion'],
            'celular' => $request['celular'],
            'role' => $request['role'],
            'stores' => $request['stores'],
            'dni' => "3333333",
            'email' => $request['email'],
            'password' => $pass,
            'foto' => $file,
        ]);

        return "1";
    }


}
