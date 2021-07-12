<?php

namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Models\Cashbox;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Store;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

        if (!detectarPrivacidad("menu","categorias",$config,auth()->user()->role)) {
            return view('/layouts/backend/inicio',compact('stores2','cajaact','config'));
        }

        $categorias = Category::where('store','like',valorStore())->orderBy('id','ASC')->paginate(10);

        return view('/layouts/backend/categorias',compact('categorias','stores2','cajaact','config'));
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
            $file = Uploader::uploadFile("photo", "categorias","0");
            $file = 'storage/categorias/'.$file;
        }else{
            $file = 'images/default/anonymous.png';
        }

        $request['store'] = valorStore();
        $request['foto'] = $file;

        $dato = Category::create([
            'titular' => "titulo",
            'nombre' => $request['nombre'],
            'estado' => '1',
            'store' => $request['store'],
            'descripcion' => $request['descripcion'],
            'foto' => $file,
        ]);

        return "1";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $file = null;
        if ($request->file("photo")) {
            $file = Uploader::uploadFile("photo", "store","0");
            $file = 'storage/store/'.$file;
        }else{
            $store = Category::findOrFail($id);
            $file = $store->foto;
        }
        $request["foto"] = $file;
        $respuesta = Category::findOrFail($id)->update($request->all());
        return "1";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
