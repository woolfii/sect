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
        if(($rentados + $disponibles ) == $existencia ){
            if( $nombre != "" && $existencia != "" && $rentados != "" && $disponibles !=""){
                 $existe = existe_material($nombre, $conexion);
                if($existe >0){
                    $informacion["respuesta"]="EXISTE";
                    echo json_encode($informacion);
                }else{
                    registrar($nombre,$existencia,$rentados,$disponibles, $conexion);
            }
                            
            }else{
            $informacion["respuesta"] = "VACIO";
                echo json_encode($informacion);
            }
        }else{
            $informacion["respuesta"] = "NOC";
                echo json_encode($informacion);
        }
            
            break;
        case 'modificar':
            modificar($id_material, $nombre, $existencia, $rentados,  $disponibles, $conexion  );
            break;
        
        case 'eliminar':
            eliminar($id_material,$conexion);
            break;

        default:
        $informacion["respuesta"]= "OPCION VACIA";
            break;
    }

    function existe_material($nombre, $conexion){
		$query = "SELECT id_material FROM materiales WHERE nombre = '$nombre';";
		$resultado = mysqli_query($conexion, $query);
		$existe_material = mysqli_num_rows( $resultado );
		return $existe_material;
	}

	function registrar($nombre,$existencia,$rentados,$disponibles, $conexion){
		$query = "INSERT INTO materiales VALUES(0, '$nombre', '$existencia', '$rentados','$disponibles');";
		$resultado = mysqli_query($conexion, $query);		
		verificar_resultado($resultado);
		cerrar($conexion);
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