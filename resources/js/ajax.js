function traerDato(objs,id,tabla,columnas,especial,labels) {
    route = "/ajax/traer/"+id+"/"+tabla;
    labels = JSON.parse(labels);
    limpiarModal(tabla);
    $.get(route, function(data){
        for (let columna of columnas) {
            for (var i = 0; i < objs.length; i++) {
                atributo = $(objs[i]).attr("columna");
                if (atributo === columna) {
                    console.log({columna});
                    var dato = data[columna];
                    console.log({dato});
                    console.log(labels[i]);
                    if (labels[i] === "imagen") {
                        console.log("llego");
                        $(".previsualizarfn").attr("src",dato);
                        console.log("si");
                    }else if (labels[i] === "pass") {
                    }else if (labels[i] === "multimedia") {
                        $(".antiguasMultimedia").val(data["multimedia"]);
                        imagenesMultimedia = JSON.parse(data["multimedia"]);
                        $(".editarMultimedia").html("")
                        for(var z = 0; z < imagenesMultimedia.length; z++){
                            $(".editarMultimedia").append(
                                  '<div class="col-md-3">'+
                                    '<div class="thumbnail text-center">'+
                                      '<img class="imagenesRestantes" src="'+imagenesMultimedia[z]+'" style="width:100%">'+
                                      '<div class="removerImagen" style="cursor:pointer">Remove file</div>'+
                                    '</div>'+
                                  '</div>'
                            );
                        }
                        imagen = data["foto"];
                        $(".previsualizarfn").attr("src",imagen);
                    }else if (labels[i] === "radio") {
                        $(".btnsTarifasModal").html("");
                        distancias = JSON.parse(data["tarifa"]);
                        for (var f = distancias.length - 1; f >= 0; f--) {
                            d = distancias[f];
                            $(".btnsTarifasModal").append('<a class="btn info btn-block radioData" distancia="'+d["distancia"]+'" precio="'+d["precio"]+'" style="color:white">$'+d["precio"]+' MXN HASTA LOS '+d["distancia"]+'Km</a>');
                        }
                    }else if (labels[i] === "mapa") {
                        $(objs[i]).val(dato);
                        $(".coordenadas").val(data["coordenadas"]);
                        coordenadas = data["coordenadas"];
                        cord = coordenadas.slice(1).slice(0,-1);
                        cord = "["+cord+"]";
                        cord = JSON.parse(cord);
                        radio = document.getElementById("radioGoogle");

                        var mapOptions = {
                            zoom: 10,
                            center: { lat: cord[0], lng: cord[1] }
                        }

                        map = new google.maps.Map(document.getElementById('map'), mapOptions);
                        // var radio = document.getElementById("radioGoogle");

                        // latalls = JSON.parse($(".divTiendas").html());
                        // for(let latu of latalls){
                        //     console.log(latu);
                        //     var cord0 = latu.slice(1).slice(0,-1);
                        //     var cord0 = "["+cord0+"]";
                        //     var cord0 = JSON.parse(cord0);
                        //     console.log(cord0);

                        //     const mark = new google.maps.Marker({
                        //         icon: {
                        //             url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                        //         },
                        //         position:{ lat: cord0[0], lng: cord0[1] },
                        //         map: map
                        //     });
                        // }

                        const marcador = new google.maps.Marker({
                            draggable: true,
                            position:{ lat: cord[0], lng: cord[1] },
                            map: map
                        });

                        var autoc = document.getElementById('autocompletado');
                        const search  = new google.maps.places.Autocomplete(autoc);
                        search.bindTo('bounds',map);

                        google.maps.event.addListener(marcador, 'dragend', function (event) {
                            var data = document.getElementById('dataMapa');
                            data.value = "("+this.getPosition().lat()+","+this.getPosition().lng()+")";
                        });

                        search.addListener('place_changed',function(){

                            //informacion.close();
                            marcador.setVisible(false);

                            var place  = search.getPlace();
                            if(!place.geometry.viewport){
                                window.alert('No se encontro ciudad');
                            }

                            if(place.geometry.viewport){
                                map.fitBounds(place.geometry.viewport)
                            }else{
                                map.fitBounds(place.geometry.location)
                                map.setZoom(10);
                            }

                            var data = document.getElementById('dataMapa');
                            data.value = place.geometry.location;

                            marcador.setPosition(place.geometry.location);
                            marcador.setVisible(true);
                        });
                    }else if (labels[i] === "multibotones-simple") {
                        datoarr = JSON.parse(dato);
                        $(objs[i]).val(dato);
                        multibtns = $(objs[i]).parent().children(".objetivoarrbtns");
                        $(multibtns).html("");
                        for (var a = 0; a < datoarr.length; a++) {
                            $(multibtns).append('<a class="btn btn-sm accent itemSimple" style="color:white">'+datoarr[a]+'</a>');
                        }
                    }else if (labels[i] === "multibotones") {
                        $(objs[i]).val(dato);
                        datoarr = JSON.parse(dato);
                        multibtns = $(objs[i]).parent().children(".objetivoarrbtns");
                        select = $(".creadorArrbtns");
                        arrData =[];
                        //recoilectar datos
                        for (var a = select.length - 1; a >= 0; a--) {
                            bd = [];
                            selectfn = select[a];
                            bd["nombre"] = $(selectfn).attr("tipo");
                            options = $(selectfn).children()
                            for (var k = options.length - 1; k >= 0; k--) {
                                bd[$(options[k]).val()] = $(options[k]).html();
                            }
                            arrData.push(bd);
                        }

                        //detectar datos
                        $(multibtns).html("");
                        for (var g = datoarr.length - 1; g >= 0; g--) {
                            elem = datoarr[g];
                            id = elem["id"];
                            tipo = elem["tipo"];
                            for (var a = arrData.length - 1; a >= 0; a--) {
                                if (arrData[a]["nombre"] == tipo) {
                                    $(multibtns).append('<button id="'+id+'" tipo="'+tipo+'" class="btn btn-sm accent">'+arrData[a][id]+'</button>');
                                    a = 0;
                                }
                            }
                        }
                    }else{
                        $(objs[i]).val(dato);
                    }
                }
            }
        }
    });
}

function traerDatos(data,proceso,obj) {
    route = "/ajax/traer/"+data+"/"+proceso;
    $.get(route, function(data){
        console.log({proceso});
        console.log(data);
        if (proceso == "productos-caja") {
            if (data.length == 1 && $(".dniBuscarProd").val() == data[0]["cod_prod"]) {
                $(".dniBuscarProd").val("");
                produc = data[0];
                precio = produc["precio"];
                costo = produc["costo"];
                nombre = produc["nombre"];
                stock = produc["stock"];
                imagen = produc["imagen"];
                imei = produc["imei"];
                idp = produc["id"];
                max = produc["max"];
                tipoprecio = produc["tipoprecio"];
                minimomayor = produc["minimomayor"]*1;
                preciomayor = produc["preciomayor"];
                //buscamos si esta esta en la lista
                valor = busqobj($(".sumaCaja"),["idProd"],[idp],"cantidad");

                if (valor[0]*1 > 0 && valor[0]*1<stock) {
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
                }else if(valor == false && stock*1  > 0){
                    if (tipoprecio == "CAMBIANTE") {
                        $("#modal-preciovariable").modal('show')
                        $(".precioCambiante").attr("placeholder","Precio referencial S/."+precio);
                        $(".cambiarPrecioProducto").attr("idProd",idp);
                    }
                    elemento = constructorListaCaja(idp,nombre,stock,precio,tipoprecio,minimomayor,preciomayor,imei,imagen);
                    $(".listaVentas").append(elemento);
                }
                sumaTotal()
                 $(".dniBuscarProd").focus();
            }else{
                constructorCajaProd(obj,data);
            }
        }else if (proceso == "categoria-cobro") {
            option = "<option value='0'>Seleccionar opción</option>";
            for (var i = 0; i < data.length; i++) {
                option = option + "<option value='"+data[i]["id"]+"'>"+data[i]["nombre"]+"</option>"
            }
            $(obj).html(option);
        }else if (proceso == "subcategoria-cobro") {
            option = "<option value='0'>Seleccionar opción</option>";
            for (var i = 0; i < data.length; i++) {
                option = option + "<option value='"+data[i]["id"]+"'>"+data[i]["nombre"]+"</option>"
            }
            $(obj).html(option);
        }else if (proceso == "marca-cobro") {
            option = "<option value='0'>Seleccionar opción</option>";
            for (var i = 0; i < data.length; i++) {
                option = option + "<option value='"+data[i]["id"]+"'>"+data[i]["nombre"]+"</option>"
            }
            $(obj).html(option);

        }else if (proceso == "productos-cobro") {
            option = "";
            for (var i = 0; i < data.length; i++) {
                option = option + "<a class='btn btn-fw primary agregarProductoCobro' idProd='"+data[i]["id"]+"' nombre='"+data[i]["nombre"]+"' costo='"+data[i]["costo"]+"' foto='"+data[i]["foto"]+"' style='margin-right:10px'>"+data[i]["nombre"]+"</a>"
            }
            $(obj).html(option);
            $(".limpiarProdsCompra").fadeIn(100);
        }else if (proceso == "ventas-caja") {
            constructorCajaVent(obj,data);
        }else if(proceso == "caja-chica"){
            ingreso = data["ingreso"]*1;
            egreso = data["egreso"]*1;
            saldo = data["saldo"]*1;
            total = ingreso + saldo - egreso*1;
            $(".datoIngreso").html("S/."+ingreso.toFixed(2))
            $(".datoEgreso").html("S/."+egreso.toFixed(2))
            $(".datoSaldo").html("S/."+saldo.toFixed(2))
            $(".datoTotal").html("S/."+total.toFixed(2))
        }else if (proceso == "gastos-reportes") {
            console.log(data);
            $(obj).html("")
            for (var i = 0; i < data.length; i++) {
                arr = data[i];
                subtotal = arr["subtotal"]*1;
                total = arr["total"]*1;
                boton = (arr["boton"])? '<a class="dropdown-item eliminar danger" tabla="cashbox" iditem="'+arr["id"]+'"><i class="fa fa-trash"></i>Eliminar</a>':'<div class="dataCaja"></div>';
                datahtml = (arr["tipo"] == "PRODUCTOS") ? arr["productos"] : arr["descripcion"];
                // datahtml =  arr["descripcion"];
                    $(obj).append('<div class="columnaData2 interiorData">'+
                        '<div class="data">'+arr["nombre"]+'</div>'+
                        '<div class="data">'+arr["tipo"]+'</div>'+
                        '<div class="data">'+datahtml+'</div>'+
                        '<div class="data">'+total.toFixed(2)+'</div>'+
                        '<div class="data">'+arr["fecha"]+
                        '</div>'+boton+'</div>');

            }
        }else if (proceso == "ventas-reportes") {
            $(obj).html("")
            for (var i = 0; i < data.length; i++) {
                arr = data[i];
                descuento = arr["descuento"]*1;
                subtotal = arr["subtotal"]*1;
                total = arr["total"]*1;
                pedido = JSON.parse(arr["pedido"]);
                pedidohtmnl = "";
                for (var a = 0; a < pedido.length; a++) {
                     pedidohtmnl = pedidohtmnl + pedido[a]["nombre"]+'<br>';
                }
                boton = (arr["boton"])? '<a class="dropdown-item eliminar danger" tabla="cashbox" iditem="'+arr["id"]+'"><i class="fa fa-trash"></i>Eliminar</a>':'<div class="dataCaja"></div>';

                    $(obj).append('<div class="columnaData interiorData">'+
                        '<div class="data">'+arr["nombre"]+'</div>'+
                        '<div class="data">'+arr["cliente"]+'</div>'+
                        '<div class="data">'+arr["nota"]+'</div>'+
                        '<div class="data">'+pedidohtmnl+'</div>'+
                        '<div class="data">'+subtotal.toFixed(2)+'</div>'+
                        '<div class="data">'+descuento.toFixed(2)+'</div>'+
                        '<div class="data">'+total.toFixed(2)+'</div>'+boton+'</div>');

            }
        }else if (proceso == "cajas-chicas-reportes") {
            $(".bodyCaja").html("")
            for (var i = 0; i < data.length; i++) {
                arr = data[i];
                ingreso = arr["ingreso"]*1;
                egreso = arr["egreso"]*1;
                saldo = arr["saldo"]*1;
                total = arr["total"]*1;
                boton = (arr["boton"])? '<a class="dropdown-item eliminar danger" tabla="cashbox" iditem="'+arr["id"]+'"><i class="fa fa-trash"></i>Eliminar</a>':'<div class="dataCaja"></div>';
                if ($(".tiendaActual").val() == arr["store"]) {
                    $(".dataBox1").append('<div class="columCaja">'+
                        '<div class="dataCaja">'+ingreso.toFixed(2)+'</div>'+
                        '<div class="dataCaja">'+egreso.toFixed(2)+'</div>'+
                        '<div class="dataCaja">'+saldo.toFixed(2)+'</div>'+
                        '<div class="dataCaja">'+total.toFixed(2)+'</div>'+
                        '<div class="dataCaja">'+arr["nombre"]+'</div>'+
                        '<div class="dataCaja">'+arr["fecha"]+'</div>'+boton+'</div>');
                }
                $(".dataBox2").append('<div class="columCaja2">'+
                    '<div class="dataCaja">'+arr["tienda"]+'</div>'+
                    '<div class="dataCaja">'+ingreso.toFixed(2)+'</div>'+
                    '<div class="dataCaja">'+egreso.toFixed(2)+'</div>'+
                    '<div class="dataCaja">'+saldo.toFixed(2)+'</div>'+
                    '<div class="dataCaja">'+total.toFixed(2)+'</div>'+
                    '<div class="dataCaja">'+arr["nombre"]+'</div>'+
                    '<div class="dataCaja">'+arr["fecha"]+'</div>'+boton+'</div>');

            }
        }
    });
}

function editarDato(ruta,form,modalfn) {

    var formData = new FormData();
    if (detectarImg()) {
        formData.append('photo', $('.nuevaFoto')[0].files[0]);
    }

    if(arrayFilesMultimedia.length > 0){
        uui = arrayFilesMultimedia[0]["upload"]["uuid"];
        formData.append("uui", uui);
        formData.append('multi', arrayFilesMultimedia.length);
        formData.append("filefn", arrayFilesMultimedia);
        for(var i = 0; i < arrayFilesMultimedia.length; i++){
            formData.append("file"+i, arrayFilesMultimedia[i]);
        }
    }

    $.ajax({
        url: ruta + '?' + form.serialize(),
        method: form.attr('method'),
        data: formData,
        processData: false,
        contentType: false
    }).done(function (data) {
        console.log(data);
        if (data != "1") {
            $(".cambiar").removeAttr("disabled");
        }else{
            location.reload();
        }

    }).fail(function () {
        console.log("no");
        $(".cambiar").removeAttr("disabled");
        if (detectarImg()) {
            alert('La imagen subida no tiene un formato correcto');
        }
    });
}

function eliminarDato(id,tabla) {
    var route = "/ajax/destroy/"+id+"/"+tabla;
    $("#modal-eliminar").modal('show')
    $(document).on("click", ".eliminarSiGracias", function(e){
        $.get(route, function(data){
            if (data === "1") {
                location.reload();
            }
        })
    })
    $(document).on("click", ".eliminarNoGracias", function(e){
        $("#modal-eliminar").modal('hide');
        return;
    })
}

function crearDato(ruta,form,modalfn) {

    var formData = new FormData();
    if (detectarImg()) {
        formData.append('photo', $('.nuevaFoto')[0].files[0]);
    }

    if(arrayFilesMultimedia.length > 0){
        uui = arrayFilesMultimedia[0]["upload"]["uuid"];
        formData.append("uui", uui);
        formData.append('multi', arrayFilesMultimedia.length);
        formData.append("filefn", arrayFilesMultimedia);
        for(var i = 0; i < arrayFilesMultimedia.length; i++){
            formData.append("file"+i, arrayFilesMultimedia[i]);
        }
    }

    $.ajax({
        url: form.attr('action') + '?' + form.serialize(),
        method: form.attr('method'),
        data: formData,
        processData: false,
        contentType: false
    }).done(function (data) {
        console.log(data);
        if (data != "1") {
            $(".guardar").removeAttr("disabled");
        }else{
            location.reload();
        }
    }).fail(function () {
        console.log("no");
        $(".guardar").removeAttr("disabled");
        if (detectarImg()) {
            alert('La imagen subida no tiene un formato correcto');
        }
    });
}


// function subirFoto(file,tabla,id) {
//     var formData = new FormData();
//     formData.append('photo', file);
//     $.ajax({
//         url: '/ajax/foto/'+id+'/'+tabla,
//         method: "POST",
//         data: formData,
//         processData: false,
//         contentType: false
//     }).done(function (data) {
//         console.log(data);
//         console.log("subida");
//     }).fail(function () {
//         console.log("falló")
//     });
// }