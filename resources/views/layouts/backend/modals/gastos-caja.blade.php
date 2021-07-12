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

                    {!! modalEntrada("selectArr","tipo","spends","Tipo de gasto",[[['GASTOS','Gasto de la tienda'],['ADELANTOS','Adelanto a personal'],['PAGOS','Pago de la tienda']]],null,null,null) !!}
                    {!! modalEntrada("selectArr","salida","spends","Salida del dinero",[[['CAJA','Se pagará con dinero de caja'],['BANCO','Se pagara con dinero en banco']]],null,null,null) !!}
                    {!! modalEntrada("textarea","descripcion","spends","Razón","Escribir la razón del gasto",null,null,null) !!}
                    {!! modalEntrada("inputprecio","total","spends","Gasto","Escribir el gasto total",null,null,null) !!}
                    <div class="form-group row">
                        <div class="col-lg-12 ">
                            <button class="btn primary btn-lg p-x-md btn-block guardarGasto" tabla="spends">Guardar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>