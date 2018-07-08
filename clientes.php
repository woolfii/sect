<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>SECT registros</title>
	<link rel="stylesheet" href="dtcss/bootstrap.min.css">
	<link rel="stylesheet" href="dtcss/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="dtcss/estilos.css">
	<!-- Buttons DataTables -->
	<link rel="stylesheet" href="dtcss/buttons.bootstrap.min.css">
	<link rel="stylesheet" href="dtcss/font-awesome.min.css">
<!-- menu -->
	 <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="font.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


</head>
<body>
<?php
			session_start();
			if(isset($_SESSION['u_usuario'])){
			}
			else{
				header("location: signup.html");
			}
	?>
	<header>
        <div class="menu_bar">
            <a href="#" class="bt-menu"><span class="icon-menu3"></span> MENU </a>
        </div>
		<nav>
		<ul>
                            <li><a href="agenda.php"><span class="icon-calendar"></span>Agenda</a></li>
                            <li><a href="eventoslist.php"><span class="icon-linkedin2"></span>Eventos</a></li>
                            <li><a href="clientes.php"><span class="icon-profile"></span>Clientes</a></li>
                            <li><a href="material.php"><span class="icon-linkedin2"></span>Materiales</a></li>
                            <li><a href="herramienta.php"><span class="icon-linkedin2"></span>Herramientas</a></li>
                            <li><a href="historial.php"><span class="icon-file-text"></span>Historial</a></li>
                            <li><a href="cerrar_sesion.php"><img src="">SALIR</a></li>
                            </ul>
				</nav>
                    
    </header>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="menu.js"></script>

	
	
	<div class="row">
		<div id="cuadro2" class="col-sm-12 col-md-12 col-lg-12 ocultar" >
			<form class="form-horizontal" action="" method="POST">
				<div class="form-group">
					<h3 class="col-sm-offset-2 col-sm-8 text-center">					
					Formulario de Registro de clientes</h3>
				</div>
				<input type="hidden" id="id_cliente" name="id_cliente" value="0">
				<input type="hidden" id="opcion" name="opcion" value="registrar">
				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombre:</label>
					<div class="col-sm-8"><input id="nombre" name="nombre" type="text" class="form-control"  autofocus></div>				
				</div>
				<div class="form-group">
					<label for="telefono" class="col-sm-2 control-label">Telefono:</label>
					<div class="col-sm-8"><input id="telefono" name="telefono" type="text" class="form-control" ></div>
				</div>
				<div class="form-group">
					<label for="correo" class="col-sm-2 control-label">Correo:</label>
					<div class="col-sm-8"><input id="correo" name="correo" type="email" class="form-control" ></div>
				</div>
				<div class="form-group">
					<label for="rfc" class="col-sm-2 control-label">RFC:</label>
					<div class="col-sm-8"><input id="rfc" name="rfc" type="text" class="form-control"></div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8">
						<input id="" type="submit" class="btn btn-primary" value="Guardar">
						<input id="btn_listar" type="button" class="btn btn-primary" value="Listar">
					</div>
				</div>
			</form>
			<div class="col-sm-offset-2 col-sm-8">
				<p class="mensaje"></p>
			</div>
			
		</div>
	</div>
	<div class="row">
		<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center"> <small class="mensaje"></small></h3>
			</div>
			<div class="table-responsive col-sm-12">		
				<table id="dt_cl" class="table table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>>
							<th>Nombre</th>								
							<th>RFC</th>
							<th>Correo</th>
							<th>telefono</th>
							<th></th>											
						</tr>
					</thead>					
				</table>
			</div>			
		</div>		
	</div>
	<div>
		<form id="frmEliminarCliente" action="" method="POST">
			<input type="hidden" id="id_cliente" name="id_cliente" value="">
			<input type="hidden" id="opcion" name="opcion" value="eliminar">
			<!-- Modal -->
			<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="modalEliminarLabel">Eliminar Cliente</h4>
						</div>
						<div class="modal-body">							
							¿Está seguro de eliminar al cliente?<strong data-name=""></strong>
						</div>
						<div class="modal-footer">
							<button type="button" id="eliminar-cliente" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
		</form>
	</div>
	
	<script src="dtjs/jquery-1.12.3.js"></script>
	<script src="dtjs/bootstrap.min.js"></script>
	<script src="dtjs/jquery.dataTables.min.js"></script>
	<script src="dtjs/dataTables.bootstrap.js"></script>
	<!--botones DataTables-->	
	<script src="dtjs/dataTables.buttons.min.js"></script>
	<script src="dtjs/buttons.bootstrap.min.js"></script>
	<!--Libreria para exportar Excel-->
	<script src="dtjs/jszip.min.js"></script>
	<!--Librerias para exportar PDF-->
	<script src="dtjs/pdfmake.min.js"></script>
	<script src="dtjs/vfs_fonts.js"></script>
	<!--Librerias para botones de exportación-->
	<script src="dtjs/buttons.html5.min.js"></script>

	<script>		
		$(document).on("ready", function(){
			listar();
			guardar();
			eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

		var guardar = function(){
			$("form").on("submit",function(e){
					e.preventDefault();
					var frm = $(this).serialize();
					$.ajax({
						method: "POST",
						url: "guardarclientes.php",
						data: frm

					}).done(function(info){
						var json_info = JSON.parse(info);
						mostrar_mensaje(json_info);
						limpiar_datos();
						listar();
					});
			});
		}
		var eliminar = function(){
			$("#eliminar-cliente").on("click", function(){
				var id_cliente = $("#frmEliminarCliente #id_cliente").val(),
					opcion = $("#frmEliminarCliente #opcion").val();
				$.ajax({
					method:"POST",
					url:"guardarclientes.php",
					data:{"id_cliente":id_cliente,"opcion":opcion}
				}).done(function(info){
						var json_info = JSON.parse(info);
						mostrar_mensaje(json_info);
						limpiar_datos();
						listar();
					});
			});
		}
		var mostrar_mensaje = function( informacion ){
		var texto = "", color = "";
		if( informacion.respuesta == "BIEN" ){
			texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
			color = "#379911";
		}else if( informacion.respuesta == "ERROR"){
			texto = "<strong>Error</strong>, no se ejecutó la consulta.";
			color = "#C9302C";
		}else if( informacion.respuesta == "EXISTE" ){
			texto = "<strong>Información!</strong> el cliente ya existe.";
			color = "#5b94c5";
		}else if( informacion.respuesta == "VACIO" ){
			texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
			color = "#ddb11d";
		}else if( informacion.respuesta == "OPCION_VACIA" ){
					texto = "<strong>Advertencia!</strong> la opción no existe o esta vacia, recargar la página.";
					color = "#ddb11d";
			}

		$(".mensaje").html( texto ).css({"color": color });
		$(".mensaje").fadeOut(5000, function(){
		$(this).html("");
		$(this).fadeIn(3000);
		}); 
		}
		
		var limpiar_datos = function(){
		$("#opcion").val("registrar");
		$("#id_cliente").val("");
		$("#nombre").val("").focus();
		$("#correo").val("");
		$("#rfc").val("");
		$("#telefono").val("");
		}



		var listar = function(){
			
			$("#cuadro2").slideUp("slow");
			$("#cuadro1").slideDown("slow");
			var table = $("#dt_cl").DataTable({
				"destroy":true,
				"ajax":{
					"method":"POST",
					"url": "listcliente.php"
				},
				"columns":[
					{"data":"id_cliente"},
					{"data":"nombre"},
					{"data":"rfc"},
					{"data":"correo"},
					{"data":"telefono"},
					{"defaultContent":"<button type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i></button>	<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
				
				],
				"language":idioma_espanol,
				"dom":"<'row'<'form-inline' <'col-sm-offset-5'B>>>"
					 +"<'row'<'form-inline' <'col-sm-1'f>>>"
					 +"<rt>"
					 +"<'row'<'form-inline'"
					 +" <'col-sm-6 col-md-6 col-lg-6'l>"
					 +"<'col-sm-6 col-md-6 col-lg-6'p>>>",
				"buttons":[
					{
						"text":"<i class='fa fa-user-plus'></i>",
						"tittleAttr":"Agregar cliente",
						"className":"btn btn-success",
						"action":function(){
							agregar_nuevo_cliente();
						}
					}
				]
			});
			obtener_data_editar("#dt_cl tbody",table);
			obtener_id_eliminar("#dt_cl tbody",table);
		}



		
		var agregar_nuevo_cliente= function(){
			limpiar_datos();

			$("#cuadro2").slideDown("slow");
			$("#cuadro1").slideUp("slow");
		}

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data= table.row($(this).parents("tr")).data();
				var id_cliente = $("#id_cliente").val(data.id_cliente),
					nombre  =	$("#nombre").val(data.nombre),
					rfc =  $("#rfc").val(data.rfc),
					correo =  $("#correo").val(data.correo),
					correo =  $("#telefono").val(data.telefono),
					opcion = $("#opcion").val("modificar");
					
					$("#cuadro2").slideDown("slow");
					$("#cuadro1").slideUp("slow");
			});
		}

		var obtener_id_eliminar = function(tbody, table){
				$(tbody).on("click", "button.eliminar", function(){
					var data = table.row($(this).parents("tr")).data();
					var id_herramienta = $("#frmEliminarCliente #id_cliente").val(data.id_cliente);
					});
			}

	
		var idioma_espanol ={
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
		
		

	</script>
</body>
</html>
