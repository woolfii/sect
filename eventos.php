<?php
header('Content-type: application/json');
$pdo=new PDO("mysql:dbname=sectdb;host=127.0.0.1","root","");

$accion= (isset($_GET['accion']))?$_GET['accion']:'leer';
date_default_timezone_set("America/Mexico_City");
$fecha_actual = date('Y-m-d H:i:s');
$agreg = 'agregado';
$elimino = 'eliminado';
$modifico = 'modificado';
switch($accion){
    case 'agregar':
        $sentenciaSQL = $pdo->prepare("insert into eventos(id,title,start,descripcion,
        color,textColor,end,meses,cliente,material) values(:id,:title,:start,
        :descripcion,:color,:textColor,:end,:meses,:cliente,:material)");
       
       $respuesta = $sentenciaSQL-> execute(array(
            "id" => $_POST['id'],
            "title" => $_POST['title'],
            "start" => $_POST['start'],
            "descripcion" => $_POST['descripcion'],
            "color" => $_POST['color'],
            "textColor" => $_POST['textColor'],   
            "end" => $_POST['end'],
            "meses" => $_POST['meses'],
            "cliente"=> $_POST['cliente'],
            "material"=> $_POST['material']
        ));

        
        echo json_encode($respuesta);

        //Se guardan cambios en el historial

        $sentenciaSQL1 = $pdo->prepare("insert into historial(usuario,evento,accion,fecha,fechahoy) values(:usuario,:evento,:accion,:fecha,:fechahoy)");
       
       $respuesta1 = $sentenciaSQL1-> execute(array(
            "usuario" => $_POST['usua'],
            "evento" => $_POST['title'],
            "accion" => $agreg,
            "fecha"=> $_POST['start'],
            "fechahoy" =>  $fecha_actual
        ));
        break;
    
    case 'eliminar':
        $respuesta = false;

        if(isset($_POST['id'])){

            $sentenciaSQL = $pdo->prepare("delete from eventos where ID = :ID ");
            $respuesta = $sentenciaSQL-> execute(array("ID" => $_POST['id']));
          echo json_encode($respuesta);

            $sentenciaSQL1 = $pdo->prepare("insert into historial(usuario,evento,accion,fecha,fechahoy) values(:usuario,:evento,:accion,:fecha,:fechahoy)");
       
       $respuesta1 = $sentenciaSQL1-> execute(array(
            "usuario" => $_POST['usua'],
            "evento" => $_POST['title'],
            "accion" => $elimino,
            "fecha"=> $_POST['start'],
            "fechahoy" =>  $fecha_actual
             ));
        }
        
        break;

    case 'modificar': 
        $sentenciaSQL = $pdo->prepare("update eventos set
        title=:title,
        start=:start,
        color=:color,
        descripcion=:descripcion,
        meses=:meses,
        cliente=:cliente,
        material=:material, 
        textColor=:textColor,
        end=:end
        where ID=:ID
        ");
        $respuesta = $sentenciaSQL-> execute(array(
            "ID" => $_POST['id'],
            "title" => $_POST['title'],
            "start" => $_POST['start'],
            "color" => $_POST['color'],
            "descripcion" => $_POST['descripcion'],
            "meses" => $_POST['meses'],
            "cliente"=> $_POST['cliente'],
            "material"=> $_POST['material'],
            "textColor" => $_POST['textColor'],   
            "end" => $_POST['end']   
        ));
        echo json_encode($respuesta);
        $sentenciaSQL1 = $pdo->prepare("insert into historial(usuario,evento,accion,fecha,fechahoy) values(:usuario,:evento,:accion,:fecha,:fechahoy)");
        $respuesta1 = $sentenciaSQL1-> execute(array(
            "usuario" => $_POST['usua'],
            "evento" => $_POST['title'],
            "accion" => $modifico,
            "fecha"=> $_POST['start'],
            "fechahoy" =>  $fecha_actual
             ));
            
            break;       
    default:
       //seleccionar los eventos del calendario
       $sentenciaSQL = $pdo->prepare("SELECT * FROM eventos");
       $sentenciaSQL -> execute();
       $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
       echo json_encode($resultado);
         break;
}


?>