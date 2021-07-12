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

                    {!! modalEntrada("inputtext","name","users","Nombre","Escribir nombre de usuario",null,null,null) !!}
                    {!! modalEntrada("email","email","users","Email","Escribir email del usuario",null,null,null) !!}
                    {!! modalEntrada("pass","password","users","Contraseña","Escribir contraseña",null,null,null) !!}
                    {!! modalEntrada("selectArr","role","users","Rol",[[['USUARIO','Empleado'],['ADMIN','Dueño de la empresa'],['ENCARGADO','Sub-administrador'],['CAJA','Encargado de caja']]],null,null,null) !!}
                    {!! modalEntrada("multibotones","stores","users","Sedes",[[$tiendas,"store","sede"]],null,["multiarr"],null) !!}
                    {!! modalEntrada("inputtext","direccion","users","Dirección","Escribir dirección del usuario",null,null,null) !!}
                    {!! modalEntrada("inputnumber","celular","users","Celular","Escribir celular del usuario",null,null,null) !!}
                    {!! modalEntrada("imagen","foto","users","Fotografia","Escribir contraseña",null,["obligado"],null) !!}
                    {!! botonModal("users") !!}

                </form>
            </div>
        </div>
    </div>
</div>