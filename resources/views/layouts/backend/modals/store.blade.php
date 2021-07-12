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
                <form class="form-horizontal" id="formulario{{ $modal }}" method="POST" action="{{ $url }}" enctype="multipart/form-data">
                    @csrf

                    {!! modalEntrada("inputtext","nombre","store","Nombre","Escribir nombre de la sede",null,null,null) !!}
                    {!! modalEntrada("inputtext","direccion","store","Dirección","Escribir dirección de la sede",null,null,null) !!}
                    {!! modalEntrada("inputnumber","ruc","store","RUC","Escribir número de RUC",null,null,null) !!}
                    {!! modalEntrada("inputnumber","celular","store","Celular","Escribir celular de la sede",null,null,null) !!}
                    {!! modalEntrada("selectArr","administrador","store","Administrador",[[],$usuarios],null,null,null) !!}
                    {!! modalEntrada("imagen","foto","store","Foto",null,null,null,null) !!}
                    {!! botonModal("store") !!}

                </form>
            </div>
        </div>
    </div>
</div>