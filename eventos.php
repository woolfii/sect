<?php
header('Content-type: application/json');
$pdo=new PDO("mysql:dbname=sectdb;host=127.0.0.1","root","");

$accion= (isset($_GET['accion']))?$_GET['accion']:'leer';

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