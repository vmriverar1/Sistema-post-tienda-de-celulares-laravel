$(document).on("click", ".redireccionador", function(e){
	console.log("a")
	if (localStorage.getItem("ciudad") > 0) {
		location.href = $(this).attr("titulo");
	}else{
		$("#modalCiudad").modal('show');
		$(".destinodireccion").attr("direccion",$(this).attr("titulo"))
	}
})

$(document).on("change", ".seleccionarEstado", function(e){
	ciudades = JSON.parse($(this).val());
	opciones = "";
	for (var i = 0; i < ciudades.length; i++) {
		arr = ciudades[i];
		opciones = opciones+'<option value="'+arr["id"]+'">'+arr["nombre"]+'</option>';
	}
	$(".seleccionarCiudad").children().remove();
	$(".seleccionarCiudad").append('<option>Elige tu ciudad</option>'+opciones);

	var data = '<select  class="js-example-basic-single form-control js-example-responsive seleccionarCiudad pull-left" id="seleccionarciudad" style="width:100%">'+
                    '<option >Ciudad</option>'+opciones+
                '</select>';
    $(".boxCiudad").html(data)
	selectbuscador()
})

$(document).on("click", ".btnModalCiudad", function(e){
	var route = "/elegirciudad/"+$(".seleccionarCiudad").val();
	var direccion = $(this).attr("direccion");
    $.get(route, function(data){
        localStorage.setItem("ciudad", data);
        if (direccion != "ninguna") {
        	location.href =direccion;
        }
    });
})

$(document).on("click", ".openLogin", function(e){
	$("#modalPassword").modal('hide')
	$("#modalRegistro").modal('hide')
	$("#modalIniciar").modal('show')
})

$(document).on("click", ".openRegister", function(e){
	$("#modalIniciar").modal('hide')
	$("#modalPassword").modal('hide')
	$("#modalRegistro").modal('show')
})

$(document).on("click", ".openPassword", function(e){
	$("#modalRegistro").modal('hide')
	$("#modalIniciar").modal('hide')
	$("#modalPassword").modal('show')
})

$(".btn-footerfn").on("click", ".verMas", function() {
    if ($(".footerinv").attr("estado") === "cerrado") {
        $(".footerinv").css("display", "").attr("estado", "abierto")
    } else {
        $(".footerinv").css("display", "none").attr("estado", "cerrado")
    }
})

function selectbuscador() {
	$('.js-example-basic-multiple').select2();

	$('.js-example-basic-single').select2({
	  placeholder: 'Select an option'
	});

	// $('.js-example-basic-single').select2();

	$(".js-example-responsive").select2({
	    width: 'resolve' // need to override the changed default
	});
}

function nullOVacio(elemento) {
    return (
        elemento == null ||
        elemento === null ||
        elemento == undefined ||
        elemento === undefined ||
        elemento == "undefined" ||
        elemento === "undefined" ||
        elemento == "" ||
        elemento === "") ? true : false;
}

function tamañosSegunAncho() {
    $(".btnCiudadFn").css("height","32px");
    // cambiarTamañoDetector()
    ntnComp = $(".tamañoinfo").css("height");

    $("#modalCheckout").children().css("top","10px");
    //checkout
    $(".panel-default").css("border-width","0px");
    $(".listaProductos").children(".col-lg-12").css("top","10px");
    $(".tamañoTarjeta").css("margin","0px 0px 5px 0px");
    $(".iubenda-ibadge").css("padding","5px 0px 0px 5px")

    grosorBtnDias = $($(".botonesDias")[0]).css("width");
    if (!nullOVacio(grosorBtnDias)) {
        grosorBtnDias0 = $($(".botonesDias")[0]).children().css("width");
        grosorBtnDias1 = $($(".botonesDias")[1]).children().css("width");
        grosorBtnDias2 = $($(".botonesDias")[2]).children().css("width");
        $(".horaHoy").css("width",grosorBtnDias0);
        $(".horaMañana ").css("width",grosorBtnDias1);
    }

    if (screen.width*1 > 1250*1) {
        console.log("grande")
        //productos relacionados
        $(".txt").css("padding-left","0px");
        $(".mt-product3").addClass("mt-product1").removeClass("mt-product3");
        //menu
        $(".espacioDivision").css("display","none");
        //barra
        $(".barraCiudadesCss").css("display","flex").css("justify-content","center");
        $(".mobilBarra").css("margin-top","0px").css("display","flex").css("align-items","center");
        $(".divbtnCiudadFn").css("display","flex").css("align-items","center");
        $(".selectDiv").css("margin-right","5px");
        $(".cajaIco").children().css("margin","0px");
        //categorias
        $(".banner-area").css("padding-bottom","10px");
        $(".espacioDivision").css("display","none");
        $(".categoriaBanner").css("padding-right","0px").css("padding-left","0px");
        //checkout
        $(".botonUlti1").css("margin-top","15px").css("padding-right","2px")
        $(".botonUlti2").css("margin-top","15px").css("padding-left","2px")
        //modal promo
        $(".promoCssBtn1").children().css("margin-right","10px")
        $(".promoCssBtn2").children().css("margin-left","10px")
        //infoprod
        $("#imgComplementos").children().css("width","480px")
    }else if (screen.width*1 < 1250*1 && screen.width*1 > 1199*1) {
        //menu
        console.log("medio")
        $(".logoCel").css("left","80px").css("top","10px");
        $(".logoCel").children().children().css("width","70px");
        $(".cart").css("margin-top","0px")
        //modal ciudad
        $(".selectorModalCiudad").css("padding-right","20px").css("padding-left","20px")
        //productos relacionados
        $(".mt-product3").addClass("mt-product1").removeClass("mt-product3");
        //categorias
        $(".banner-area").css("padding-bottom","10px")
        $(".categoriaBanner").css("padding-right","0px").css("padding-left","0px");
        //barra
        $(".barraCiudadesCss").css("display","flex").css("justify-content","center");
        $(".mobilBarra").css("margin-top","0px").css("display","flex").css("align-items","center");
        $(".barraCiudadesCss").css("display","flex").css("justify-content","center");
        //checkout
        $(".botonUlti1").css("margin-top","15px").css("padding-right","2px")
        $(".botonUlti2").css("margin-top","15px").css("padding-left","2px")
        //infoprod
        $("#imgComplementos").children().css("width","480px")
    }else if (screen.width*1 < 1199*1  && screen.width*1 > 991*1) {
        console.log("medio-bajo")
        //menu
        $(".logoCel").css("left","80px").css("top","10px");
        $(".logoCel").children().children().css("width","70px");
        $(".cart").css("margin-top","0px")
        // $(".mega-menu").css("margin","0px").css("padding","0px")
        // $("#header").css("margin","0px").css("padding","0px")
        $(".logoCel").css("left","70px")
        //modal ciudad
        $(".selectorModalCiudad").css("padding-right","20px").css("padding-left","20px");
        //productos relacionados
        $(".mt-product3").addClass("mt-product1").removeClass("mt-product3");
        //barra
        $(".mobilBarra").css("margin-top","0px").css("display","flex").css("align-items","center");
        $(".barraCiudadesCss").css("display","flex").css("justify-content","center");
        //categorias
        $(".categoriaBanner").css("padding-right","0px").css("padding-left","0px");
        //checkout
        $(".botonUlti1").css("margin-top","15px");
        if ($(".comleadiciona").length > 3) {
            $($(".comleadiciona")[3]).remove();
            $($(".comleadiciona")[5]).remove();
            $($(".comleadiciona")[4]).remove();
        }
        //infopr
        // $(".imgComplementos").children().css("width","480px")
    }else if (screen.width*1 < 991*1  && screen.width*1 > 725*1) {
        console.log("bajo")
        //menu
        $(".logoCel").css("left","70px").css("top","20px");
        $(".logoCel").children().children().css("width","70px");
        $(".mega-menu").css("margin","0px").css("padding","0px")
        $("#header").css("margin","0px").css("padding","0px")
        $(".logoCel").css("left","70px")
        //modal ciudad
        $(".selectorModalCiudad").css("padding-right","20px").css("padding-left","20px");
        //productos relacionados
        $(".mt-product3").addClass("mt-product1").removeClass("mt-product3");
        $(".tamañoinfo").css("width","200px")
        //barra
        $(".mobilBarra").css("margin-top","0px").css("display","flex").css("align-items","center");
        //categorias
        $(".categoriaBanner").css("padding-right","0px").css("padding-left","0px");
        $(".promoCssBtn1").css("padding","0px")
        $(".promoCssBtn2").css("padding","0px")
        $(".promoCssBtn1").children().css("margin-bottom","3px")
        $(".promoCssBtn2").children().css("margin-top","3px")
        //infoprod
        $(".complementosM2").css("border-radius","5px").css("height","60px");
        $(".textopaCentrar").addClass("text-center")
        // $(".complementosM2").removeClass("referente").css("width","").css("border-radius","5px").css("height","60px");
        //calendario
        $(".modalCalendario").children().css("width"," ")
        $(".modalVaciar").css("width"," ").css("padding-left"," ").css("padding-right"," ")
        $(".pagarOxxxo").css("margin","10px 0px");
        //checkout
        $(".botonUlti1").css("margin-top","15px");
        if ($(".comleadiciona").length > 3) {
            $($(".comleadiciona")[3]).remove();
            $($(".comleadiciona")[5]).remove();
            $($(".comleadiciona")[4]).remove();
        }
    }else if (screen.width*1 < 725*1) {
        console.log("chico")
        $(".banner-area").css("padding-bottom","0px");
        //footter
        $(".related-products").css("padding-bottom","40px");
        $(".product-detail").css("padding","30px 0px");
        $(".f-promo-box").css("padding-bottom","0px");
        $(".footer-holder").css("padding-top","30px");
        //menu
        $(".mega-menu").css("margin","0px").css("padding","0px");
        $("#header").css("margin","0px").css("padding","0px");
        $(".logoCel").css("left","70px").css("top","20px");
        $(".logoCel").children().children().css("width","70px");
        $(".header-top").css("margin","0px");
        $(".settings").css("margin","0px")
        $(".mt-shoplist-header").children(".btn-box").children(".list-inline").addClass("pull-right").css("margin-top","20px")
        //modal ciudad
        $(".selectorModalCiudad").css("padding-right","20px").css("padding-left","20px");
        $(".modal-content").css("width","");
        //info-productos
        $(".cargoEnvio1").parent().children(".price").css("padding","0px");
        //productos
        $(".textopaCentrar").addClass("text-center")
        $(".text-holder").children().css("padding","0px")
        $(".price").addClass(col(12,12,12,12))
        $(".tituloCatSub").parent().css("padding","0px");
        $(".tituloCatSub").parent().parent().css("padding","0px").css("margin-bottom","20px");
        $(".mt-product3").css("margin","0px").css("padding","0px");
        $(".titCat").css("margin","0px").css("padding","0px");
        $(".caption").css("margin","0px");
        $(".price").children().css("font-size","15px");
        $(".fil1").css("margin-bottom","15px");
        $(".caption").children().css("font-size","10px")
        $(".caption").css("display","none");
        $(".tamañoTitulo").removeClass("title");
        $(".tamañoTitulo").parent().children(".price").removeClass("price");
        $(".title").css("font-weight","bold").removeClass();
        $(".mt-product1").addClass("mt-product3").removeClass("mt-product1");
        $(".product-masonry").css("margin-bottom","20px");
        for (var i = 0; i < $(".productosComplemt").length; i++) {
            $($(".productosComplemt")[i]).parent().css("margin","10px 0px 0px 0px");
        }
        //categorias
        $(".categoriaBanner").css("display","none");
        $(".promoCssBtn1").css("padding","0px")
        $(".promoCssBtn2").css("padding","0px")
        $(".promoCssBtn1").children().css("margin-bottom","3px")
        $(".promoCssBtn2").children().css("margin-top","3px")
        //barra
        $(".cajaIco").css("display","none");
        $(".selectDiv").css("margin-bottom","10px");
        $(".textoBarraCss").css("margin-bottom","10px");
        $(".boxLugar").css("padding-bottom","20px");
        $(".divbtnCiudadFn").css("padding-right","0px").css("padding-left","0px");
        $(".barraCiudadesCss").css("margin-right","0").css("margin-left","0");
        $(".tituloCatSub").css("display","none");
        $(".tituloCatSub").parent().children(".col-lg-9").css("border-left-width","0px");
        //prods
        $(".mt-pagination").css("display","none");
        //modal calendario
        $(".btnPedidoFn").css("width","150px")
        $(".modalVaciar").css("width","").css("padding-left","").css("padding-right","")
        $(".modalCalendario").children().css("width"," ")
        $(".calendarioEntrega").css("padding-left","0").css("padding-right","0");
        $(".modal-content").css("width","");
        $(".confirmacionPrograma").css("padding","0px");
        $(".verComlpemetGen").css("padding","0px");
        //complemento
        $(".cuadroHoras").children().addClass(col(12,12,12,12))
        $(".complementosBtns").css("padding","0px")
        $(".complementosM2").removeClass("referente").css("width","").css("border-radius","5px").css("height","").css("border-width","0px").css("height",ntnComp);
        $(".complementosM2").parent().css("padding","0px");
        $(".tamañoinfo ").css("padding","0px");
        $(".price").children().css("font-size","15px");
        //checkout
        // $(".panel-default").removeClass("panel")
        //btn info
        $(".btnInfo").css("font-size","");
        //proceso de pago carrito
        $($(".counter")[0]).parent().css("padding-left","0px");
        $($(".counter")[2]).parent().css("padding-right","0px");
        $(".tablaTitResp").css("font-size","10px");
        $(".tablaTitResp").parent().css("padding","0px");
        $(".tablaTitResp").parent().parent().css("padding","0px").css("padding-left","10px");
        // $(".tablaTitResp").parent().parent().parent().css("padding","0px 0px 0px 5");
        $(".img-holder").removeClass();
        $(".complementosM").html("complementos").css("font-size","8px");
        $(".qyt-form").parent().remove();
        $(".mt-product-table").children().removeClass().addClass("col-xs-12");
        $(".cantTabla").remove();
        $(".mt-detail-sec").css("padding-top","0px").css("padding-bottom","5px");
        $(".mt-product-table").css("padding-top","0px").css("padding-bottom","5px");
        $(".btnCupon").css("width","").css("margin-top","10px");
        $(".confirmarCheckOut").removeClass("process-btn").addClass("col-xs-12");
        $(".abrirCalendario").parent().css("margin-top","20px");
        $(".fechaPactada").children().css("text-align","center");
        $(".process-btn").removeClass("process-btn")
        $(".secondary-font").css("font-size","15px")
        $(".text-white").css("margin-bottom","15px")
        $(".formularioPedido").css("margin-top","15px")
        $(".panel-body").addClass("col-xs-12").css("margin","10px").removeClass("panel-body");
        $("#modalCheckout").children().css("top","10px");
        $(".pagarOxxxo").css("margin","10px 0px");
        for (var i = 0; i < $(".productosComplemt").length; i++) {
            $($(".productosComplemt")[i]).parent().css("margin","10px 0px 0px 0px").css("padding","10px 0px 0px 0px");
        }

        //checkout
        $(".botonUlti1").css("margin-top","15px");
        if ($(".comleadiciona").length > 3) {
            $($(".comleadiciona")[3]).remove();
            $($(".comleadiciona")[5]).remove();
            $($(".comleadiciona")[4]).remove();
        }
    }

    if (screen.width*1 < 700*1) {
        // $(".header-top").css("margin-bottom","16px")
        $(".icon-menu-mobile").parent().css("margin-top","20px")
    }

    //DESAPARECEDOR Y APARECEDOR COMPLEMENTOS
    if ($("#imgComplementos").css("display") === "none") {
        $("#modalComplementos").css("z-index","10000000000000000000")
        $("#ultimaOportunidad").css("z-index","1000000000000000000")
        $("#imgComplementos").css("z-index","1")
        // $(".modal-backdrop").remove();
    }else{
        $("#modalComplementos").css("z-index","1")
        $("#ultimaOportunidad").css("z-index","1")
        $("#imgComplementos").css("z-index","1000000000000000000")
    }

    localStorage.setItem("tamañoPantalla",screen.width);
}

setInterval('tamañosSegunAncho()',1000);