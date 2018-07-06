<?php
include("conexion.php");

    $id_cliente = $_POST["id_cliente"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $rfc = $_POST["rfc"];
    $opcion = $_POST["opcion"];
switch($opcion){
        case 'registrar':
            if( $nombre != "" && $correo != "" && $telefono != "" && $rfc != ""){
                 $existe = existe_cliente($nombre, $conexion);
                if($existe >0){
                    $informacion["respuesta"]="EXISTE";
                    echo json_encode($informacion);
                }else{
                    registrar($nombre,$rfc,$correo,$telefono, $conexion);
            }
                            
            }else{
            $informacion["respuesta"] = "VACIO";
                echo json_encode($informacion);
            }
            break;
        case 'modificar':
            modificar( $id_cliente,$nombre,$rfc,$correo,$telefono, $conexion);
            break;
        
        case 'eliminar':
            eliminar($id_cliente,$conexion);
            break;

        default:
        $informacion["respuesta"]= "OPCION VACIA";
            break;
    }

    function existe_cliente($nombre, $conexion){
		$query = "SELECT id_cliente FROM clientes WHERE nombre = '$nombre';";
		$resultado = mysqli_query($conexion, $query);
		$existe_cliente= mysqli_num_rows( $resultado );
		return $existe_cliente;
	}

	function registrar($nombre,$rfc,$correo,$telefono,  $conexion){
		$query = "INSERT INTO clientes VALUES(0, '$nombre','$rfc', '$correo', '$telefono' );";
		$resultado = mysqli_query($conexion, $query);		
		verificar_resultado($resultado);
		cerrar($conexion);
	}

    function modificar( $id_cliente,$nombre,$rfc,$correo,$telefono, $conexion){
       $query = "UPDATE clientes SET nombre='$nombre',
                                        rfc = '$rfc',
                                        correo = '$correo',
                                        telefono= '$telefono'
                                    WHERE id_cliente = $id_cliente ";
        $resultado = mysqli_query($conexion,$query);
        verificar_resultado($resultado);
        cerrar($conexion);  
    }
    function eliminar($id_cliente,$conexion){
        $query = "DELETE FROM clientes WHERE id_cliente = $id_cliente ";
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