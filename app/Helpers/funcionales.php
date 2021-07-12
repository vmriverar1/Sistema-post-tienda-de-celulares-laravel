<?php

function modalEntrada($tipo,$columna,$item,$label,$data,$col,$arrclases, $condiciones)
{
	//determinamos si sera invisible
	$hidden = (is_array($condiciones) && $condiciones["respuesta"] !== "buscar") ? "display:none" : "";
	$señal = (is_array($condiciones)) ? $condiciones["condicion"] : "";
	$busqueda = (is_array($condiciones)) ? $condiciones["respuesta"] : "";
	//determinamos su tamaño
	$col = ($col == null) ? "col-lg-8" : $col;
	$col = colEspacios($col);
	$clases = "";
	if ($arrclases ==! null) {
		for ($i=0; $i < count($arrclases); $i++) {
			$clases = $clases." ".$arrclases[$i];
		}
	}
	if ($tipo == "inputtext") {
		$placeholder = ($data == null) ? "" : $data;
		return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">
                        <input type="text" condicion="'.$señal.'" busqueda="'.$señal.'" columna="'.$columna.'" name="'.$columna.'" class="form-control '.$clases.' limpiar'.$item.' '.$item.'" autocomplete="nope" placeholder="'.$placeholder.'" value="">
                    </div>
                </div>';
    }else if ($tipo == "inputprecio") {
        $placeholder = ($data == null) ? "" : $data;
        return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">
                        <input type="number" columna="'.$columna.'" name="'.$columna.'" class="form-control '.$clases.' limpiar'.$item.' '.$item.'" autocomplete="nope" placeholder="'.$placeholder.'" value="" onkeypress="return filterFloat(event,this);">
                    </div>
                </div>';
    }else if ($tipo == "inputnumber") {
		$placeholder = ($data == null) ? "" : $data;
		return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">
                        <input type="number" columna="'.$columna.'" name="'.$columna.'" class="form-control '.$clases.' limpiar'.$item.' '.$item.'" autocomplete="nope" placeholder="'.$placeholder.'" value="" onkeypress="return filterFloat2(event,this);">
                    </div>
                </div>';
	}else if ($tipo == "email") {
        $placeholder = ($data == null) ? "" : $data;
        return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">
                        <input type="email" columna="'.$columna.'" name="'.$columna.'" class="form-control '.$clases.' limpiar'.$item.' '.$item.'" autocomplete="nope" placeholder="'.$placeholder.'" value="">
                    </div>
                </div>';
    }else if ($tipo == "pass") {
        $placeholder = ($data == null) ? "" : $data;
        return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">
                        <input type="password" columna="'.$columna.'" name="'.$columna.'" class="form-control '.$clases.' limpiar'.$item.' '.$item.'" autocomplete="nope" placeholder="'.$placeholder.'" value="">
                    </div>
                </div>';
    }else if ($tipo == "radio") {
        $placeholder = ($data == null) ? "" : $data;
        $radio = '<div class="input-group">
                        <input type="number" tipo="distancia" class="form-control radioGoogle limpiar'.$item.' '.$item.'" autocomplete="nope" placeholder="Escribe la el radio de de envio" id="radioGoogle">
                        <span class="input-group-btn">
                            <button class="btn white b-a no-shadow" type="button">Km</button>
                        </span>
                    </div>';
        $tarifa = '<div class="input-group">
                        <input type="number" tipo="precio" class="form-control radioTarifa limpiar'.$item.' '.$item.'" autocomplete="nope" placeholder="Escribe la tarifa de envio">
                        <span class="input-group-btn">
                            <button class="btn white b-a no-shadow" type="button">MXN</button>
                        </span>
                    </div>';
        return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">
                        <div class="btnsTarifasModal" style="padding-bottom: 20px;"></div>
                        <input type="hidden" columna="'.$columna.'" name="'.$columna.'" class="form-control tarifaRadio limpiar'.$item.' '.$item.'"><div style="display:grid; grid-template-columns: 50% 50%;">'.$radio.$tarifa.'</div><span class="input-group-btn">
                            <a class="btn danger b-a no-shadow agregarTarifa btn-block" style="color:white;margin-top: 10px;">Agregar</a>
                        </span>
                    </div>
                </div>';
	}else if ($tipo == "selectArr") {
		$opciones = "";
		$opc1 = $data[0];
		for ($i=0; $i < count($opc1); $i++) {
			$o = $opc1[$i];
			$opciones = $opciones."<option value='".$o[0]."'>".$o[1]."</option>";
		}
		if (count($data) > 1) {
			$opc2 = $data[1];
			foreach ($opc2 as $key => $value) {
                if ($value["nombre"]) {
                    $opciones = $opciones."<option value='".$value["id"]."'>".$value["nombre"]."</option>";
                }else{
    				$opciones = $opciones."<option value='".$value["id"]."'>".$value["name"]."</option>";
                }
			}
		}
		return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">
                        <select columna="'.$columna.'" name="'.$columna.'" class="form-control '.$clases.' limpiar'.$item.' '.$item.'" autocomplete="nope" value="">
                            <option value="ninguno">Selecciona una opción</option>'.$opciones.'</select>
                    </div>
                </div>';
	}else if ($tipo == "inputpass") {
		$placeholder = ($data == null) ? "" : $data;
		return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">
                        <input type="password"columna="'.$columna.'" name="'.$columna.'" class="form-control '.$clases.' limpiar'.$item.' '.$item.'" autocomplete="nope" placeholder="'.$placeholder.'" value="">
                    </div>
                </div>';
	}else if ($tipo == "textarea") {
		$placeholder = ($data == null) ? "" : $data;
		return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">
                        <textarea rows="3" condicion="'.$señal.'" busqueda="'.$señal.'" columna="'.$columna.'" name="'.$columna.'" class="form-control '.$clases.' limpiar'.$item.' '.$item.'" autocomplete="nope" placeholder="'.$placeholder.'"></textarea>
                    </div>
                </div>';
	}else if ($tipo == "boton") {
		return '<div class="form-group row">
                    <div class="col-lg-12 ">
                        <button class="btn primary btn-lg p-x-md btn-block" id="guardar'.$item.'">Guardar</button>
                    </div>
                </div>';
	}else if ($tipo == "imagen") {
		return '<div class="form-group" style="padding:20px">
	                <div class="panel">SUBIR FOTO</div>
	                <input type="file" class="nuevaFoto limpiar'.$item.' '.$item.'" columna="'.$columna.'" name="photo" accept="Image/*">
	                <p class="help-block">Peso máximo de la foto 2MB</p>
	                <img src="images/default/anonymous.png" class="img-thumbnail previsualizarfn" width="100px">
                </div>';
    }else if ($tipo == "multimedia") {
        return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">
                        <input type="hidden" name="antiguasMultimedia" class="antiguasMultimedia limpiar'.$item.'" value="">
                        <div class="editarMultimedia '.colEspacios(["12"]).'"></div>
                        <div class="multimediaFisica needsclick dz-clickable '.colEspacios(["12"]).'">
                            <div class="dz-message needsclick">
                                Arrastrar o dar click para subir la galeria de imagenes.
                            </div>
                        </div>
                    </div>
                </div>';
    }else if ($tipo == "mapa") {

        return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                <label class="col-lg-2 form-control-label">'.$label.':</label>
                <div class="'.$col.'">
                    <input type="text" class="form-control input-lg ciudadGoogle limpiar'.$item.' '.$item.'" name="ciudadg" columna="ciudadg" id="autocompletado">
                    <input type="hidden" class="form-control '.$clases.' limpiar'.$item.' '.$item.'" columna="'.$columna.'" name="'.$columna.'" id="dataMapa" value="0">
                    <div id="map" style="height: 300px; margin-bottom:  20px"></div>
                 </div>
                </div>';
    }else if ($tipo == "multipersonalizado") {
        $placeholder = ($data == null) ? "" : $data;
        $entrada = '<div class="contendorMulti" style="display: grid; grid-template-columns: 80% 20%;">
                        <div class="dataMulti">
                            <input type="text" class="form-control" placeholder="'.$placeholder.'" value="">
                        </div>
                        <div>
                            <a class="btn btn-fw accent agregarItem" style="color:white">+</a>
                        </div>
                    </div>';
        return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">'.$entrada.'<input type="hidden" condicion="'.$señal.'" busqueda="'.$señal.'" columna="'.$columna.'" name="'.$columna.'" class="form-control objetivoarr '.$clases.' limpiar'.$item.' '.$item.'">
                        <p class="m-b btn-groups objetivoarrbtns"></p>
                    </div>
                </div>';
	}else if ($tipo == "multibotones") {
        $entrada = '';
        for ($i=0; $i < count($data); $i++) {
            $select = '<select tipo="'.$data[$i][1].'" class="form-control creadorArrbtns m-b">';
            $arr = $data[$i][0];
            $opciones = '<option value="ninguno">Selecciona una '.$data[$i][2].'</option>';
            //opciones
            for ($a=0; $a < count($arr); $a++) {
                $opciones = $opciones.'<option value="'.$arr[$a]["id"].'">'.$arr[$a]["nombre"].'</option>';
            }
            $entrada = $entrada.$select.$opciones.'</select>';
        }

        return '<div class="form-group row" condicion="'.$señal.'" busqueda="'.$busqueda.'" style="'.$hidden.'">
                    <label class="col-lg-2 form-control-label">'.$label.':</label>
                    <div class="'.$col.'">'.$entrada.'<input type="hidden" condicion="'.$señal.'" busqueda="'.$señal.'" columna="'.$columna.'" name="'.$columna.'" class="form-control objetivoarr '.$clases.' limpiar'.$item.' '.$item.'">
                        <p class="m-b btn-groups objetivoarrbtns"></p>
                    </div>
                </div>';
    }
}

function botonModal($item)
{
	return '<div class="form-group row">
                <div class="col-lg-12 ">
                    <button class="btn primary btn-lg p-x-md btn-block" id="guardar'.$item.'" tabla="'.$item.'">Guardar</button>
                </div>
            </div>';
}

function modalFormulario($arr)
{

}

function btnModal($item,$tipo,$t,$c)
{
	$texto = ($t == null) ? "AGREGAR ".strtoupper($item) : $t;
	$color = ($c == null) ? "blue" : $c;
	$tipo = ($tipo == null) ? "agregar" : $tipo;
	$ct = ($color == "white") ? "black" : "white";
	return '<ul class="nav navbar-nav">
			<li class="nav-item">
			<a class="btn btn-fw p-a b-t '.$tipo.$item.' '.$color.' abrirModal" tabla="'.$item.'" style="color: '.$ct.';margin-top: 10px" data-target="#modal-'.$item.'" data-toggle="modal">
                <i class="fa fa-plus m-r-xs"></i>
                <strong style="font-weight: bold;">'.$texto.' </strong>
            </a></li></ul>';
}

function colEspacios($col)
{
	if (is_array($col)) {
		return (count($col) == 1) ? 'col-lg-'.$col[0].' col-md-'.$col[0].' col-sm-'.$col[0].' col-xs-'.$col[0] : 'col-lg-'.$col[0].' col-md-'.$col[1].' col-sm-'.$col[2].' col-xs-'.$col[3];
	}else{
		return $col;
	}
}

function constructorTabla($arr)
{
	return '<div class="table-responsive">
          <table class="table table-striped b-t">
            <thead>
              <tr>
                <th style="width:20px;">
                  <label class="ui-check m-a-0">
                    <input type="checkbox"><i></i>
                  </label>
                </th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Menú</th>
                <th>Portada</th>
                <th>Estado</th>
                <th>Imagen</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                  <tr>
                    <td><label class="ui-check m-a-0"><input type="checkbox" name="post[]"><i class="dark-white"></i></label></td>
                    <td>aaa</td>
                    <td>aaa</td>
                    <td>aaa</td>
                    <td>aaa</td>
                    <td>aaa</td>
                    <td>aaa</td>
                    <td>
                      <a href="#" class="active" data-ui-toggle-class><i class="fa fa-check text-success none"></i><i class="fa fa-times text-danger inline"></i></a>
                    </td>
                  </tr>
                @endforeach

            </tbody>
          </table>
        </div>';
}

function arrNombre($jsonString,$condiciones,$respuestas,$dataConcluciones)
{

    $dataBtns = [];
    $data = json_decode($jsonString,true);
    for ($a=0; $a < count($data); $a++) {
        for ($z=0; $z < count($condiciones); $z++) {
            $condi = $condiciones[$z];
            if ($data[$a][$condi] == $respuestas[$z]) {
                $dat = $dataConcluciones[$z]->find($data[$a]["id"]);
                if ($dat) {
                    array_push($dataBtns, $dat);
                }
            }
        }
    }
    return $dataBtns;

}

function vacioNulo($valor)
{
    if ($valor == null || $valor == "" || $valor == "[]" || $valor == []) {
        return true;
    }else{
        return false;
    }
}

// TIENDA

function determinarPrecio($ciudad,$arr)
{
    if ($arr>0) {
        return number_format($arr,2);
    }
    $arr = json_decode($arr,true);
    for ($i=0; $i < count($arr); $i++) {
        $dato = $arr[$i];
        if ($dato["ciudad"] == $ciudad) {
            return number_format($dato["precio"],2);
        }
    }
}

function TarifaEnvio($distancia,$arr)
{
    if ($arr>0) {
        return number_format($arr,2);
    }
    $arr = json_decode($arr,true);
    for ($i=0; $i < count($arr); $i++) {
        $dato = $arr[$i];
        if ($dato["distancia"] >= $distancia) {
            return number_format($dato["precio"],2);
        }
    }
}

function estilosPlantilla($arr,$estilos,$style)
{
    if ($style == "si") {
        $plantilla = 'style="';
    }else{
        $plantilla = '';
    }

    for ($i=0; $i < count($estilos); $i++) {
        $plantilla = $plantilla.determinarEstilo($arr,$estilos[$i]);
    }

    if ($style == "si") {
        $plantilla = $plantilla.'"';
    }

    return $plantilla;
}

function determinarEstilo($template,$value)
{
    if ($value == "bordeBtnFecha") {
        return "color:".$template->bordeBtnFecha.";";
    }else if ($value == "colorBarraBoton") {
        return "background-color:".$template->colorBarraBoton.";";
    }else if ($value == "colorBarraBusqueda") {
        return "color:".$template->colorBarraBusqueda.";";
    }else if ($value == "colorBotones") {
        return "border-color:".$template->colorBotones.";background-color:".$template->colorBotones.";";
    }else if ($value == "colorBtnFecha") {
        return "color:".$template->colorBtnFecha.";";
    }else if ($value == "colorBtnHoverFecha") {
        return "color:".$template->colorBtnHoverFecha.";";
    }else if ($value == "colorCategorias") {
        return "color:".$template->colorCategorias.";";
    }else if ($value == "colorCategoriasImg") {
        return "color:".$template->colorCategoriasImg.";";
    }else if ($value == "colorHoverBtns") {
        return "color:".$template->colorHoverBtns.";";
    }else if ($value == "colorIconoBarra") {
        return "color:".$template->colorIconoBarra.";";
    }else if ($value == "colorIconos") {
        return "filter:".$template->colorIconos.";";
    }else if ($value == "colorLetraBarra") {
        return "color:".$template->colorLetraBarra.";";
    }else if ($value == "colorLetraBotones") {
        return "color:".$template->colorLetraBotones.";";
    }else if ($value == "colorLetraFecha") {
        return "color:".$template->colorLetraFecha.";";
    }else if ($value == "colorLetraHoverFecha") {
        return "color:".$template->colorLetraHoverFecha.";";
    }else if ($value == "colorLetrasPrecios") {
        return "color:".$template->colorLetrasPrecios.";";
    }else if ($value == "colorLetrasProductos") {
        return "color:".$template->colorLetrasProductos.";";
    }else if ($value == "colorSubcategoria") {
        return "color:".$template->colorSubcategoria.";";
    }else if ($value == "colorSubtitulos") {
        return "color:".$template->colorSubtitulos.";";
    }else if ($value == "colorTitulos") {
        return "color:".$template->colorTitulos.";";
    }else if ($value == "ifooter") {
        return "color:".$template->ifooter.";";
    }else if ($value == "letraBarraBusqueda") {
        return "color:".$template->letraBarraBusqueda.";";
    }else if ($value == "letraBtnFecha") {
        return "color:".$template->letraBtnFecha.";";
    }else if ($value == "letraCategoriasImg") {
        return "color:".$template->letraCategoriasImg.";";
    }else if ($value == "letraMenu") {
        return "color:".$template->letraMenu.";";
    }else if ($value == "letraPrecios") {
        return "color:".$template->letraPrecios.";";
    }else if ($value == "letraProductos") {
        return "color:".$template->letraProductos.";";
    }else if ($value == "LetrasHoverBtns") {
        return "color:".$template->LetrasHoverBtns.";";
    }else if ($value == "letraSubtitulo") {
        return "color:".$template->letraSubtitulo.";";
    }else if ($value == "letraTextoFn") {
        return "color:".$template->letraTextoFn.";";
    }else if ($value == "letraTitulo") {
        return "color:".$template->letraTitulo.";";
    }else if ($value == "pfooter") {
        return "color:".$template->pfooter.";";
    }else if ($value == "tfooter") {
        return "color:".$template->tfooter.";";
    }else if ($value == "colorTextoFn") {
        return "color:".$template->colorTextoFn.";";
    }
}

function determinarStore()
{
    if (vacioNulo(Session::get('store'))){
        return false;
    }else{
        return true;
    }
}

function valorStore()
{
    return Session::get('store');
}

function fechaHoy($tipo)
{
    date_default_timezone_set('America/Lima');
    if ($tipo == "hora") {
        return date('H:i:s');
    }else if ($tipo == "fecha") {
        return  date('Y-m-d');
    }else if ($tipo == "fecha2") {
        return  date('d-m-Y');
    }else if ("todo") {
        return  date('Y-m-d H:i:s');
    }
}

function detectarPrivacidad($elemento,$area,$arr,$role)
{
    if ($role == "ADMIN") {
        return true;
    }
    $arr0 = json_decode($arr[$elemento],true);
    foreach ($arr0 as $key => $value) {
        $tipo = $value["tipo"];
        if ($tipo == $area) {
            $narr = json_decode($value["array"]);
            for ($i=0; $i < count($narr); $i++) {
                if ($narr[$i] == $role) {
                    return true;
                }
            }
        }
    }
    return false;

}

function stringArrConfig($arr,$area)
{
    $arr = json_decode($arr,true);
    foreach ($arr as $key => $value) {
        $tipo = $value["tipo"];
        if ($tipo == $area) {
            return $value["array"];
        }
    }

    return "[]";
}
