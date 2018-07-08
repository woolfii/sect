<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SECT telecomunicaciones</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/es.js"></script>
    <script src="js/bootstrap-clockpicker.js"></script>
    <link rel="stylesheet" href="css/bootstrap-clockpicker.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

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
            <script src="menu.js"></script>
            
   <div class="container-fluid"> 
        <div class="row">
            <div class="col">  </div>
            <div class="col-12"><div id="CalendarioWeb"></div></div>
            <div class="col"></div>
            </div>
            </div>>
<script>
    $(document).ready(function(){
        $('#CalendarioWeb').fullCalendar({
            contentHeight: 500,
            header:{
                left:'title',
                center:'today, prev,next',
                right:'month,basicWeek,basicDay,'
            },
            customButtons:{
                Miboton:{
                    text:"Inventarios",
                    click:function(){
                        location.href="http://localhost/SECT/material.html"
                    }
                }
            },
            dayClick:function(date, jsEvent, view){  

                $('#btnAgregar').prop("disabled",false);
                $('#btnModificar').prop("disabled",true);
                $('#btnEliminar').prop("disabled",true);

                limpiarFormulario();
                $('#txtFecha').val(date.format());
                $("#ModalEventos").modal();
            },
           
            events:'http://localhost/sect-master/eventos.php',
          
            eventClick:function(calEvent,jsEvent,view){
                $('#btnAgregar').prop("disabled",true);
                $('#btnModificar').prop("disabled",false);
                $('#btnEliminar').prop("disabled",false);

                //h5
                $('#tituloEvento').html(calEvent.title);
                //mostra la informacion del evento en los inputs
                $('#txtDescripcion').val(calEvent.descripcion);
                $('#txtID').val(calEvent.id);
                $('#txtTitulo').val(calEvent.title);
                $('#txtColor').val(calEvent.color);
                $('#txtCliente').val(calEvent.cliente);
                $('#txtMeses').val(calEvent.meses);
                $('#txtMaterial').val(calEvent.material);

                FechaHora= calEvent.start._i.split(" ");
                $('#txtFecha').val(FechaHora[0]);
                $('#txtHora').val(FechaHora[1]);


                $('#ModalEventos').modal();
            },
            editable:true,
            eventDrop:function(calEvent){
                $('#txtDescripcion').val(calEvent.descripcion);
                $('#txtID').val(calEvent.id);
                $('#txtTitulo').val(calEvent.title);
                $('#txtColor').val(calEvent.color);
                $('#txtCliente').val(calEvent.cliente);
                $('#txtMeses').val(calEvent.meses);
                $('#txtMaterial').val(calEvent.material);
                
                var fechaHora = calEvent.start.format().split("T");
                $('#txtFecha').val(fechaHora[0]);
                $('#txtHora').val(fechaHora[1]);

                RecolectarDatosGUI();
                EnviarInformacion('modificar', NuevoEvento, true); 
            }
            

        });
    });

    
</script>    


  <!-- Modal(Agregar,modificar y eliminar) -->
<div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloEvento"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           
         <input type="hidden" id="txtID" name="txtID">      
          <input type="hidden" id="txtFecha" name="txtFecha" />
        <div class="form-row">
                <div class="form-group col-md-8">
                    <label>Titulo:</label>
             <input type="text" id="txtTitulo" class="form-control" placeholder="titulo del evento" required>
                </div>
                <div class="form-group col-md-4">
                        <label>Hora del Evento:</label>
                        <div class="input-group clockpicker" data-autoclose="true">
                        <input type="text" id="txtHora" value="10:30" class="form-control" />
                        </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label>Material:</label>
                    <input type="text" id="txtMaterial" class="form-control" >
                </div>
                <div class="form-group col-md-4">
                        <label>Meses:</label>
                        <input type="number"  id="txtMeses" class="form-control">
                </div>
            </div>
             <!-- descripcion color cliente -->
            <div class="form-group" >
                <label>Descripcion:</label>
                <textarea id="txtDescripcion" rows="3"  class="form-control"></textarea>
            </div>
            <div class="form-group" >
                <label>Cliente:</label>
                <input type="text"  id="txtCliente" class="form-control">
            </div>
            <div class="form-group" >
                    <label>Color:</label>
                <input type="color" value="yellow" id="txtColor" class="form-control" style="height:36px;">
    
            </div>
          
        </div>
        <div class="modal-footer">
                <button type="button" id="btnAgregar"  class="btn btn-success" >Agregar</button>
                <button type="button" id="btnModificar"class="btn btn-success" >Modificar</button>
                <button type="button" id ="btnEliminar" class="btn btn-danger">Borrar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
         </div>
      </div>
    </div>
  </div>
<script>
var NuevoEvento;
        $('#btnAgregar').click(function(){
            title= $('#txtTitulo').val()
            if(title==""){
                alert("Necesitas minimamente brindar un titulo al evento!");
            }
            else{
             RecolectarDatosGUI();
              EnviarInformacion('agregar', NuevoEvento);      
            }
             
     });   
     
        $('#btnEliminar').click(function(){
           
             RecolectarDatosGUI();
             EnviarInformacion('eliminar', NuevoEvento); 
                
      });
        
        $('#btnModificar').click(function(){
            title= $('#txtTitulo').val()
            if(title==""){
                alert("Necesitas minimamente brindar un titulo al evento!");
            }
            else{
             RecolectarDatosGUI();
             EnviarInformacion('modificar', NuevoEvento); 
             }
      });

      function RecolectarDatosGUI(){
             NuevoEvento={
              id:$('#txtID').val(),
              title:$('#txtTitulo').val(),
              start:$('#txtFecha').val()+" "+$('#txtHora').val(),
              color:$('#txtColor').val(),
              descripcion:$('#txtDescripcion').val(),
              textColor:"white",
              cliente:$('#txtCliente').val(),
              meses:$('#txtMeses').val(),
              material:$('#txtMaterial').val(),
              end:$('#txtFecha').val()+" "+$('#txtHora').val()
             
          };  
      }
      
      function EnviarInformacion(accion, objEvento,modal){
          $.ajax({
              type:'POST',
              url:'eventos.php?accion='+accion,
              data:objEvento,
              success: function(msg){
                  if(msg){
                    $('#CalendarioWeb').fullCalendar('refetchEvents');
                    if(!modal){
                        $("#ModalEventos").modal('toggle');
                    }
                    
                  }
              },
              error:function(){
                  alert("Ocurrio un error, verifica que has llenado correctamente la informacion!");
              }
          });
      }

$('.clockpicker').clockpicker();
function limpiarFormulario(){
        $('#txtDescripcion').val('');
        $('#txtID').val('');
        $('#txtTitulo').val('');
        $('#txtColor').val('');
        $('#txtMeses').val('');
        $('#txtCliente').val('');
        $('#txtMaterial').val('');
}
  </script>

</body>
</html>