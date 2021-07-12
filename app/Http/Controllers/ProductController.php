<?php

namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Models\Brand;
use App\Models\Cashbox;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Store;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        if (!detectarPrivacidad("menu","productos",$config,auth()->user()->role)) {
            return view('/layouts/backend/inicio',compact('stores2','cajaact','config'));
        }
        $productos = Product::where('store','like',valorStore())->orderBy('id','ASC')->paginate(10);
        $cats = Category::where('store','like',valorStore())->orderBy('id','ASC')->select(['id', 'nombre'])->get();
        $subs = Subcategory::where('store','like',valorStore())->orderBy('id','ASC')->select(['id', 'nombre'])->get();
        $marcas = Brand::get();

        for ($i=0; $i < count($productos); $i++) {
            $catarr = json_decode($productos[$i]["categoria_id"],true);
            $subarr = json_decode($productos[$i]["subcategoria_id"],true);
            // CATEGORIA
            $catfn = [];
            if (vacioNulo($productos[$i]["categoria_id"])) {
                $catfn = $cats;
            }else{
                for ($f=0; $f < count($catarr); $f++) {
                    $dat = $cats->find($catarr[$f]["id"]);
                    if (!vacioNulo($dat)) {
                        array_push($catfn, $dat);
                    }
                }
            }

            // SUBCATEGORIA
            $subfn = [];
            if (vacioNulo($productos[$i]["subcategoria_id"])) {
                $subfn = $subs;
            }else{
                for ($f=0; $f < count($subarr); $f++) {
                    $dat = $subs->find($subarr[$f]["id"]);
                    if (!vacioNulo($dat)) {
                        array_push($subfn, $dat);
                    }
                }
            }

            $productos[$i]["categoria_id"] = $catfn;
            $productos[$i]["subcategoria_id"] = $subfn;

        }
        return view('/layouts/backend/productos',compact('productos','cats','subs','marcas','stores2','cajaact','config'));

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
            'descripcion' => 'required',
            'categoria_id' => 'required',
            'subcategoria_id' => 'required',
            'precio' => 'required',
            'costo' => 'required',
            'tipo' => 'required',
        ]);

        $limite = $request["multi"];
        if ($limite != null || $limite != 0) {
            $codigo = $request["uui"];
            $arr = [];
            for ($i=0; $i < $limite; $i++) {
                $nfile = "file".$i;
                $file = Uploader::uploadFile($nfile, "multimedia/".$codigo,$i);
                $file = "storage/multimedia/".$codigo."/".$file;
                array_push($arr, $file);
            }

            $multimedia = json_encode($arr);
        }else{
            $multimedia = ['images/default/anonymous.png'];
            $multimedia = json_encode($multimedia);
        }

        if ($request->file("photo")) {
            $imagen = Uploader::uploadFile("photo", "productos","0");
            $imagen = 'storage/productos/'.$imagen;
        }else{
            $imagen = 'images/default/anonymous.png';
        }

        $request['estado'] = "1";
        $request['multimedia'] = $multimedia;
        $request['foto'] = $imagen;
        $request['store'] = valorStore();
        $request['cod_prod'] = ($request['cod_prod'] == null || $request['cod_prod'] == "") ? "ninguno" : $request['cod_prod'];

        $dato = Product::create($request->all());

        return "1";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria_id' => 'required',
            'subcategoria_id' => 'required',
            'precio' => 'required',
            'costo' => 'required',
            'tipo' => 'required',
        ]);
        //traemos datos
        $producto = Product::findOrFail($id);
        //procesamos
        $multimedia = $request["antiguasMultimedia"];
        $limite = $request["multi"];
        if ($limite != null || $limite != 0) {
            $codigo = $request["uui"];
            $arr = json_decode($request["antiguasMultimedia"],true);
            for ($i=0; $i < $limite; $i++) {
                $nfile = "file".$i;
                $file = Uploader::uploadFile($nfile, "multimedia/".$codigo,$i);
                $file = "storage/multimedia/".$codigo."/".$file;
                array_push($arr, $file);
            }

            $multimedia = json_encode($arr);
        }else{
            $multimedia = ['images/default/anonymous.png'];
            $multimedia = json_encode($multimedia);
        }

        if ($request->file("photo")) {
            $file = Uploader::uploadFile("photo", "productos","0");
            $file = 'storage/productos/'.$file;
        }else{
            $file = $producto->foto;
        }
        $request['estado'] = $producto->estado;
        $request['multimedia'] = $multimedia;
        $request['foto'] = $file;
        $request['store'] = valorStore();
        $request['cod_prod'] = ($request['cod_prod'] == null || $request['cod_prod'] == "") ? "ninguno" : $request['cod_prod'];
        $respuesta = Product::findOrFail($id)->update($request->all());
        return "1";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
