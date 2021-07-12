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
                    {!! modalEntrada("inputtext","nombre","products","Producto","Escribir nombre de categoria",null,null,null) !!}
                    {!! modalEntrada("inputtext","cod_prod","products","Código de producto","Escribir codigo de producto",null,null,null) !!}
                    {!! modalEntrada("textarea","descripcion","products","Descripción","Escribir descripción del producto",null,["obligado"],null) !!}
                    {!! modalEntrada("multibotones","categoria_id","products","Categorias",[[$cats,"c","categoria"]],null,["multiarr"],null) !!}
                    {!! modalEntrada("multibotones","subcategoria_id","products","Subcategoria",[[$subs,"s","subcategoria"]],null,["multiarr"],null) !!}
                    {!! modalEntrada("multipersonalizado","imei","products","IMEI","Escribir lista de numeros de IMEI",null,["multiarr"],null) !!}
                    {!! modalEntrada("selectArr","brand","products","Marca",[[],$marcas],null,null,null) !!}
                    {!! modalEntrada("inputnumber","stock","products","Stock","Escribir el stock del producto",null,null,null) !!}
                    {!! modalEntrada("inputprecio","costo","products","Costo","Escribir el costo para la empresa",null,null,null) !!}
                    {!! modalEntrada("selectArr","tipoprecio","products","Tipo de precio",[[['FIJO','Es un precio fijo'],['CAMBIANTE','El precio puede cambiar']]],null,null,null) !!}
                    {!! modalEntrada("inputprecio","precio","products","Precio","Escribir el precio general",null,null,null) !!}
                    {!! modalEntrada("inputnumber","minimomayor","products","Cantidad mínima por mayor","Escribir el mínimo de productos para considerarse por mayor",null,null,null) !!}
                    {!! modalEntrada("inputprecio","preciomayor","products","Precio por mayor","Escribir el precio por mayor",null,null,null) !!}
                    {!! modalEntrada("selectArr","tipo","products","Tipo de producto",[[['FISICO','Producto físico'],['VIRTUAL','producto virtual o servicio']]],null,null,null) !!}
                    {!! modalEntrada("multimedia","multimedia","products","Multimedia","Escribir nombre de categoria",null,null,null) !!}
                    {!! modalEntrada("imagen","foto","products","Portada",null,null,null,null) !!}
                    {!! botonModal("products") !!}
                </form>
            </div>
        </div>
    </div>
</div>


