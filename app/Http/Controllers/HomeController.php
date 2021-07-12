<?php

namespace App\Http\Controllers;

use App\Models\Cashbox;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Spend;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
        }else{
            $cajaact = "continua";
        }

        $ingresos = Sale::get()->sum('total');
        $egresos = Spend::get()->sum('total');

        $totalventas = Sale::get()->count();

        $montoc = Cashbox::get()->sum('saldo');
        $ingresosc = Cashbox::get()->sum('ingreso');
        $egresosc = Cashbox::get()->sum('egreso');
        $cajachica =  $montoc + $ingresosc - $egresosc;

        return view('/layouts/backend/inicio',compact('stores2','cajaact','config','ingresos','egresos','cajachica','totalventas'));

    }

    public function determinarStore(Request $request)
    {
        Session::put('store', $request->store);
        return "1";
    }
}
