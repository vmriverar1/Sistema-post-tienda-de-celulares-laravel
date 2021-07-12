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

                    {!! modalEntrada("inputtext","nombre","brands","Marca","Escribir nombre de la marca",null,null,null) !!}
                    {!! modalEntrada("imagen","foto","brands","Logo",null,null,null,null) !!}
                    {!! botonModal("brands") !!}

                </form>
            </div>
        </div>
    </div>
</div>