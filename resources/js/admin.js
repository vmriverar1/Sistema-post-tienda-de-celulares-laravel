var arrayFilesMultimedia = [];

$(document).on("click", ".abrirModal", function(e){
	btnCambiar($("#guardar"+$(this).attr("tabla")),"btn primary btn-lg p-x-md btn-block guardar");
	$(".limpiar"+$(this).attr("tabla")).val("");
})

$(document).on("click", ".guardar", function(e){
	e.preventDefault();
	$(this).attr("disabled","");
	tabla = $(this).attr("tabla");
	continuar = elemVacios($(this).attr("tabla"));
	if (continuar) {
		crearDato('/crear/'+tabla+'/store',$("#formulario"+tabla),$("#modal-"+tabla),$('.nuevaFoto'),"categorias");
	}
})

$(document).on("click", ".editar", function(e){

	nformulario = '#modal-'+$(this).attr("tabla");
	labels = $(this).attr("arr");
	columnas = [];
	campos = $(".limpiar"+$(this).attr("tabla"));
	for (var i = 0; i < campos.length; i++) {
		camp = $(campos[i]).attr("columna");
		columnas.push(camp);
	}
	$(nformulario).modal("show");
	//procesos
	btnCambiar($("#guardar"+$(this).attr("tabla")),"btn primary btn-lg p-x-md btn-block cambiar",$(this).attr("iditem"));
	traerDato($(campos),$(this).attr("idItem"),$(this).attr("tabla"),columnas,null,labels);
})

$(document).on("click", ".cambiar", function(e){
	e.preventDefault();
	$(this).attr("disabled","");
	id = $(this).attr("idItem");
	tabla = $(this).attr("tabla");
	continuar = elemVacios($(this).attr("tabla"))
	if (continuar) {
		editarDato('/'+tabla+'/update/'+id,$("#formulario"+tabla),$("#modal-"+tabla));
	}
})

$(document).on("click", ".eliminar", function(e){
	id = $(this).attr("idItem");
	tabla = $(this).attr("tabla");
	eliminarDato(id,tabla);
})

$(document).on("change", ".creadorArrbtns", function(e){

	id = $(this).val();
	tipo = $(this).attr("tipo");
	op = $(this).children()
	nombre = buscarOpcion(op,id,"html");

	arrantiguo = $(this).parent().children(".objetivoarr").val();
	if (arrantiguo != "") {
		arrantiguo = JSON.parse(arrantiguo);
	}
	resolucion = $(this).parent().children(".objetivoarr").hasClass("multiarr");
	if (id === "ninguno") {
		return;
	}
	if (resolucion) {
		if (arrantiguo != "") {
			estado = true;
			for (var i = 0; i < arrantiguo.length; i++) {
				ida = arrantiguo[i]["id"];
				tipoa = arrantiguo[i]["tipo"];
				if (id == ida && tipo == tipoa) {
					estado = false;
				}
			}
			if (estado === false) {
				return;
			}
		}
		tipo = $(this).attr("tipo");
		$(this).parent().children(".objetivoarrbtns").append('<a id="'+id+'" tipo="'+tipo+'" class="btn btn-sm accent itemCompuesto" style="color:white">'+nombre+'</a>');
		arr = crearArrayMulti($(this).parent().children(".objetivoarrbtns").children(),["id","tipo"]);
		$(this).parent().children(".objetivoarr").val(JSON.stringify(arr))
	}else{
		if (arrantiguo != "") {
			estado = true;
			for (var i = 0; i < arrantiguo.length; i++) {
				ida = arrantiguo[i];
				if (id == ida) {
					estado = false;
				}
			}
			if (estado === false) {
				return;
			}
		}
		$(this).parent().children(".objetivoarrbtns").append('<a id="'+id+'" tipo="'+tipo+'" class="btn btn-sm accent itemCompuesto" style="color:white">'+nombre+'</a>');
		arr = crearArraySimple($(this).parent().children(".objetivoarrbtns").children(),"id");
		$(this).parent().children(".objetivoarr").val(JSON.stringify(arr))
	}
})

$(document).on("click", ".itemCompuesto", function(e){
	tipo = $(this).attr("tipo");
	idv = $(this).attr("id");
	boton = $(this);
	padrecont = $(this).parent();
	contarr = $(this).parent().parent().children(".objetivoarr");
	modal = $(this).parent().parent().parent().parent().parent().parent().parent().parent();
	modal.css("z-index","1");
	$("#modal-eliminar").modal('show')
	$(document).on("click", ".eliminarSiGracias", function(e){
		nuevoarr = [];
		boton.remove();
		datos = padrecont.children();
		for (var i = 0; i < datos.length; i++) {
			data = {};
			data["tipo"] = $(datos[i]).attr("tipo");
			data["id"] = $(datos[i]).attr("id");
			nuevoarr.push(data);
		}
		contarr.val(JSON.stringify(nuevoarr));
		$("#modal-eliminar").modal('hide');
		modal.css("z-index","300000000000");
		return;
    })
    $(document).on("click", ".eliminarNoGracias", function(e){
        $("#modal-eliminar").modal('hide');
		modal.css("z-index","300000000000");
        return;
    })
})

$(document).on("click", ".agregarItem", function(e){

	valor = $(this).parent().parent().children(".dataMulti").children().val();
	arrantiguo = $(this).parent().parent().parent().children(".objetivoarr").val();

	if (valor == "") {return}

	if (arrantiguo != "") {
		arrnuevo = JSON.parse(arrantiguo);
	}else{
		arrnuevo = [];
	}

	arrnuevo.push(valor);
	arrnuevo = JSON.stringify(arrnuevo);

	$(this).parent().parent().children(".dataMulti").children().val("");
	$(this).parent().parent().parent().children(".objetivoarr").val(arrnuevo);
	$(this).parent().parent().parent().children(".objetivoarrbtns").append('<a class="btn btn-sm accent itemSimple" style="color:white">'+valor+'</a>');
})

$(document).on("click", ".itemSimple", function(e){
	boton = $(this);
	padrecont = $(this).parent();
	contarr = $(this).parent().parent().children(".objetivoarr");
	modal = $(this).parent().parent().parent().parent().parent().parent().parent().parent();
	modalcobrar = $(this).parent().attr("cobro");

	$("#modal-eliminar").modal('show')
	$(document).on("click", ".eliminarSiGracias", function(e){
		nuevoarr = [];
		boton.remove();
		datos = padrecont.children();
		for (var i = 0; i < datos.length; i++) {
			valor = $(datos[i]).html();
			nuevoarr.push(valor);
		}
		contarr.val(JSON.stringify(nuevoarr));
		$("#modal-eliminar").modal('hide');
		return;
    })
    $(document).on("click", ".eliminarNoGracias", function(e){
        $("#modal-eliminar").modal('hide');
        return;
    })
})

$(document).on("click", ".verImagenModal", function(e){
	img = $(this).attr("imagen-modal");
	$(".imagenesTablas").html('<img src="'+img+'" class="img-thumbnail previsualizar" width="70%">');
	$("#modal-fotografias").modal("show");
})

$(document).on("click", ".verArrFotos", function(e){
	img = $(this).attr("arr");
	img = JSON.parse(img);
	url = $(this).attr("base");
	$(".imagenesTablas").html('');
	for (var i = img.length - 1; i >= 0; i--) {
		$(".imagenesTablas").append('<img src="'+url+"/"+img[i]+'" class="img-thumbnail previsualizar" width="70%">');
	}
	$("#modal-fotografias").modal("show");
})


$(document).on("change", ".nuevaFoto", function(e){
	var imagen = this.files[0];
	var datosImagen = new FileReader;
	datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function(event){
        var rutaImagen = event.target.result;
        $('.previsualizarfn').attr("src", rutaImagen);
    })
})

$(document).on("click", ".agregarTarifa", function(e){
	radio = $(".radioGoogle").val();
	tarifa = $(".radioTarifa").val();

	btn = '<a class="btn info btn-block radioData" distancia="'+radio+'" precio="'+tarifa+'" style="color:white">$'+tarifa+' MXN HASTA LOS '+radio+'Km</a>';
	$(".btnsTarifas").append(btn);

	arr = crearArrayMulti($(".radioData"),["distancia","precio"]);
	$(".radioGoogle").val("");
	$(".radioTarifa").val("");
	$(".tarifaRadio").val(JSON.stringify(arr));
	console.log(arr)
})

$(document).on("click", ".activarEstado", function(e){

})

$(document).on("click", ".verProductos", function(e){
	$(".filtroDataVentas").css("position","absolute")
	$(".filtroDataProductos").css("position","")
	$(".divForm").fadeOut(300);
	$(".filtroDataProductos").fadeIn(300);
})

$(".contenedorVentas").on("click", ".verProductos2", function(e){
	$(".regresarCaja").css("display","");
	$(".divMovilProductos").css("display","none")
	$(".filtroDataProductos").fadeIn(100);
	$(".ventaData").css("display","grid").css("grid-template-rows","20% 80% 0px");
	$(".ventaAhora").css("grid-template-rows","80% 20%");
	$(".listaVentas").addClass("listaProdsCajaMovil");
	$(".listaVentas").removeClass("listaProdsCajaEscritorio");
	$(".listaVentas").css("display","block");
	$(".contenedorVentas").css("grid-template-columns","15% 85%");
	$(".dispositivoEscritorio").parent(".filtrosVentas").css("display","none")
})

$(".contenedorVentas").on("click", ".verVentas2", function(e){
	$(".regresarCaja").css("display","");
	$(".divMovilProductos").css("display","none")
	$(".filtroDataVentas").fadeIn(100);
	$(".ventaData").css("display","grid").css("grid-template-rows","20% 80% 0px");
	$(".ventaAhora").css("grid-template-rows","80% 20%");
	$(".listaVentas").addClass("listaProdsCajaMovil");
	$(".listaVentas").removeClass("listaProdsCajaEscritorio");
	$(".listaVentas").css("display","block");
	$(".contenedorVentas").css("grid-template-columns","15% 85%");
	$(".dispositivoEscritorio").parent(".filtrosVentas").css("display","none")
	traerDatos(["0","0","0","0"],"ventas-caja",$(".listaProductos"));
})

$(".contenedorVentas").on("click", ".agrandarCaja", function(e){
	if ($(this).attr("agrandado") == "no") {
		$(".escritorio").removeClass("ocultarMovil");
		$(".tituloTablaVentas").css("grid-template-columns","15% 22% 15% 12% 12% 12% 12%")
		$(".datoVentaTb").css("grid-template-columns","15% 22% 15% 12% 12% 12% 12%")
		$(this).attr("agrandado","si")
		$(".tablaVentasPersonalizada").addClass("tablaAgrandada").removeClass("tablaVentasPersonalizada").css("width","950px");
	}else{
		$(this).attr("agrandado","no")
		$(".escritorio").addClass("ocultarMovil");
		$(".tituloTablaVentas").css("grid-template-columns","30% 30% 20% 20%")
		$(".datoVentaTb").css("grid-template-columns","30% 30% 20% 20%")
		$(".tablaAgrandada").removeClass("tablaAgrandada").addClass("tablaVentasPersonalizada").css("width","950px");
	}
})

$(".contenedorVentas").on("click", ".regresarACaja", function(e){
	$(".filtroDataVentas").fadeOut(100);
	$(".filtroDataProductos").fadeOut(100);
	$(".listaVentas").addClass("listaProdsCajaEscritorio");
	$(".listaVentas").removeClass("listaProdsCajaMovil");
	$(".filtroDataProductos").css("display","none");
	$(".regresarCaja").css("display","none");
	$(".divMovilProductos").fadeIn(300)
	$(".ventaAhora").css("grid-template-rows","10% 80% 10%");
	$(".contenedorVentas").css("grid-template-columns","100%");
	$(".ventaData").css("display","grid").css("grid-template-rows","20% 80% 0px");
	$(".ventaData").css("display","none");
	$(".contenedorVentas").attr("agrandar","no")
	$(".listaProductos").html("");
	$(".escritorio").addClass("ocultarMovil");
	$(".tituloTablaVentas").css("grid-template-columns","30% 30% 20% 20%");
	$(".datoVentaTb").css("grid-template-columns","30% 30% 20% 20%");
	$(".tablaAgrandada").removeClass("tablaAgrandada").addClass("tablaVentasPersonalizada").css("width","950px");
})

$(document).on("click", ".removerImagen", function(e){
	$(this).parent().parent().remove();
	imagenes = $(".imagenesRestantes");
	arr = [];
	for (var i = 0; i < imagenes.length; i++) {
		imagen = $(imagenes[i]).val()
		arr.push(imagen);
	}
	arr = JSON.stringify(arr);
	$(".antiguasMultimedia").val(arr);
})

$(document).on("click", ".activarEstado", function(e){
	e.preventDefault();
	console.log("aa");
	boton = $(this);
	estado = $(this).attr("estado");
	boton.attr("disabled")
    $.ajax({
        url: $(this).parent().attr('action') + '?' + $(this).parent().serialize(),
        method: $(this).parent().attr('method'),
        // data: formData,
        processData: false,
        contentType: false
    }).done(function (data) {
        console.log(data);
        if (estado == "1") {
	        boton.removeClass("success").addClass("warning").html("Desactivado").attr("estado","0")
	        $(".estadoFata").val("0")
        }else{
	        boton.removeClass("warning").addClass("success").html("Activado").attr("estado","1")
	        $(".estadoFata").val("1")
        }
       	$(".guardarGasto").removeAttr("disabled");
    }).fail(function () {
       	$(".guardarGasto").removeAttr("disabled");
        alert('Error al guardar, actualice la página');
    });
})


$(document).on("click", ".buscarProducto", function(e){
	dni = ($(".dniBuscarProd").val() == "") ? 0 : $(".dniBuscarProd").val();
	arr = [$(".catBuscarProd").val(),$(".subBuscarProd").val(),$(".brandBuscarProd").val(),dni];
	traerDatos(arr,"productos-caja",$(".listaProductos"));
})

$(".contenedorVentas").on("click", ".verVentas", function(e){
	$(".filtroDataProductos").css("position","absolute")
	$(".filtroDataVentas").css("position","")
	$(".divForm").fadeOut(300);
	$(".filtroDataVentas").fadeIn(300);
	//vrnta
	traerDatos(["0","0","0","0"],"ventas-caja",$(".listaProductos"));
})

$(".contenedorVentas").on("click", ".buscarVenta", function(e){
	fecha = ($(".buscarFecha").val() == "") ? 0 : $(".buscarFecha").val();
	imei = ($(".buscarImei").val() == "") ? 0 : $(".buscarImei").val();
	dni = ($(".dniBuscarVent").val() == "") ? 0 : $(".dniBuscarVent").val();

	arr = [fecha,$(".buscarCajero").val(),imei,dni];
	traerDatos(arr,"ventas-caja",$(".listaProductos"));
})


$(".modal-preciovariable").on("click", ".cambiarPrecioProducto", function(e){
	idp = $(this).attr("idProd");
	$("#modal-preciovariable").modal('hide');
	nuevoprecio = $(".precioCambiante").val()*1;
	valor = busqobj($(".sumaCaja"),["idProd"],[idp],"cantidad");
	$(valor[1]).attr("precio",nuevoprecio).attr("preciomayor",nuevoprecio);
	$(valor[1]).parent().children(".restaCaja").attr("precio",nuevoprecio).attr("preciomayor",nuevoprecio);
	$(valor[1]).parent().parent().parent().children(".list-body").children(".text-sm").children().html(nuevoprecio.toFixed(2))
	valor = busqobj($(".addProducto"),["idp"],[idp],"cantidad");
	$(valor[1]).attr("precio",nuevoprecio).attr("preciomayor",nuevoprecio);
	$(valor[1]).parent().parent().children(".DetallesProd").children(".precioHtml").html("S/."+nuevoprecio.toFixed(2));
	sumaTotal()
})

$(".contenedorVentas").on("click", ".addProducto", function(e){
	// $(".listaVentas").addClass("listaProdsCajaEscritorio");
	precio = $(this).attr("precio");
	costo = $(this).attr("costo");
	nombre = $(this).attr("nombre");
	stock = $(this).attr("stock");
	imagen = $(this).attr("imagen");
	imei = $(this).attr("imei");
	idp = $(this).attr("idp");
	max = $(this).attr("max");
	tipoprecio = $(this).attr("tipoprecio");
	minimomayor = $(this).attr("minimomayor")*1;
	preciomayor = $(this).attr("preciomayor");
	//buscamos si esta esta en la lista
	valor = busqobj($(".sumaCaja"),["idProd"],[idp],"cantidad");

	if (valor[0]*1 > 0 && valor[0]*1<max) {
		valor[0]++
		if (valor[0] < minimomayor) {
			preciofinal = valor[0]*precio;
		}else{
			preciofinal = valor[0]*preciomayor;
		}
		$(valor[1]).attr("cantidad",valor[0])
		$(valor[1]).parent().children().attr("cantidad",valor[0])
		$(valor[1]).parent().parent().parent().children(".list-left").children().html(valor[0])
		$(valor[1]).parent().parent().parent().children(".list-body").children(".text-sm").children().html(preciofinal.toFixed(2))
		valormovil = busqobj($(".cantidadMovil"),["idProd"],[idp],"idProd");
		$(valormovil[1]).html(valor[0])
	}else if(valor == false && max*1  > 0){
		if (tipoprecio == "CAMBIANTE") {
			$("#modal-preciovariable").modal('show')
			$(".precioCambiante").attr("placeholder","Precio referencial S/."+precio);
			$(".cambiarPrecioProducto").attr("idProd",idp);
		}
		elemento = constructorListaCaja(idp,nombre,stock,precio,tipoprecio,minimomayor,preciomayor,imei,imagen);
        $(".listaVentas").append(elemento);
	}
	sumaTotal()
})

$(".contenedorVentas").on("click", ".infoProducto", function(e){
	marcas = $(".brandBuscarProd").children();
	categorias = $(".catBuscarProd").children();
	subcategorias = $(".subBuscarProd").children();
	marca = "";
	fotomarca = "";
	categoria = JSON.parse($(this).attr("categoria_id"));
	subcategoria =  JSON.parse($(this).attr("subcategoria_id"));
	subcategoria =  JSON.parse($(this).attr("subcategoria_id"));
	imei =  JSON.parse($(this).attr("imei"));
	multimedia = JSON.parse($(this).attr("multimedia"));
	$(".catsProdModal").html("");
	$(".subsProdModal").html("");
	$(".imeiProdModal").html("");

	for (var i = 0; i < marcas.length; i++) {
		data = marcas[i];
		if ($(data).val() == $(this).attr("brand")) {
			marca = $(data).html();
			fotomarca = $(data).attr("foto");
		}
	}
	for (var i = 0; i < categorias.length; i++) {
		data = categorias[i];
		for (var a = 0; a < categoria.length; a++) {
			cat = categoria[a]
			if ($(data).val() == cat["id"]) {
				$(".catsProdModal").append('<button class="md-btn md-raised m-b-sm w-xs warning">'+$(data).html()+'</button>');
			}
		}
	}

	for (var i = 0; i < subcategorias.length; i++) {
		data = subcategorias[i];
		for (var a = 0; a < subcategoria.length; a++) {
			sub = subcategoria[a]
			if ($(data).val() == sub["id"]) {
				$(".subsProdModal").append('<button class="md-btn md-raised m-b-sm w-xs warning">'+$(data).html()+'</button>');
			}
		}
	}

	for (var i = 0; i < imei.length; i++) {
		data = imei[i];
		$(".imeiProdModal").append('<button class="md-btn md-raised m-b-sm w-xs warning">'+data+'</button>');
	}

	mult = "";
	for (var i = multimedia.length - 1; i >= 0; i--) {
		mult= mult+'<img src="'+multimedia[i]+'" style="width:100%;padding:10px;">';
	}

	$(".nombreProdModal").html($(this).attr("nombre"));
	$(".descripcionProdModal").html($(this).attr("descripcion"));
	$(".marcaLogoProdsModal").attr("src",fotomarca);
	$(".fotoProdModal").attr("src",$(this).attr("foto"));
	$(".marcaProdModal").html(marca);
	$(".tipoProdModal").html($(this).attr("tipo"));
	$(".tipoPrecioProdModal").html($(this).attr("tipoprecio"));
	$(".costoProdModal").html("S/."+$(this).attr("costo"));
	$(".precioProdModal").html("S/."+$(this).attr("precio"));
	$(".cantMayorProdModal").html($(this).attr("minimomayor"));
	$(".precioProdModal").html("S/."+$(this).attr("preciomayor"));
	$(".multimediaProdModal").html(mult);
})

$(".contenedorVentas").on("click", ".sumaCaja", function(e){
	stock = $(this).attr("stock");
	cantidad = $(this).attr("cantidad");
	precio = $(this).attr("precio");
	idp = $(this).attr("idProd");
	tipoprecio = $(this).attr("tipoprecio");
	minimomayor = $(this).attr("minimomayor");
	preciomayor = $(this).attr("preciomayor");
	if (cantidad*1<stock*1) {
		cantidad++
		if (cantidad < minimomayor) {
			preciofinal = cantidad*precio;
		}else{
			preciofinal = cantidad*preciomayor;
		}
		$(this).attr("cantidad",cantidad)
		$(this).parent().children().attr("cantidad",cantidad)
		$(this).parent().parent().parent().children(".list-left").children().html(cantidad)
		$(this).parent().parent().parent().children(".list-body").children(".text-sm").children().html(preciofinal.toFixed(2))
		valormovil = busqobj($(".cantidadMovil"),["idProd"],[idp],"idProd");
		$(valormovil[1]).html(cantidad)
		sumaTotal()
	}
})

$(".contenedorVentas").on("click", ".restaCaja", function(e){
	stock = $(this).attr("stock");
	cantidad = $(this).parent().children(".sumaCaja").attr("cantidad");
	precio = $(this).attr("precio");
	idp = $(this).attr("idProd");
	tipoprecio = $(this).attr("tipoprecio");
	minimomayor = $(this).attr("minimomayor");
	preciomayor = $(this).attr("preciomayor");
	if (cantidad*1 > 0) {
		cantidad--
		if (cantidad < minimomayor) {
			preciofinal = cantidad*precio;
		}else{
			preciofinal = cantidad*preciomayor;
		}
		$(this).parent().children(".sumaCaja").attr("cantidad",cantidad)
		$(this).parent().children().attr("cantidad",cantidad)
		$(this).parent().parent().parent().children(".list-left").children().html(cantidad)
		$(this).parent().parent().parent().children(".list-body").children(".text-sm").children().html(preciofinal.toFixed(2))
		valormovil = busqobj($(".cantidadMovil"),["idProd"],[idp],"idProd");
		$(valormovil[1]).html(cantidad)
		sumaTotal()
	}
})

$(".contenedorVentas").on("click", ".eliminarProducto", function(e){
	idp = $(this).attr("idProd");
	$(this).parent().parent().parent().remove();
	valormovil = busqobj($(".cantidadMovil"),["idProd"],[idp],"idProd");
	$(valormovil[1]).parent().remove()
	sumaTotal()
})

$(".contenedorVentas").on("click", ".cantidadMovil", function(e){
	idp = $(this).attr("idProd");
	$(this).parent().remove();
	valormovil = busqobj($(".eliminarProducto"),["idProd"],[idp],"idProd");
	$(valormovil[1]).parent().parent().parent().remove();
	sumaTotal()
})

$(document).on("change", ".selectImei", function(e){
	$(this).parent().children(".list-body").children(".btn-group").children(".sumaCaja").attr("imei",$(this).val());
})

$(".multimediaFisica").dropzone({
	url: "/dropzone/upload",
	addRemoveLinks: true,
	acceptedFiles: "image/jpeg, image/png",
	maxFilesize: 2,
	maxFiles: 10,
	headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
	init: function(){
		this.on("addedfile", function(file){
			arrayFilesMultimedia.push(file);
			console.log(arrayFilesMultimedia);
		})
		this.on("removedfile", function(file){
			var index = arrayFilesMultimedia.indexOf(file);
			arrayFilesMultimedia.splice(index, 1);
			console.log(arrayFilesMultimedia);
		})
	}
})

$('.date').datepicker({
    format: 'dd-mm-yyyy'
});


function desacDivCobrar() {
	$(".vueltoDiv").fadeOut('100');
	$(".monedasDiv").fadeOut('100');
	$(".tablaCobroDiv").removeClass().addClass("col-lg-12 col-md-12 col-sm-12 col-xs-12 tablaCobroDiv m-b");
	$(".dibBtnCobrar").fadeOut('100');
	$(".codTarjetaDiv").fadeOut('100');
	$(".valorVuelto").attr("valor","0").html("S/.0.00");

	$(".valorVuelto").attr("valor","0").html("S/.0.00");
	$(".monedaCambio").attr("cantidad","0");
	$(".dibBtnCobrar").fadeOut('100');
	$(".cantBilletes").remove();
}

function pagoTotalCaja() {
	valorTotal = $(".cobrarPedido").attr("valor");
	descuento = $(".descuentoInput").val();
	total = Number(valorTotal) - Number(descuento.slice(3));

	$(".descuento").val(Number(descuento.slice(3)));
	$(".total").val(Number(total));
	$(".cobrarPedido").html("Pagar S/."+Number(total).toFixed(2));
}

function resetCaja() {
	desacDivCobrar()
	$(".idventa").val("");
	$(".trabajador").val("");
	$(".cliente").val("");
	$(".salon").val("");
	$(".tipo").val("");
	$(".pedido").val("");
	$(".subtotal").val("");
	$(".tipo_descuento").val("NORMAL");
	$(".descuento").val("0");
	$(".igv").val("0");
	$(".adelanto").val("");
	$(".reserva_fecha").val("");
	$(".reserva_hora").val("");
	$(".cod_pago").val("0");
	$(".vuelto").val("0");
	$(".direccion_delivery").val("");
	$(".total").val("");
	$(".listaCajaP").children().remove();
	$(".tapersBD").children().attr("cantidad",0);
	$(".cuadroProductos").children().remove();
	$(".cobrarPedido").attr("valor",total).html("Cobrar S/.0.00");
	$(".totalCVenta").html("Total: S/.0.00")
	$(".totalCobroTd").html(Number(0).toFixed(2))
}

$(document).on("click", ".dctoAct", function(e){
	if ($(".descuentoDiv").attr('act') === "no") {
		$(".descuentoDiv").fadeIn('100').attr("act","si");
	}else{
		$(".descuentoDiv").fadeOut('100').attr("act","no");
		$(".descuentoInput").val("0");
	}
	pagoTotalCaja()
});

$(document).on("click", ".notaAct", function(e){
	nota = $(".notaInput").val();
	if ($(".notaDiv").attr('act') === "no") {
		$(".notaDiv").fadeIn('100').attr("act","si");
	}else if(nota.length == 0){
		$(".notaDiv").fadeOut('100').attr("act","no");
	}
});

$(document).on("click", ".cardAct", function(e){
	desacDivCobrar()
	$(".codTarjetaDiv").fadeIn('100');
});

$(document).on("click", ".efectAct", function(e){
	desacDivCobrar()
	$(".tablaCobroDiv").removeClass("col-lg-12 col-md-12 col-sm-12 col-xs-12").addClass("col-lg-8 col-md-12 col-sm-12 col-xs-12");
	$(".monedasDiv").fadeIn('100');
	$(".vueltoDiv").fadeIn('100');
});

$(document).on("click", ".exacAct", function(e){
	desacDivCobrar()
	$(".dibBtnCobrar").fadeIn('100');
});

$(document).on("click", ".monedaCambio", function(e){

	valor = $(this).attr("valor");
	valorBillete =  $(".valorVuelto").attr("valor");
	valorTotal = $(".cobrarPedido").attr("valor");
	descuento = $(".descuentoInput").val();

	suma = valor*1 + valorBillete*1;
	vuelto = suma - valorTotal - Number(descuento.slice(3));
	cant = Number($(this).attr("cantidad"))+1;
	$(this).attr("cantidad",cant).html("S/."+Number(valor).toFixed(2)+'<span class="label success cantBilletes pull-right">'+cant+'</span>');

	console.log(vuelto);
	if (Number(vuelto) < 0) {
		$(".valorVuelto").attr("valor",suma).html("S/.0.00");
		$(".dibBtnCobrar").fadeOut('100');
	}else{
		$(".valorVuelto").attr("valor",suma).html("S/."+Number(vuelto).toFixed(2));
		$(".dibBtnCobrar").fadeIn('100');
	}
});

$(document).on("click", ".limpiarBilletes", function(e){
	desacDivCobrar()
});

$(document).on("click", ".cobrarPedido", function(e){
	//rellenar datos
	cliente = $(".nombreCliente").attr("nombrecliente");
	pedido = creadorArrSelec($(".sumaCaja"),["idProd","nombre","cantidad","minimomayor","precio","preciomayor","imei"]);
	subtotal = $(this).attr("valor");
	descuentos = $(".descuentoInput").val();
	vuelto = $(".valorVuelto").attr("valor") - subtotal;
	total = subtotal - descuentos;
	$(".cliente").val(cliente);
	$(".pedido").val(pedido);
	$(".subtotal").val(subtotal);
	$(".descuento").val(descuentos);
	$(".vuelto").val(vuelto);
	$(".total").val(total);

	$(this).attr("disabled","");
    $.ajax({
        url: $("#formularioCobro").attr('action') + '?' + $("#formularioCobro").serialize(),
        method: $("#formularioCobro").attr('method'),
        // data: formData,
        processData: false,
        contentType: false
    }).done(function (data) {
        dni = ($(".dniBuscarProd").val() == "") ? 0 : $(".dniBuscarProd").val();
		arr = [$(".catBuscarProd").val(),$(".subBuscarProd").val(),$(".brandBuscarProd").val(),dni];
		traerDatos(arr,"productos-caja",$(".listaProductos"));
       	$(".cobrarPedido").removeAttr("disabled");
    	$("#modal-cobrar").modal('hide');
    	$(".listaProductos").children().remove();
        limpiarFomCobro();
        desacDivCobrar();
        alert('Se realizo la venta correctamente');
    }).fail(function () {
       	$(".cobrarPedido").removeAttr("disabled");
        alert('Error al hacer venta, actualice la página');
    });
});

$(document).on("click", ".guardarGasto", function(e){

	$(this).attr("disabled","");
    $.ajax({
        url: $("#formulariogastos").attr('action') + '?' + $("#formulariogastos").serialize(),
        method: $("#formulariogastos").attr('method'),
        // data: formData,
        processData: false,
        contentType: false
    }).done(function (data) {
        console.log(data);
       	$(".guardarGasto").removeAttr("disabled");
    	$("#modal-gastos").modal('hide');
    	$(".limpiarspends").val("");
        alert('Se guardó el gasto correctamente');
    }).fail(function () {
       	$(".guardarGasto").removeAttr("disabled");
        alert('Error al guardar gasto, actualice la página');
    });
});

$(document).on("click", ".actualizarSettings", function(e){
	e.preventDefault();
    $.ajax({
        url: $(this).parent().attr('action') + '?' + $(this).parent().serialize(),
        method: $(this).parent().attr('method'),
        // data: formData,
        processData: false,
        contentType: false
    }).done(function (data) {
        console.log(data);
        alert('Se guardó el gasto correctamente');
    }).fail(function () {
        alert('Error al guardar gasto, actualice la página');
    });
});

$(document).on("click", ".actCobro", function(e){
	if ($(".sumaCaja").length <= 0) {
		alert("ingrese un producto primero.")
		return;
	}

	imeisb = $(".selectImei")
	admite = true;
	for (var i = imeisb.length - 1; i >= 0; i--) {
		if ($(imeisb[i]).val() == "0") {
			admite = false;
		}
	}

	if (admite == false) {
		alert("No a colocado el imei de uno o mas productos.")
		return;
	}

	total = $(".dibBtnCobrar").attr("valor");
	pedido = creadorArrSelec($(".sumaCaja"),["nombre","cantidad","minimomayor","precio","preciomayor"]);
	pedido = JSON.parse(pedido);
	console.log({pedido})
	if (Number(total) <= 0) {return}
	$("#modal-cobrar").modal('show');
	desacDivCobrar()
	total = $(this).attr("total");


	$(".listaCajaP").children().remove();
	$(".cuadroProductos").children().remove();


	calculosuma = 0;

	for (var i = 0; i < pedido.length; i++) {
		dato = pedido[i];
		precio = (dato["cantidad"]*1 < dato["minimomayor"]*1)?dato["precio"]:dato["preciomayor"];
		calculosuma = calculosuma + dato["cantidad"]*precio;

		entradaThCobro($(".cuadroProductos"),dato["cantidad"],dato["nombre"],precio);
	}

	calculosuma = (total < calculosuma) ? calculosuma : total;


	$(".cobrarPedido").attr("valor",calculosuma).html("Cobrar S/."+Number(calculosuma).toFixed(2));
	$(".totalCVenta").html("Total: S/."+Number(calculosuma).toFixed(2))
	$(".totalCobroTd").html(Number(calculosuma).toFixed(2));
	$("#modal-cobrar").modal("show")

});

$(document).on("keyup", ".descuentoInput", function(e){
	descuento = $(this).val();
	valorTotal = $(".cobrarPedido").attr("valor");
	if (Number(descuento.slice(3)) > valorTotal) {
		$(".descuentoInput").val("0");
		pagoTotalCaja();
		return;
	}
	pagoTotalCaja()
	if (Number(descuento.slice(3)) > 0) {
		$(".dibBtnCobrar").fadeIn('100');
	}else{
		$(".dibBtnCobrar").fadeOut('100');
	}
});

$(document).on("keyup", ".notaInput", function(e){
	banconum = $(this).val();
	$(".nota").val(banconum);
});

$(document).on("keyup", ".bancoInput", function(e){
	banconum = $(this).val();
	if (banconum.length > 0) {
		$(".dibBtnCobrar").fadeIn('100');
		$(".cod_pago").val(banconum);
	}else{
		$(".dibBtnCobrar").fadeOut('100');
		$(".cod_pago").val("0");
	}
});

$(document).on("click", ".detectorPuesto", function(e){
	if (!$(this).attr("abierto")) {
		$(this).attr("abierto","si");
		arr2 = [];
		selectores = $(this).parent().children();
		for (var i = selectores.length - 1; i >= 0; i--) {
			if ($(selectores[i]).attr("abierto") == "si") {
				arr2.push($(selectores[i]).children().attr("role"));
			}
		}
		$(this).parent().attr("array",JSON.stringify(arr2));
		datosFormularioConfig()
		return
	}

	if ($(this).attr("abierto") == "si") {
		console.log("se");
		$(this).removeClass('active');
		$(this).attr("abierto","no");
	}else{
		console.log("no");
		$(this).addClass('active');
		$(this).attr("abierto","si");
	}
	selectores = $(this).parent().children();
	arr2 = [];
	for (var i = selectores.length - 1; i >= 0; i--) {
		if ($(selectores[i]).attr("abierto") == "si") {
			arr2.push($(selectores[i]).children().attr("role"));
			console.log("se")
		}
	}
	$(this).parent().attr("array",JSON.stringify(arr2));
	datosFormularioConfig()
});

function datosFormularioConfig() {
	recolpadre = $(".recolectoresPadres");
	// arr = {};
	for (var i = 0; i < recolpadre.length; i++) {
		arr = []
		recolectar = $(recolpadre[i]).children();
		for (var a = 0; a < recolectar.length; a++) {
			arr0 = {};
			arrayp = $(recolectar[a]).children("div").children(".recolectorData").attr("array");
			arr0["tipo"] = $(recolectar[a]).children("div").children(".recolectorData").attr("tipo");
			arr0["array"] = $(recolectar[a]).children("div").children(".recolectorData").attr("array");
			if (arrayp != "" && arrayp != "[]" && arrayp != "{}") {
				arr.push(arr0);
			}
		}
		input = $(recolpadre[i]).attr("input");
		input = "."+input;
		$(recolpadre[i]).attr("array",JSON.stringify(arr));
		$(input).val(JSON.stringify(arr));
	}
}

$(document).on("keyup", ".nombreCliente", function(e){
	dni = $(this).val();
	if (dni.length > 0) {
		$(".btnConfigCliente").addClass("confirmarCliente").addClass("success").removeClass("primary").removeClass("agregarCliente").html("Confirmar");
	}else{
		$(".btnConfigCliente").addClass("agregarCliente").addClass("primary").removeClass("success").removeClass("confirmarCliente").html("Agregar");
	}
});

$(document).on("change", ".nombreCliente", function(e){
	dni = $(this).val();
	if (dni.length > 0) {
		$(".btnConfigCliente").addClass("confirmarCliente").addClass("success").removeClass("primary").removeClass("agregarCliente").html("Confirmar");
	}else{
		$(".btnConfigCliente").addClass("agregarCliente").addClass("primary").removeClass("success").removeClass("confirmarCliente").html("Agregar");
	}
});

$(document).on("click", ".cancelarVenta", function(e){
	$(".listaVentas").html("")
});

$(document).on("click", ".agregarCliente", function(e){
	$("#modal-clients").modal("show");
	$(".limpiarclients").val("");
	$("#guardarclients").removeClass("guardar").attr("id","").addClass("guardarCliente")
});

$(document).on("click", ".guardarCliente", function(e){
	e.preventDefault();
	$(".guardarCliente").attr("disabled","");
	$.ajax({
        url: $("#formularioclients").attr('action') + '?' + $("#formularioclients").serialize(),
        method: $("#formularioclients").attr('method'),
        processData: false,
        contentType: false
    }).done(function (data) {
       	$(".nombreCliente").val($($(".limpiarclients")[0]).val());
       	$(".nombreCliente").attr("nombrecliente",$($(".limpiarclients")[2]).val());
        $("#modal-clients").modal("hide");
        $(".guardarCliente").removeAttr("disabled");
        alert('Se creo correctamente el cliente');
        $(".limpiarclients").val("");
    }).fail(function () {
        $("#modal-clients").modal("hide");
        $(".guardarCliente").removeAttr("disabled");
        alert('Error al crear cliente, actualice la página');
        $(".limpiarclients").val("");
    });
});

$(document).on("click", ".confirmarCliente", function(e){
	e.preventDefault();
	$(".confirmarCliente").attr("disabled","");
	$.ajax({
        url: $("#formularioDniCliente").attr('action') + '?' + $("#formularioDniCliente").serialize(),
        method: $("#formularioDniCliente").attr('method'),
        processData: false,
        contentType: false
    }).done(function (data) {
       	$(".nombreCliente").val(data["nombre"]);
       	$(".nombreCliente").attr("nombrecliente",data["dni"]);
        $(".confirmarCliente").removeAttr("disabled");
        alert('Se creo correctamente el cliente');
    }).fail(function () {
        $(".confirmarCliente").removeAttr("disabled");
        alert('El cliente no se encuentra en nuestra base de datos.');
    });
});

$(document).on("click", ".abrirCaja", function(e){
	e.preventDefault();
	$(".abrirCaja").attr("disabled","");
	$.ajax({
        url: $("#abrirCajaForm").attr('action') + '?' + $("#abrirCajaForm").serialize(),
        method: $("#abrirCajaForm").attr('method'),
        processData: false,
        contentType: false
    }).done(function (data) {
        location.reload();
    }).fail(function () {
        $(".abrirCaja").removeAttr("disabled");
        alert('No has introducido un monto inicial.');
    });
});

$(document).on("click", ".cantidadCaja", function(e){
	idp = $(this).parent().parent().children(".list-body").children(".btn-group").children(".sumaCaja").attr("idprod");
	$("#modal-cantidadpersonalizada").modal("show");
	$(".personCantidad").attr("idProd",idp);
	$(".personCantidad").val("");
});

$(document).on("click", ".actualizarCantidad", function(e){
	cantidad = $(".personCantidad").val();
	idprod = $(".personCantidad").attr("idProd");
	if (cantidad*1 > 0) {
		valor = busqobj($(".sumaCaja"),["idProd"],[idprod],"cantidad");
		max = $(valor[1]).attr("stock");
		precio = $(valor[1]).attr("precio");
		minimomayor = $(valor[1]).attr("minimomayor")*1;
		preciomayor = $(valor[1]).attr("preciomayor");
		if (max >= cantidad) {
			ncant = cantidad;
		}else{
			ncant = max;
		}

		if (ncant < minimomayor) {
			preciofinal = ncant*precio;
		}else{
			preciofinal = ncant*preciomayor;
		}
		$(valor[1]).parent().parent().parent().children(".list-left").children().html(ncant)
		$(valor[1]).parent().parent().parent().children(".list-body").children(".text-sm").children().html(preciofinal.toFixed(2))
		$(valor[1]).attr("cantidad",ncant)
		valormovil = busqobj($(".cantidadMovil"),["idProd"],[idp],"idProd");
		$(valormovil[1]).html(ncant);
		$("#modal-cantidadpersonalizada").modal("hide");
		$(".personCantidad").val("");
	}
});

$(document).on("click", ".verCajaChica", function(e){
	traerDatos(null,"caja-chica");
});

$(document).on("click", ".cerrarCaja", function(e){
	e.preventDefault();
	$("#modal-caja").modal('hide')
	$("#modal-cerrar-caja").modal('show')
    $(document).on("click", ".eliminarSiGracias", function(e){
		$(".cerrarCaja").attr("disabled","");
		$(".eliminarSiGracias").attr("disabled","");
		$.ajax({
	        url: $("#cerrarCajaForm").attr('action') + '?' + $("#cerrarCajaForm").serialize(),
	        method: $("#cerrarCajaForm").attr('method'),
	        processData: false,
	        contentType: false
	    }).done(function (data) {
	        location.reload();
	    }).fail(function () {
	        $(".cerrarCaja").removeAttr("disabled");
	        $(".eliminarSiGracias").removeAttr("disabled");
	        alert('El cliente no se encuentra en nuestra base de datos.');
	    });
    })
    $(document).on("click", ".eliminarNoGracias", function(e){
        $("#modal-cerrar-caja").modal('hide');
        return;
    })
});

$(document).on("click", ".buscarCajaChica", function(e){
	arr = [$(".inicioFecha").val(),$(".Finfecha").val()];
	traerDatos(arr,"cajas-chicas-reportes",$(".columCaja"));
})

$(document).on("click", ".buscarReportesVentas", function(e){
	arr = [$(".inicioFecha").val(),$(".Finfecha").val()];
	traerDatos(arr,"ventas-reportes",$(".ventasData"));
	traerDatos(arr,"gastos-reportes",$(".GastosData"));
})
$(document).on("click", ".cambiarStore", function(e){
	e.preventDefault();
	$(".sedeSelector").val($(this).attr("idSede"));
	$.ajax({
        url: $("#cambiar-tienda-form").attr('action') + '?' + $("#cambiar-tienda-form").serialize(),
        method: $("#cambiar-tienda-form").attr('method'),
        processData: false,
        contentType: false
    }).done(function (data) {
        location.reload();
    }).fail(function () {
        alert('El cliente no se encuentra en nuestra base de datos.');
    });
})
$(document).on("click", ".abrirGastoMenu", function(e){
	$(".limpiarSpend").val("");
	$(".busquedaProductosGastos").html("");
	$(".productosCompra").html("");
	$(".guardarCompraProd").fadeOut(100);
	$(".limpiarProdsCompra").fadeOut(100);
	$(".previsualizarfn").attr("src","images/default/anonymous.png")
	$("#modal-producto-gasto").modal('show');
	traerDatos([0],"categoria-cobro",$(".catBuscarProd2"));
	traerDatos([0],"subcategoria-cobro",$(".subBuscarProd2"));
	traerDatos([0],"marca-cobro",$(".brandBuscarProd2"));
})

$(document).on("click", ".buscarProducto2", function(e){
	dni = ($(".dniBuscarProd").val() == "") ? 0 : $(".dniBuscarProd").val();
	arr = [$(".catBuscarProd2").val(),$(".subBuscarProd2").val(),$(".brandBuscarProd2").val(),dni];
	traerDatos(arr,"productos-cobro",$(".busquedaProductosGastos"));
})

$(document).on("click", ".limpiarProdsCompra", function(e){
	$(".busquedaProductosGastos").html("");
	$(this).fadeOut(100);
})

$(document).on("click", ".agregarProductoCobro", function(e){
	id = $(this).attr("idProd");
	costo = $(this).attr("costo");
	nombre = $(this).attr("nombre");
	foto = $(this).attr("foto");

	valor = busqobj($(".contenedorCompra"),["idProd"],[id],"costo");
	if (valor) {
		return
	}

	$(".productosCompra").append('<div class="contenedorCompra" cantidad="1" imei="[]" nombre="'+nombre+'" costo="'+costo+'" idProd="'+id+'" style="">'+
      '<img src="'+foto+'" class="img-thumbnail previsualizarfn" width="100px">'+
      '<div class="form-group row objTitulo" style="margin-left: 10px;"><label class="productoTituloCompra" style="font-weight:bold">Subtotal del producto S/.'+costo+':</label><div class=""><div style="display: grid; grid-template-columns: 80%;">'+nombre+'</div></div></div>'+
      '<div class="form-group row objImei" style="">'+
          '<label class="">IMEI:</label>'+
          '<div class=""><div class="contendorMulti" style="display: grid; grid-template-columns: 50% 20%;">'+
              '<div class="dataMulti"><input type="text" class="form-control" placeholder="Escribir lista de numeros de IMEI" value=""></div>'+
              '<div><a class="btn accent agregarItem" style="color:white">+</a></div>'+
          '</div><input type="hidden" class="objetivoarr multiarr" value="">'+
              '<p class="m-b btn-groups objetivoarrbtns" cobro="1"></p>'+
          '</div>'+
      '</div>'+
      '<div class="form-group row objStock subObjCompraCss"  style=""><label class="">Stock:</label>'+
          '<div class=""><div style="display: grid; grid-template-columns: 80%"><input type="number" value="1" class="form-control stockCompraProd" onkeypress="return filterFloat(event,this);"></div></div>'+
      '</div>'+

      '<div class="form-group row objCosto subObjCompraCss"  style=""><label class="">Costo:</label><div class="">'+
            '<div style="display: grid; grid-template-columns: 80%;"><input type="number" value="'+costo+'" class="form-control costoCompraProd" onkeypress="return filterFloat2(event,this);"></div></div>'+
      '</div>'+
      '<div class="subObjCompraCss">'+
	    '<label class="">Eliminar</label>'+
	    '<a class="btn btn-xs danger eliminarProdCompra" style="color:white"><i class="fa fa-trash"></i></a>'+
	  '</div>'+
    '</div>');
    pagoCompraToatl()
})

$(document).on("change", ".stockCompraProd", function(e){
	cantidad = $(this).val();
	costo = $(this).parent().parent().parent().parent().children(".objCosto").children("div").children().children().val();
	total=costo*cantidad;
	$(this).parent().parent().parent().parent().attr("costo",costo)
	$(this).parent().parent().parent().parent().attr("cantidad",cantidad)
	$(this).parent().parent().parent().parent().children(".objTitulo").children(".productoTituloCompra").html("Subtotal del producto S/."+total+":")
	pagoCompraToatl()
})

$(document).on("change", ".costoCompraProd", function(e){
	costo = $(this).val();
	cantidad = $(this).parent().parent().parent().parent().children(".objStock").children("div").children().children().val();
	total=costo*cantidad;
	$(this).parent().parent().parent().parent().attr("costo",costo)
	$(this).parent().parent().parent().parent().attr("cantidad",cantidad)
	$(this).parent().parent().parent().parent().children(".objTitulo").children(".productoTituloCompra").html("Subtotal del producto S/."+total+":")
	pagoCompraToatl()
})

function pagoCompraToatl() {
	elem = $(".contenedorCompra")
	suma = 0;
	for (var i = 0; i < elem.length; i++) {
		costo = $(elem[i]).attr("costo");
		cantidad = $(elem[i]).attr("cantidad");
		suma = suma*1 + (costo*cantidad);
	}
	if (suma>0) {
		$(".guardarCompraProd").html("Pagado S/."+suma.toFixed(2)).fadeIn(100);
	}else{
		$(".guardarCompraProd").html("Pagado S/.0.00").fadeOut(100);
	}
	$(".totalCompraProd").val(suma);
}

$(document).on("click", ".eliminarProdCompra", function(e){
	$(this).parent().parent().remove()
	pagoCompraToatl()
})

$('.table').DataTable( {
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
    responsive: true
} );


$(document).on("click", ".guardarCompraProd", function(e){
	e.preventDefault();
	if ($(".totalCompraProd").val() == "" || $(".tipodeSalida").val() == "ninguno" || $(".contenedorCompra").length == 0) {
		alert("faltan datos");
		return
	}
	selecP = $(".contenedorCompra")
	for (var i = 0; i < selecP.length; i++) {
		imeiarr = $(selecP[i]).children(".objImei").children("div").children(".objetivoarr").val();
		console.log(imeiarr)
		if(imeiarr == ""){
			$(selecP[i]).attr("imei","[]")
		}else{
			$(selecP[i]).attr("imei",imeiarr)
		}
	}
	pedido = creadorArrSelec($(".contenedorCompra"),["idProd","nombre","cantidad","costo","imei"]);
	$(".dataCompra").val(pedido)
	$(".guardarCompraProd").attr("disabled","");
	var formData = new FormData();
    formData.append('photo', $('.nuevaFoto')[0].files[0]);
	$.ajax({
        url: $("#formularioCompraProuctos").attr('action') + '?' + $("#formularioCompraProuctos").serialize(),
        method: $("#formularioCompraProuctos").attr('method'),
        processData: false,
        data: formData,
        contentType: false
    }).done(function (data) {
		$("#modal-producto-gasto").modal('hide');
		$(".previsualizarfn").attr("src","images/default/anonymous.png")
    	$(".limpiarSpend").val("");
		$(".busquedaProductosGastos").html("");
		$(".productosCompra").html("");
		$(".limpiarProdsCompra").fadeOut(100);
        $(".guardarCompraProd").fadeOut(100);
        $(".guardarCompraProd").removeAttr("disabled");
    }).fail(function () {
        $(".guardarCompraProd").removeAttr("disabled");
        alert('Existe un error, actualice la página.');
    });
});

(function($, window) {
    'use strict';

    var MultiModal = function(element) {
        this.$element = $(element);
        this.modalCount = 0;
    };

    MultiModal.BASE_ZINDEX = 1040;

    MultiModal.prototype.show = function(target) {
        var that = this;
        var $target = $(target);
        var modalIndex = that.modalCount++;

        $target.css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20) + 10);

        // Bootstrap triggers the show event at the beginning of the show function and before
        // the modal backdrop element has been created. The timeout here allows the modal
        // show function to complete, after which the modal backdrop will have been created
        // and appended to the DOM.
        window.setTimeout(function() {
            // we only want one backdrop; hide any extras
            if(modalIndex > 0)
                $('.modal-backdrop').not(':first').addClass('hidden');

            that.adjustBackdrop();
        });
    };

    MultiModal.prototype.hidden = function(target) {
        this.modalCount--;

        if(this.modalCount) {
           this.adjustBackdrop();
            // bootstrap removes the modal-open class when a modal is closed; add it back
            $('body').addClass('modal-open');
        }
    };

    MultiModal.prototype.adjustBackdrop = function() {
        var modalIndex = this.modalCount - 1;
        $('.modal-backdrop:first').css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20));
    };

    function Plugin(method, target) {
        return this.each(function() {
            var $this = $(this);
            var data = $this.data('multi-modal-plugin');

            if(!data)
                $this.data('multi-modal-plugin', (data = new MultiModal(this)));

            if(method)
                data[method](target);
        });
    }

    $.fn.multiModal = Plugin;
    $.fn.multiModal.Constructor = MultiModal;

    $(document).on('show.bs.modal', function(e) {
        $(document).multiModal('show', e.target);
    });

    $(document).on('hidden.bs.modal', function(e) {
        $(document).multiModal('hidden', e.target);
    });
}(jQuery, window));