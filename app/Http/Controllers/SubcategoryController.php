<?php

namespace App\Http\Controllers;

use App\Models\Cashbox;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Store;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
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
        if (!detectarPrivacidad("menu","subcategorias",$config,auth()->user()->role)) {
            return view('/layouts/backend/inicio',compact('stores2','cajaact','config'));
        }
        $subcategorias = Subcategory::where('store','like',valorStore())->orderBy('id','ASC')->paginate(10);
        $cats = Category::where('store','like',valorStore())->orderBy('id','ASC')->select(['id', 'nombre'])->get();
        $subs = Subcategory::where('store','like',valorStore())->orderBy('id','ASC')->select(['id', 'nombre'])->get();
        for ($i=0; $i < count($subcategorias); $i++) {
            $categorias = arrNombre($subcategorias[$i]->categoria_id,["tipo"],["c"],[$cats]);
            $subcategorias[$i]->categoria_id = $categorias;
        }
        return view('/layouts/backend/subcategorias',compact('subcategorias','subs','cats','stores2','cajaact','config'));
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
            'nombre' => 'required'
        ]);

        $request['store'] = valorStore();

        $dato = Subcategory::create($request->all());

        return "1";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $respuesta = Subcategory::findOrFail($id)->update($request->all());
        return "1";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        //
    }
}
