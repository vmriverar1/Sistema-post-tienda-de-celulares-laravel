<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('libs/jquery-pjax/jquery.pjax.js') }}" defer></script>
</head>
<body>
    <div class="content">
        <p style="font-weight: 500;">Seleccione la empresa</p>
        <div class="contenedorDiv">
            @foreach ($stores2 as $store)
                <form method="POST" action="{{route('detect-sede')}}" id="formularioSede{{$store->id}}" enctype="multipart/form-data" autocomplete="nope">
                    @csrf
                    <input type="hidden" name="store" value="{{$store->id}}">
                    <div class="selectStore" store="{{$store->id}}">
                        <img src="{{$store->foto}}">
                        <div class="datosEmpresa">
                            <p>{{$store->nombre}}</p>
                            <p>{{$store->direccion}}</p>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
</body>
</html>

<style type="text/css">
    .content{
        display: grid;
        grid-template-columns: 1fr;
        padding: 5% 20%;
        align-items: center;
        justify-items: center;
    }
    .contenedorDiv{
        display: grid;
        grid-template-columns: minmax(150px, 500px) minmax(150px, 500px);
        /*grid-template-columns: minmax(250px, 500px);*/
        column-gap: 10px;
        text-align: center;
    }
    .selectStore{
        display: grid;
        grid-template-columns: 40% 60%;
        background-color: #FCF3CF;
        margin: 5px 0px;
        padding: 20px;
        cursor: pointer;
        text-align: left;
    }
    .datosEmpresa{
        padding: 0% 15%;
    }
    img{
        width: 100%;
    }
    P{
        font-family: 'Montserrat', sans-serif;
    }

</style>

<script type="text/javascript">
    $(document).on("click", ".selectStore", function(e){
        e.preventDefault();
        id = $(this).attr("store");
        form = $("#formularioSede"+id);
        $.ajax({
            method: "POST",
            url: "{{route('detect-sede')}}",
            data: form.serialize(),
            processData: false,
            success: function (data) {
                if (data == "1") {
                    location.href ="{{route('welcome')}}";
                }
            }
        })
    })
</script>
