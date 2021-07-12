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

                    {!! modalEntrada("selectArr","sede","cashboxes","Sede",[[],$stores],null,null,null) !!}
                    {!! modalEntrada("selectArr","responsable","cashboxes","Responsable",[[],$usuarios],null,null,null) !!}
                    {!! botonModal("cashboxes") !!}

                </form>
            </div>
        </div>
    </div>
</div>