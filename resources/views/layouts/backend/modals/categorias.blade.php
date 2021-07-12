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

                    {!! modalEntrada("inputtext","nombre","categories","Categoria","Escribir nombre de categoria",null,null,null) !!}
                    {!! modalEntrada("inputtext","titular","categories","Titular","Escribir titular de categoria",null,null,null) !!}
                    {!! modalEntrada("textarea","descripcion","categories","Descripción","Escribir descripción de la categoria",null,["obligado"],null) !!}
                    {!! modalEntrada("imagen","foto","categories","Portada",null,null,null,null) !!}
                    {!! botonModal("categories") !!}

                </form>
            </div>
        </div>
    </div>
</div>