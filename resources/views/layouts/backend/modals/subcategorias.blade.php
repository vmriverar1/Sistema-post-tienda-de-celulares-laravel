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

                    {!! modalEntrada("inputtext","nombre","subcategories","Subcategoria","Escribir nombre de categoria",null,null,null) !!}
                    {!! modalEntrada("multibotones","categoria_id","subcategories","Categorias",[[$cats,"c","categoria"]],null,["multiarr"],null) !!}
                    {!! modalEntrada("inputtext","titular","subcategories","Titular","Escribir titular de categoria",null,null,null) !!}
                    {!! modalEntrada("textarea","descripcion","subcategories","Descripción","Escribir descripción de la categoria",null,["obligado"],null) !!}
                    {!! botonModal("subcategories") !!}

                </form>
            </div>
        </div>
    </div>
</div>