<?php
header('Content-type: application/json');
$pdo=new PDO("mysql:dbname=sistema;host=127.0.0.1","root","");

$accion= (isset($_GET['accion']))?$_GET['accion']:'leer';

switch($accion){
    case 'agregar':
        $sentenciaSQL = $pdo->prepare("insert into eventos(id,title,start,descripcion,
        color,textColor,end) values(:id,:title,:start,
        :descripcion,:color,:textColor,:end)");
       
       $respuesta = $sentenciaSQL-> execute(array(
            "id" => $_POST['id'],
            "title" => $_POST['title'],
            "start" => $_POST['start'],
            "descripcion" => $_POST['descripcion'],
            "color" => $_POST['color'],
            "textColor" => $_POST['textColor'],   
            "end" => $_POST['end']   
        ));
        echo json_encode($respuesta);
        break;
    
    case 'eliminar':
        $respuesta = false;

        if(isset($_POST['id'])){

            $sentenciaSQL = $pdo->prepare("delete from eventos where ID = :ID ");
            $respuesta = $sentenciaSQL-> execute(array("ID" => $_POST['id']));
        }
        echo json_encode($respuesta);
        break;
    case 'modificar': 
        $sentenciaSQL = $pdo->prepare("update eventos set
        title=:title,
        start=:start,
        color=:color,
        descripcion=:descripcion, 
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
            "textColor" => $_POST['textColor'],   
            "end" => $_POST['end']   
        ));
        echo json_encode($respuesta);
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