<?php

namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Models\Ajax;
use App\Models\Brand;
use App\Models\Cashbox;
use App\Models\Categoria;
use App\Models\Category;
use App\Models\Ciudades;
use App\Models\Client;
use App\Models\Estado;
use App\Models\Product;
use App\Models\Productos;
use App\Models\Report;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Spend;
use App\Models\Store;
use App\Models\Subcategorias;
use App\Models\Subcategory;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activar(Request $request)
    {
        if ($request["estado"] == 0) {
            $request["estado"] = "1";
        }else{
            $request["estado"] = "0";
        }
        // return $request["tabla"] == "categories";
        $tabla = $request["tabla"];

        if ($tabla == "users") {
            if (auth()->user()->id == $request["iddato"]) {
                return;
            }
            User::findOrFail($request["iddato"])->update([
                'estado' => $request["estado"]
            ]);
        }else if ($tabla == "clients") {
            return Client::findOrFail($request["iddato"])->update([
                'estado' => $request["estado"]
            ]);
        }else if ($tabla == "suppliers") {
            return Supplier::findOrFail($request["iddato"])->update([
                'estado' => $request["estado"]
            ]);
        }else if ($tabla == "categories") {
            return Category::findOrFail($request["iddato"])->update([
                'estado' => $request["estado"]
            ]);
        }else if ($tabla == "subcategories") {
            return Subcategory::findOrFail($request["iddato"])->update([
                'estado' => $request["estado"]
            ]);
        }else if ($tabla == "products") {
            return Product::findOrFail($request["iddato"])->update([
                'estado' => $request["estado"]
            ]);
        }else if ($tabla == "brands") {
            return Brand::findOrFail($request["iddato"])->update([
                'estado' => $request["estado"]
            ]);
        }
        return "ss";
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */
    public function show(Ajax $ajax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$tabla)
    {

        if ($tabla == "store") {
            $mark = Store::findOrFail($id);
        }else if ($tabla == "users") {
            $mark = User::findOrFail($id);
        }else if ($tabla == "clients") {
            $mark = Client::findOrFail($id);
        }else if ($tabla == "suppliers") {
            $mark = Supplier::findOrFail($id);
        }else if ($tabla == "categories") {
            $mark = Category::findOrFail($id);
        }else if ($tabla == "products") {
            $mark = Product::findOrFail($id);
        }else if ($tabla == "subcategories") {
            $mark = Subcategory::findOrFail($id);
        }else if ($tabla == "cashboxes") {
            $mark = Cashbox::findOrFail($id);
        }else if ($tabla == "categoria-cobro") {
            return Category::where('estado','like','1')->get();
        }else if ($tabla == "subcategoria-cobro") {
            return Subcategory::where('estado','like','1')->get();
        }else if ($tabla == "marca-cobro") {
            return Brand::get();
        }else if ($tabla == "brands") {
            $mark = Brand::findOrFail($id);
        }else if ($tabla == "productos-cobro") {
            $id = explode(",", $id);
            $busqueda = [];
            //categorias
            if ($id[0] == "0" && $id[1] == "0" && $id[2] == "0" && $id[3] == "0") {
                return [];
            }

            return Product::where(function ($query) use ($id) {
                                $query->where('store','like',valorStore());
                                for ($i=0; $i < count($id); $i++) {
                                    if ($id[0] != "0") {
                                        $query->Where('categoria_id', 'like', '%"id":"'.$id[0].'"%');
                                    }
                                    if ($id[1] != "0") {
                                        $query->Where('subcategoria_id', 'like', '%"id":"'.$id[1].'"%');
                                    }
                                    if ($id[2] != "0") {
                                        $query->Where('brand', 'like', $id[2]);
                                    }
                                    if ($id[3] != "0") {
                                        $query->Where('nombre', 'like', '%'.$id[3].'%');
                                    }
                                }
                            })
                            ->get();
        }else if ($tabla == "productos-caja") {
            $id = explode(",", $id);
            $busqueda = [];
            //categorias
            if ($id[0] == "0" && $id[1] == "0" && $id[2] == "0" && $id[3] == "0") {
                return [];
            }

            $codigoProd = Product::where('cod_prod','like',$id[3])->get();

            if ($codigoProd && count($codigoProd) == 1) {
                return $codigoProd;
            }

            return Product::where(function ($query) use ($id) {
                                $query->where('store','like',valorStore())->where('estado','like','1');
                                for ($i=0; $i < count($id); $i++) {
                                    if ($id[0] != "0") {
                                        $query->Where('categoria_id', 'like', '%"id":"'.$id[0].'"%');
                                    }
                                    if ($id[1] != "0") {
                                        $query->Where('subcategoria_id', 'like', '%"id":"'.$id[1].'"%');
                                    }
                                    if ($id[2] != "0") {
                                        $query->Where('brand', 'like', $id[2]);
                                    }
                                    if ($id[3] != "0") {
                                        $query->Where('nombre', 'like', '%'.$id[3].'%');
                                    }
                                }
                            })
                            ->get();
        }else if ($tabla == "ventas-caja") {
            $id = explode(",", $id);
            if ($id[0] == "0" && $id[1] == "0" && $id[2] == "0" && $id[3] == "0") {
                $fecha = fechaHoy("fecha");
                $ventas =  Sale::whereDate('created_at',$fecha)->get();
                foreach ($ventas as $key => $value) {
                    $usuario = User::findOrFail($value["trabajador"]);
                    $value["trabajador"] = $usuario["name"];
                }
                return $ventas;
            }

            $ventas = Sale::where(function ($query) use ($id) {
                                for ($i=0; $i < count($id); $i++) {
                                    if ($id[0] != "0") {
                                        $dia = substr($id[0], 0, -8);
                                        $mes = substr($id[0], 3, -5);
                                        $año = substr($id[0], 6);
                                        $query->whereDate('created_at', 'like', $año."-".$mes."-".$dia);
                                    }
                                    if ($id[1] != "0") {
                                        $query->Where('caja', 'like', $id[1]);
                                    }
                                    if ($id[2] != "0") {
                                        $query->Where('pedido', 'like', '%'.$id[2].'%');
                                    }
                                    if ($id[3] != "0") {
                                        $query->Where('cliente', 'like', $id[3]);
                                    }
                                }
                            })
                            ->get();
            foreach ($ventas as $key => $value) {
                $usuario = User::findOrFail($value["trabajador"]);
                $value["trabajador"] = $usuario["name"];
            }
            return $ventas;

        }else if($tabla == "caja-chica"){
            return Cashbox::where('sede','like',valorStore())->where('responsable','like',auth()->user()->id)->first();
        }else if ($tabla == "ventas-reportes") {
            $id = explode(",", $id);
            $config = Setting::first();
            $busqueda = [];
            //categorias
            if ($id[0] == "" && $id[1] == "") {
                return [];
            }else if($id[0] != "" && $id[1] == ""){
                $dia = substr($id[0], 0, -8);
                $mes = substr($id[0], 3, -5);
                $año = substr($id[0], 6);
                $fecha = $año."-".$mes."-".$dia;
                $ventasdata = Sale::whereDate('created_at', 'like', $fecha)->get();
            }else if($id[0] == "" && $id[1] != ""){
                $dia = substr($id[1], 0, -8);
                $mes = substr($id[1], 3, -5);
                $año = substr($id[1], 6);
                $fecha = $año."-".$mes."-".$dia;
                $ventasdata = Sale::whereDate('created_at', 'like', $fecha)->get();
            }else{
                $dia = substr($id[0], 0, -8);
                $mes = substr($id[0], 3, -5);
                $año = substr($id[0], 6);
                $fecha = $año."-".$mes."-".$dia;
                $dia = substr($id[1], 0, -8);
                $mes = substr($id[1], 3, -5);
                $año = substr($id[1], 6);
                $fecha2 = $año."-".$mes."-".$dia;
                $ventasdata = Sale::whereBetween('created_at', [$fecha, $fecha2])->get();
            }
            $privacidad = (detectarPrivacidad("eliminar","ventas",$config,auth()->user()->role));
            $store = valorStore();
            for ($i=0; $i < count($ventasdata); $i++) {
                $ventasdata[$i]->fecha =  strftime($ventasdata[$i]->created_at, strtotime( date('Y-m-d')));
                $ventasdata[$i]->boton =  $privacidad;
                $usuario =  User::findOrFail($ventasdata[$i]->trabajador);
                $ventasdata[$i]->nombre =  $usuario["name"];
            }
            return $ventasdata;
        }else if ($tabla == "gastos-reportes") {
            $id = explode(",", $id);
            $config = Setting::first();
            $busqueda = [];
            //categorias
            if ($id[0] == "" && $id[1] == "") {
                return [];
            }else if($id[0] != "" && $id[1] == ""){
                $dia = substr($id[0], 0, -8);
                $mes = substr($id[0], 3, -5);
                $año = substr($id[0], 6);
                $fecha = $año."-".$mes."-".$dia;
                $gastosdata = Spend::whereDate('created_at', 'like', $fecha)->get();
            }else if($id[0] == "" && $id[1] != ""){
                $dia = substr($id[1], 0, -8);
                $mes = substr($id[1], 3, -5);
                $año = substr($id[1], 6);
                $fecha = $año."-".$mes."-".$dia;
                $gastosdata = Spend::whereDate('created_at', 'like', $fecha)->get();
            }else{
                $dia = substr($id[0], 0, -8);
                $mes = substr($id[0], 3, -5);
                $año = substr($id[0], 6);
                $fecha = $año."-".$mes."-".$dia;
                $dia = substr($id[1], 0, -8);
                $mes = substr($id[1], 3, -5);
                $año = substr($id[1], 6);
                $fecha2 = $año."-".$mes."-".$dia;
                $gastosdata = Spend::whereBetween('created_at', [$fecha, $fecha2])->get();
            }
            $privacidad = (detectarPrivacidad("eliminar","gastos",$config,auth()->user()->role));
            $store = valorStore();
            for ($i=0; $i < count($gastosdata); $i++) {
                $gastosdata[$i]->fecha =  strftime($gastosdata[$i]->created_at, strtotime( date('Y-m-d')));
                $gastosdata[$i]->boton =  $privacidad;
                $usuario =  User::findOrFail($gastosdata[$i]->responsable);
                $gastosdata[$i]->nombre =  $usuario["name"];
                $gastosdata[$i]->fecha =  strftime($gastosdata[$i]->created_at, strtotime( date('Y-m-d')));
                if ($gastosdata[$i]->tipo == "PRODUCTOS") {
                    $pedido = json_decode($gastosdata[$i]->productos,true);
                    $html = "";
                    foreach ($pedido as $key => $value) {
                        $html = $html.$value["nombre"]."<br>";
                    }
                    $gastosdata[$i]->productos = $html;
                }
            }
            return $gastosdata;
        }else if ($tabla == "cajas-chicas-reportes") {
            $id = explode(",", $id);
            $config = Setting::first();
            $busqueda = [];
            //categorias
            if ($id[0] == "" && $id[1] == "") {
                return [];
            }else if($id[0] != "" && $id[1] == ""){
                $dia = substr($id[0], 0, -8);
                $mes = substr($id[0], 3, -5);
                $año = substr($id[0], 6);
                $fecha = $año."-".$mes."-".$dia;
                $cajasdata = Report::whereDate('created_at', 'like', $fecha)->get();
            }else if($id[0] == "" && $id[1] != ""){
                $dia = substr($id[1], 0, -8);
                $mes = substr($id[1], 3, -5);
                $año = substr($id[1], 6);
                $fecha = $año."-".$mes."-".$dia;
                $cajasdata = Report::whereDate('created_at', 'like', $fecha)->get();
            }else{
                $dia = substr($id[0], 0, -8);
                $mes = substr($id[0], 3, -5);
                $año = substr($id[0], 6);
                $fecha = $año."-".$mes."-".$dia;
                $dia = substr($id[1], 0, -8);
                $mes = substr($id[1], 3, -5);
                $año = substr($id[1], 6);
                $fecha2 = $año."-".$mes."-".$dia;
                $cajasdata = Report::whereBetween('created_at', [$fecha, $fecha2])->get();
            }
            $privacidad = (detectarPrivacidad("eliminar","cajas",$config,auth()->user()->role));
            $store = valorStore();
            for ($i=0; $i < count($cajasdata); $i++) {
                $data = json_decode($cajasdata[$i]->datos,true);
                $cajasdata[$i]->ingreso =  $data["ingreso"];
                $cajasdata[$i]->egreso =  $data["egreso"];
                $cajasdata[$i]->saldo =  $data["saldo"];
                $cajasdata[$i]->total =  $data["ingreso"] + $data["saldo"] - $data["egreso"];
                $cajasdata[$i]->nombre =  $data["nombre"];
                $cajasdata[$i]->fecha =  strftime($cajasdata[$i]->created_at, strtotime( date('Y-m-d')));
                $cajasdata[$i]->boton =  $privacidad;
                $tienda =  Store::findOrFail($cajasdata[$i]->store);
                $cajasdata[$i]->tienda =  $tienda["nombre"];
            }
            return $cajasdata;
        }

        return response()->json($mark);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajax $ajax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */


    public function destroy($id,$tabla)
    {

        if ($tabla == "store") {
            return Store::destroy($id);
        }else if ($tabla == "users") {
            if (auth()->user()->id == $id) {
                return;
            }
            return User::destroy($id);
        }else if ($tabla == "clients") {
            return Client::destroy($id);
        }else if ($tabla == "suppliers") {
            return Supplier::destroy($id);
        }else if ($tabla == "products") {
            return Product::destroy($id);
        }else if ($tabla == "categories") {
            return Category::destroy($id);
        }else if ($tabla == "subcategories") {
            return Subcategory::destroy($id);
        }else if ($tabla == "brands") {
            return Brand::destroy($id);
        }else if ($tabla == "cashboxes") {
            return Cashbox::destroy($id);
        }
    }

    public function crearFoto($request,$tabla)
    {
        // $file = null;
        // if ($request->file("photo")) {
        //     if ($tabla == "categorias") {
        //         $file = Uploader::uploadFile("photo", "categorias");
        //         $carpeta = "categorias"
        //     }
        //     $file = 'storage/'.$carpeta.'/'.$file;
        // }else{
        //     $file = 'images/default/anonymous.png';
        // }
    }


}
