@extends('layouts.backend.plantilla')

@section('contenido1')

<!-- aquiva el script de tu llave de google --!>
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<!-- bootstrap color picker https://farbelous.github.io/bootstrap-colorpicker/v2/-->
<script src="{{asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>

<style type="text/css">
    .pac-container{
        z-index: 100000000;
    }
</style>

<div class="divTiendas" style="display:none">
  {{$strcoordenadas}}
</div>



<script>
    navigator.geolocation.getCurrentPosition(mostrar, errores);

    function mostrar(posicion){

            console.log("a");

            var latlng = new google.maps.LatLng(posicion.coords.latitude, posicion.coords.longitude);
            var radio = document.getElementById("radioGoogle");
            var mapOptions = {
              zoom: 10,
              center: latlng,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            console.log("b");

            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            latalls = JSON.parse($(".divTiendas").html());
            for(let latu of latalls){
              var cord0 = latu.slice(1).slice(0,-1);
              var cord0 = "["+cord0+"]";
              var cord0 = JSON.parse(cord0);

              const mark = new google.maps.Marker({
                  icon: {
                      url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                  },
                  position:{ lat: cord0[0], lng: cord0[1] },
                  map: map
              });
            }

            const marcador = new google.maps.Marker({
              draggable: true,
              animation: google.maps.Animation.DROP,
              position: latlng,
              map: map
            });

            marcador.addListener('click', toggleBounce);

            var circle = new google.maps.Circle({
              map: map,
              radius: 1609,    // 10 miles in metres
              fillColor: '#AA0000'
            });
            circle.bindTo('center', marcador, 'position');

            var autoc = document.getElementById('autocompletado');
            const search  = new google.maps.places.Autocomplete(autoc);
            search.bindTo('bounds',map);

            radio.addEventListener('change', (event) => {
              rad = radio.value;
              circle.setOptions({radius:rad * 1000});
            });

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
    }

    function toggleBounce() {
      if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
      } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
      }
    }

    function errores(error){
              var mapOptions = {
                zoom: 8,
                center: { lat: 19.3905, lng: -99.423 }
              }

              map = new google.maps.Map(document.getElementById('map'), mapOptions);
              var radio = document.getElementById("radioGoogle");

              const marcador = new google.maps.Marker({
                draggable: true,
                position:{ lat: 19.3905, lng: -99.423 },
                map: map
              });

              var circle = new google.maps.Circle({
                map: map,
                radius: 16093,    // 10 miles in metres
                fillColor: '#AA0000'
              });
              circle.bindTo('center', marcador, 'position');

              var autoc = document.getElementById('autocompletado');
              const search  = new google.maps.places.Autocomplete(autoc);
              search.bindTo('bounds',map);

              radio.addEventListener('change', (event) => {
                rad = radio.value;
                circle.setOptions({radius:rad * 1000});
              });

              google.maps.event.addListener(marcador, 'dragend', function (event) {
                  var data = document.getElementById('dataMapa');
                  data.value = "("+this.getPosition().lat()+","+this.getPosition().lng()+")";
              });

              search.addListener('place_changed',function(){

                marcador.setVisible(false);

                var place  = search.getPlace();
                if(!place.geometry.viewport){
                  window.alert('No se encontro ciudad');
                }

                if(place.geometry.viewport){
                  map.fitBounds(place.geometry.viewport)
                }else{
                  map.fitBounds(place.geometry.location)
                  map.setZoom(18);
                }

                var data = document.getElementById('dataMapa');
                data.value = place.geometry.location;

                marcador.setPosition(place.geometry.location);
                marcador.setVisible(true);
              });
    }

</script>


<div class="padding">


    <div class="box">
        <div class="box-header">
            <div class="navbar no-radius box-shadow-z1 m-t">
                {!! btnModal("ciudades",null,null,null) !!}
            </div>
        </div>
        @include('layouts.backend.partes.tabla',[
            'arr' => $ciudades,
            'tabla' => "ciudades",
            'editar' => json_encode(["inputtext","selectArr","mapa","radio"]),
            'exep' => "ninguna",
            'titulos' => ["Ciudad","Estado","Tarifas"],
            'columnas' =>["nombre","estado_id","tarifa"],
            'tipo' =>["normal","normal","multibotonessimple"]])
        {!! $ciudades->appends(request()->query())->links('layouts.paginador') !!}
    </div>
</div>
@include('layouts.backend.modals.ciudades',['title' => 'Agregar Estado','url' => route('ciudades.store'),'modal' => 'ciudades','estados'=>$estados,])
@endsection
