<?php
    include("conexion.php");

    $id_material = $_POST["id_material"];
    $nombre = $_POST["nombre"];
    $existencia= $_POST["existencia"];
    $rentados = $_POST["rentados"];
    $disponibles = $_POST["disponibles"];
    $opcion = $_POST["opcion"];
    $informacion=[];

    switch($opcion){
        case 'registrar':
            modificar($id_material, $nombre, $existencia, $rentados,  $disponibles, $conexion  );
            break;
        
        case 'eliminar':
            eliminar($id_material,$conexion);
            break;
    }

    function modificar( $id_material, $nombre, $existencia, $rentados,  $disponibles, $conexion  ){
       $query = "UPDATE materiales SET nombre='$nombre',
                                        existencia = '$existencia',
                                         rentados ='$rentados',
                                         disponibles='$disponibles'
                                    WHERE id_material = $id_material ";
        $resultado = mysqli_query($conexion,$query);
        verificar_resultado($resultado);
        cerrar($conexion);  
    }
    function eliminar($id_material,$conexion){
        $query = "DELETE FROM materiales WHERE id_material = $id_material ";
        $resultado = mysqli_query($conexion,$query);
        verificar_resultado($resultado);
        cerrar($conexion);  
    }
    function verificar_resultado($resultado){
        if(!$resultado)   $informacion["respuesta"] = "ERROR";
        else $informacion["respuesta"] = "BIEN";
        echo json_encode($informacion);
    }  
    function cerrar($conexion){
        mysqli_close($conexion);
    }


?>