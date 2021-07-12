function btnCambiar(obj,clase,id) {
	console.log("aaa");
	console.log(clase);
    $(obj).removeClass().addClass(clase).attr("idItem",id);
}

function elemVacios(tabla) {
	input = $(".limpiar"+tabla);
	console.log("ssss");
	for (var i = 0; i < input.length; i++) {
		if ($(input[i]).hasClass("obligado") && $(input[i]).val() == "") {
			$(input[i]).css("background-color","red").css("color","white");
			Swal.fire({
				title: "¡Error!",
				text: 'El puesto no puede ir vacio.',
				icon: "warning",
				button: "Aceptar",
			});
			return false;
		}else{
			$(input[i]).css("background-color","white").css("color","black");
		}
	}
	return true;
}

function buscarOpcion(op,id,attr) {
	for (var i = 0; i < op.length; i++) {
		if ($(op[i]).val() === id) {
			if (attr === "html") {
				return $(op[i]).html();
			}
		}
	}
}

function crearArrayMulti(obj,attrs) {
    arr0 = [];
    for (var i = 0; i < obj.length; i++) {
        item = {}
        for (var a = 0; a < attrs.length; a++) {
            valor = $(obj[i]).attr(attrs[a]);
            atributo = attrs[a]
            item [atributo] = valor;
        }
        arr0.push(item);
    }

    return arr0;
}

function crearArraySimple(obj,attrs) {
    arr0 = [];
    for (var i = 0; i < obj.length; i++) {
        valor = $(obj[i]).attr(attrs);
    	arr0.push(valor);
    }

    return arr0;
}

function detectarImg(){
	if(!$(".previsualizarfn").attr("src")){
		return false;
	}else{
		return true;
	}
}

function limpiarModal(nombre) {
	entrada = ".limpiar"+nombre;
	//inputs
	$(entrada).val("");
	$(".creadorArrbtns").val("ninguno");
	$(".objetivoarrbtns").html("");
	$(".btnsTarifasModal").html("");
	$(".editarMultimedia").html("");
}

//CONSTRUCTORES

function constructorCajaProd(obj,arr) {
	obj.html("");
	for (var i = 0; i < arr.length; i++) {
		dato = arr[i]
		constructor = "<div class='productoCuadro'>"+
            "<img class='verImagenModal' imagen-modal='"+dato["foto"]+"' src='"+dato["foto"]+"' style='width: 100%;'>"+
            "<p>"+dato["nombre"]+"</p>"+
            "<div class='DetallesProd'>"+
                "<p class='stockHtml'>"+dato["stock"]+"u</p>"+
                "<p class='precioHtml'>S/."+dato["precio"]+"</p>"+
            "</div>"+
            "<div class='botonesProductos'>"+
                "<button class='btn info infoProducto'  data-toggle='modal' data-target='#modal-infoproducto' tipo='"+dato["tipo"]+"' tipoprecio='"+dato["tipoprecio"]+"' minimomayor='"+dato["minimomayor"]+"' preciomayor='"+dato["preciomayor"]+"'   imei='"+dato["imei"]+"' multimedia='"+dato["multimedia"]+"' descripcion='"+dato["descripcion"]+"'  categoria_id='"+dato["categoria_id"]+"' subcategoria_id='"+dato["subcategoria_id"]+"'  brand='"+dato["brand"]+"'  costo='"+dato["costo"]+"' precio='"+dato["precio"]+"'  tipo='"+dato["tipo"]+"' foto='"+dato["foto"]+"' nombre='"+dato["nombre"]+"'><i class='fa fa-info'></i></button>"+
                "<button class='btn success addProducto' imei='"+dato["imei"]+"' precio='"+dato["precio"]+"' tipoprecio='"+dato["tipoprecio"]+"' minimomayor='"+dato["minimomayor"]+"' preciomayor='"+dato["preciomayor"]+"'  imagen='"+dato["foto"]+"' idp='"+dato["id"]+"' nombre='"+dato["nombre"]+"' stock='"+dato["stock"]+"' max='"+dato["stock"]+"'><i class='fa fa-plus'></i></button>"+
            "</div>"+
        "</div>";
		$(obj).append(constructor);

	}
}

function constructorCajaVent(obj,arr){
    obj.html("");
    head = '<div class="tituloTablaVentas btn-group">'+
                    '<button type="button" class="btn btn-outline b-info">Trabajador</button>'+
                    '<button type="button" class="btn btn-outline b-info">Productos</button>'+
                    '<button type="button" class="btn btn-outline b-info">Cliente</button>'+
                    '<button type="button" class="btn btn-outline b-info escritorio ocultarMovil">Nota</button>'+
                    '<button type="button" class="btn btn-outline b-info escritorio ocultarMovil">Descuento</button>'+
                    '<button type="button" class="btn btn-outline b-info escritorio ocultarMovil">Subtotal</button>'+
                    '<button type="button" class="btn btn-outline b-info">Total</button>'+
                '</div>';
    body = '';
    for (var i = 0; i < arr.length; i++) {
        dato = arr[i]
        productos = "";
        arrprod = JSON.parse(dato["pedido"]);
        for (var a = 0; a < arrprod.length; a++) {
            productos = productos + arrprod[a]["nombre"] + '<br>';
        }
        body = body+'<div class="datoVentaTb">'+
                    '<div>'+dato["trabajador"]+'</div>'+
                    '<div>'+productos+'</div>'+
                    '<div>'+dato["cliente"]+'</div>'+
                    '<div class="escritorio ocultarMovil">'+dato["nota"]+'</div>'+
                    '<div class="escritorio ocultarMovil">'+dato["descuento"]+'</div>'+
                    '<div class="escritorio ocultarMovil">'+dato["subtotal"]+'</div>'+
                    '<div>'+dato["total"]+'</div>'+
                '</div>';
    }
    constructor = '<div class="tablaVentasPersonalizada">'+head+body+'</div>';
    $(obj).append(constructor);
    $(".buscarFecha").val("");
}

function constructorListaCaja(id,nombre,stock,precio,tipoprecio,minimomayor,preciomayor,imei,imagen) {
    select = "";
    if (imei != null && imei != "" && imei != "[]" ) {
        imei = JSON.parse(imei);
        opciones = "";
        for (var i = 0; i < imei.length; i++) {

            opciones = opciones+'<option value="'+imei[i]+'" style="color:black">'+imei[i]+'</option>';
        }
        select = '<select class="form-control selectImei">'+
                    '<option style="color:black" value="0">Selecciona imei</option>'+opciones
                '</select>';
    }
	return '<div class="list-item listaPE">'+
                '<div class="list-left">'+
                    '<span class="w-40 avatar circle lt cantidadCaja" style="font-weight: bold;font-size: 25px">1</span>'+
                '</div>'+
                '<div class="list-body">'+
                    '<div class="pull-right">'+
                        '<a class="text-danger eliminarProducto" idProd="'+id+'">'+
                            '<i class="fa fa-times"></i>'+
                        '</a>'+
                    '</div>'+
                    '<div class="item-title">'+
                        '<a class="_500" style="font-weight: bold;">'+nombre+'</a>'+
                    '</div>'+
                    '<div class="btn-group pull-left" style="margin-top: 5px">'+
                        '<a class="btn btn-xs circle restaCaja danger" style="width: 60px" cantidad="1" tipoprecio="'+tipoprecio+'" minimomayor="'+minimomayor+'" preciomayor="'+preciomayor+'" precio="'+precio+'" nombre="'+nombre+'" stock="'+stock+'" idProd="'+id+'">-</a>'+
                        '<a class="btn btn-xs circle sumaCaja success" style="width: 60px" imei="vacio" cantidad="1" tipoprecio="'+tipoprecio+'" minimomayor="'+minimomayor+'" preciomayor="'+preciomayor+'" precio="'+precio+'" nombre="'+nombre+'" stock="'+stock+'" idProd="'+id+'">+</a>'+
                    '</div>'+
                    '<span class="text-sm text-warning pull-right">'+
                        '<strong style="font-size: 20px">'+precio+'</strong>'+
                    '</span>'+
                '</div>'+select+
            '</div>'+
            '<a class="pull-left w-40 m-r-sm listaPM" style="margin:10px;">'+
                '<img src="'+imagen+'" style="height: 100%;border-radius: 10000;" alt="." class="w-full img-circle">'+
                '<div class="cantidadMovil" style="background-color:red;" idProd="'+id+'">1</div>'+
            '</a>';
}

function entradaThCobro(obj,stock,producto,precio) {
    subtotal = Number(precio)*Number(stock);
    obj.append('<tr>'+
            '<td style="border-left-color: #FFF; "><strong>'+stock+'</strong></td>'+
            '<td style="border-left-color: #FFF;" class="text-left"><span id="">'+producto+'</span></td>'+
            '<td style="border-color: #FFF !important;border-bottom-width: 0px;border-top-width: 0px;">'+Number(precio).toFixed(2)+'</td>'+
            '<td style="border-right-color: #FFF;" class="text-right"><strong id="adcobro">'+Number(subtotal).toFixed(2)+'</strong></td>'+
        '</tr>')
}

//VENTAS

function busqobj(obj,cond,resp,traer) {
	verdad = false;
	for (var i = 0; i < obj.length; i++) {
		selector = obj[i]
		verdad = true;
		for (var a = 0; a < cond.length; a++) {
			datoa = isNaN($(selector).attr(cond[a])) ? $(selector).attr(cond[a])*1 : $(selector).attr(cond[a]);
			datob = isNaN(resp[a]) ? resp[a]*1 : resp[a];

			console.log(datoa +"=="+ datob)

			if (datoa == datob) {
				verdad = verdad && true;
				i = obj.length - 1;
			}else{
				verdad = verdad && false;
			}
		}
		if (obj.length - 1 == i && verdad) {
			return [$(selector).attr(traer),selector];
		}
	}

	return false;
}

function generalizar(tipo,obj,id,attr,igualar) {

    for (var i = 0; i < obj.length; i++) {
        obj2 = obj[i];
        if ($(obj2).attr(attr[0]) === id) {
            if (tipo === "html") {
                $(obj2).html(igualar);
            }else if (tipo = "attr") {
                $(obj2).attr(attr[1],igualar);
            }
        }
    }
}

function sumaTotal() {
	suma =0;
	lista = $(".sumaCaja");
	if (lista.length == 0) {
		$(".totalCVenta").html("Total: S/.0.00");
	}
	for (var i = lista.length - 1; i >= 0; i--) {
		cantidad = $(lista[i]).attr("cantidad");
        minimomayor = $(lista[i]).attr("minimomayor");
		precio = $(lista[i]).attr("precio");
        preciomayor = $(lista[i]).attr("preciomayor");
        if (cantidad<minimomayor) {
            suma = suma*1 + precio*cantidad;
        }else{
    		suma = suma*1 + preciomayor*cantidad;
        }
	}
	$(".totalCVenta").html("Total: S/."+suma.toFixed(2))
	$(".totalCVenta2").html("S/."+suma.toFixed(2))
    $(".actCobro").attr("total",suma)
}

function creadorArrSelec(obj,attrs) {
    arrG = [];
    for (var i = 0; i < obj.length; i++) {
        arr = {};
        selctor = obj[i];
        for (var a = 0; a < attrs.length; a++) {
            arr[attrs[a]] = $(selctor).attr(attrs[a]);
        }
        arrG.push(arr);
    }
    return JSON.stringify(arrG);
}

function limpiarFomCobro() {
    $(".descuentoInput").val("");
    $(".bancoInput").val("");
    $(".notaInput").val("");
    $(".pedido").val("");
    $(".subtotal").val("");
    $(".descuento").val("");
    $(".vuelto").val("");
    $(".total").val("");
    $(".cod_pago").val("");
    $(".nota").val("");
    $(".descuento").val("");
    $(".igv").val("");
    $(".vuelto").val("");
    $(".listaPE").remove();
    $(".listaPM").remove();
    $(".totalCVenta").html("Total: S/.0.00");
    $(".nombreCliente").attr("nombrecliente","").val("")
}

function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {
              return true;
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{
                    return true;
                }
          }else{
              return false;
          }
    }
}

function filterFloat2(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter2(tempValue)=== false){
            return false;
        }else{
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {
              return true;
          }else if(key == 46){
                if(filter2(tempValue)=== false){
                    return false;
                }else{
                    return true;
                }
          }else{
              return false;
          }
    }
}

function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,2})$/;
    if(preg.test(__val__) === true){
        return true;
    }else{
       return false;
    }
}

function filter2(__val__){
    var preg = /^[0-9]+$/;
    if(preg.test(__val__) === true){
        return true;
    }else{
       return false;
    }
}

function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /^[a-z-0-9ñÑáéíóúÁÉÍÓÚ ]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}



//Colorpicker
$('.my-colorpicker').colorpicker();