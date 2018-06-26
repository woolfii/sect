<?php
header('Content-type: application/json');
$pdo=new PDO("mysql:dbname=sectdb;host=127.0.0.1","root","");

$accion= (isset($_GET['accion']))?$_GET['accion']:'leer';

switch($accion){
    case 'agregar':
    //echo("agregaciontl");
    
         $sentenciaSQL = $pdo->prepare("INSERT INTO eventos 
         (id_evento,meses,descripcion,color,textcolor,cliente,material,tipo,fecha) values
         (:id_evento,:meses,:descripcion,:color,:textcolor,:cliente,:material,:tipo,:fecha)");
        $respuesta = $sentenciaSQL-> execute(array(
            "id_evento" => $_POST['id_evento'],
            "meses" => $_POST['meses'],
            "descripcion" => $_POST['descripcion'],
            "color" => $_POST['color'],
            "textcolor" => $_POST['textcolor'],
            "cliente" => $_POST['cliente'],
            "material" => $_POST['material'],
            "tipo" => $_POST['tipo'],
            "fecha" => $_POST['fecha']                                  
        ));
      
        echo json_encode($respuesta);
        break;
       
           /*
            "id_evento" => $_POST['id_evento'],
            "tipo" => $_POST['tipo'],
            "material" => $_POST['material'],
            "meses" => $_POST['meses'],
            "cliente" => $_POST['cliente'], 
            "fecha" => $_POST['fecha'],                   
            "color" => $_POST['color'],
            "descripcion" => $_POST['descripcion'],
            "textColor" => $_POST['textColor'] 
        "tipo" =>"venta",
        "material" => "material",
        "id_evento" => "2",
        "meses" => "6",
        "cliente" => "clientaso",                   
        "color" => "#fffff",
        "descripcion" => "desc",
        "textColor" => "#ff0000" */     
        
        
    /*
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
         break;     */
    default:
       //seleccionar los eventos del calendario
       /*
         $sentenciaSQL = $pdo->prepare("SELECT * FROM eventos");
         $sentenciaSQL -> execute();

         $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
         echo json_encode($resultado);*/
         break; 
}


?>