@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">LISTADO DE PRODUCTOS</h3>
    </div>
    <div class="row">
        <button type="button" class="btn btn-primary offset-sm-6" data-toggle="modal" data-target="#modal-default">NUEVO</button>
    </div>

    <!--MODAL REGISTRAR NUEVO PRODUCTO -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">REGISTRO DE PRODUCTOS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <form role="form">
                            <div class="card-body">
								<div class="form-group">
                                    <label for="txt_user_id">Codigo Usuario</label>                            
                                    <input type="text" class="form-control" id="txt_user_id" value="{{Auth::user()->id}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="txt_codigo">Codigo Producto</label>
                                    <input type="text" class="form-control" id="txt_codigo" placeholder="200">
                                </div>
                                <div class="form-group">
                                    <label for="txt_nombre">Nombre</label>
                                    <input type="text" class="form-control" id="txt_nombre" placeholder="Fideo">
                                </div>
                                <div class="form-group">
                                    <label for="txt_marca">Marca</label>
                                    <input type="text" class="form-control" id="txt_marca" placeholder="Don Vittorio">
                                </div>
								<div class="form-group">
                                    <label for="txt_modelo">Modelo</label>
                                    <input type="text" class="form-control" id="txt_modelo" placeholder="Largo">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="btn_cerrar_p">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn_guardar" onclick="guardar();">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!--FIN DE MODAL REGISTRAR NUEVO PRODUCTO -->

    <!--MODAL ACTUALIZAR DATOS PRODUCTO -->
    <div class="modal fade" id="modal-success">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">ACTUALIZAR DATOS PRODUCTOS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <form role="formu">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="txt_idu">ID</label>                            
                                    <input type="text" class="form-control" id="txt_idu" readonly>
                                </div>
								<div class="form-group">
                                    <label for="txt_user_idu">Codigo Usuario</label>                            
                                    <input type="text" class="form-control" id="txt_user_idu" value="{{Auth::user()->id}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="txt_codigou">Codigo</label>                            
                                    <input type="text" class="form-control" id="txt_codigou">
                                </div>
                                <div class="form-group">
                                    <label for="txt_nombreu">Nombre</label>                            
                                    <input type="text" class="form-control" id="txt_nombreu">
                                </div>
                                <div class="form-group">
                                    <label for="txt_marcau">Marca</label>                            
                                    <input type="text" class="form-control" id="txt_marcau">
                                </div>
								<div class="form-group">
                                    <label for="txt_modelou">Modelo</label>                            
                                    <input type="text" class="form-control" id="txt_modelou">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="pp">Cerrar</button>
                    <button type="button" class="btn btn-success" id="btn_actualizar" onclick="actualizar();">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    <!--FIN MODAL ACTUALIZAR DATOS PRODUCTO -->

 <!--HIPERVINCULO OCULTO PARA ABRIR EL MODAL ACTUALIZAR -->
 <a class="modal-with-form"  data-toggle="modal" data-target="#modal-success" id="edit" style="display: none">Editar Módulo o Sección</a>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
					<th>CODIGO USUARIO</th>
                    <th>CODIGO PRODUCTO</th>
                    <th>NOMBRE</th>
                    <th>MARCA</th>
					<th>MODELO</th>
                    <th>ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($producto as $d)
                <tr id="tr_delete_{{$d->id}}">
                    <td>{{$d->id}}</td>
					<td>{{$d->user_id}}</td>
                    <td>{{$d->codigo}}</td>
                    <td>{{$d->nombre}}</td>
                    <td>{{$d->marca}}</td>
					<td>{{$d->modelo}}</td>
                    <td class="row">
                        <button type="button" class="btn btn-success" id="btn_edit" onclick="editar('{{$d->id}}');">ACTUALIZAR</button>&nbsp;
                        <button type="button" class="btn btn-danger" onclick="eliminar('{{$d->id}}');">ELIMINAR</button>
                    </td>
                </tr>
                @endforeach    
            </tbody>       
        </table>
    </div>
</div>

@endsection

@section('script')
<script>
    //INICIAR EL DATATABLE
    $(function(){
      $("#example1").DataTable();   
    });

    //GUARDAR
	function guardar(){
        $.ajax({
            url: "{{route('producto.store')}}",
            type:"POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: $("#txt_id").val(),
				user_id: $("#txt_user_id").val(),
				codigo: $("#txt_codigo").val(),
                nombre: $("#txt_nombre").val(),
                marca: $("#txt_marca").val(),
				modelo: $("#txt_modelo").val()
            },
            success: function(result){
                $("#example1 tbody tr").remove()
                $.each(result, function(index, valor){
                    $("#example1 tbody").append(
                        "<tr>"+
                            "<td>" + valor.id + "</td>" +
							"<td>" + valor.user_id + "</td>" +
                            "<td>" + valor.codigo + "</td>" +
                            "<td>" + valor.nombre + "</td>" +
                            "<td>" + valor.marca + "</td>"+
							"<td>" + valor.modelo + "</td>"+
                            "<td class='row'>" +
                                '<button type="button" class="btn btn-success" id="btn_edit" onclick="editar(\''+valor.id+'\');">ACTUALIZAR</button>&nbsp; '+                  
                                '<button type="button" class="btn btn-danger" id="btn_delete_'+valor.id+'" onclick="eliminar(\''+valor.id+'\');">ELIMINAR</button>'
                            + "</td>"
                        +"</tr>"
                    );
                });
            //id del boton para pasar algo
            $("#btn_cerrar_p").click();
            },
            error: function(result){
                alert("Algo esta fallando");
            }
        });
		$('.modal').hide();
	};
	
    //EDITAR -> PASAR DATOS AL MODAL
    function editar(id){
        $.ajax({
            url: "producto/"+id+"/edit",
            type:"GET",
            success: function(result) {               
                $("#txt_idu").val(result.id);
				$("#txt_user_idu").val(result.user_id);
                $("#txt_codigou").val(result.codigo);
                $("#txt_nombreu").val(result.nombre);
                $("#txt_marcau").val(result.marca);
				$("#txt_modelou").val(result.modelo);
            },
            error: function(result){
                alert("Algo esta fallando");
            }
        });
        $("#edit").click();
    }

    //BOTON ACTUALIZAR
	function actualizar(){
    var id=$("#txt_idu").val();
        $.ajax({
            url: "producto/"+id,
            type:"PATCH",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                user_id: $("#txt_user_idu").val(),
				codigo: $("#txt_codigou").val(),
                nombre: $("#txt_nombreu").val(),
                marca: $("#txt_marcau").val(),
				modelo: $("#txt_modelou").val()
            },
            success: function(result) {
            $("#example1 tbody tr").remove()
                $.each(result, function(index, valor){
                    $("#example1 tbody").append(
                        "<tr>"+
                            "<td>" + valor.id + "</td>" +
							"<td>" + valor.user_id + "</td>" +
                            "<td>" + valor.codigo + "</td>" +
                            "<td>" + valor.nombre + "</td>" +
                            "<td>" + valor.marca + "</td>"+
							"<td>" + valor.modelo + "</td>"+
                            "<td class='row'>" +
                                '<button type="button" class="btn btn-success" id="btn_edit" onclick="editar(\''+valor.id+'\');">ACTUALIZAR</button>&nbsp; '+ 
                                '<button type="button" class="btn btn-danger" id="btn_delete_'+valor.id+'" onclick="eliminar(\''+valor.id+ '\');">ELIMINAR</button>'
                            + "</td>"
                        +"</tr>"
                    );
                });
            },
            error: function(result){
                alert(result);
            }
        });
        $("#pp").click();
	};

    //BOTON ELIMINAR
    function eliminar(id){
        $.ajax({
            url: "producto/"+id,
            type:'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result){
               if(result){
				$("#tr_delete_"+id).remove();
				   window.location.replace("");
               }
            },
            error: function(result){
                alert("Algo esta fallando");
            }
        });
    }
</script>
@endsection