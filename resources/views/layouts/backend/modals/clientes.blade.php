<div class="modal fade" id="modal-{{ $modal }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header _600">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                {{$title}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formulario{{ $modal }}" method="POST" action="{{ $url }}" enctype="multipart/form-data" autocomplete="nope">
                    @csrf

                    {!! modalEntrada("inputtext","nombre","clients","Nombre","Escribir nombre de cliente",null,null,null) !!}
                    {!! modalEntrada("email","email","clients","Email","Escribir email del cliente",null,null,null) !!}
                    {!! modalEntrada("inputnumber","dni","clients","DNI","Escribir dni del cliente",null,null,null) !!}
                    {!! modalEntrada("inputtext","direccion","clients","Dirección","Escribir dirección del usuario",null,null,null) !!}
                    {!! modalEntrada("inputnumber","celular","clients","Celular","Escribir celular del usuario",null,null,null) !!}
                    {!! modalEntrada("imagen","foto","clients","Fotografia","Escribir contraseña",null,["obligado"],null) !!}
                    {!! botonModal("clients") !!}

                </form>
            </div>
        </div>
    </div>
</div>