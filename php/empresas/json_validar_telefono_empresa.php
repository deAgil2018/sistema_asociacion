<?php 
    @session_start();
	include_once("../../Conexion/Conexion.php");
    if ($_POST["ele"]=="1") {
        	$query_codigo = "SELECT telefono  from telefonos_empresa where telefono ='".$_POST[data]."'";
        	try {
        		$comando = Conexion::getInstance()->getDb()->prepare($query_codigo);
	            $comando->execute();
	            if($comando->rowCount()>0){
	                echo json_encode(array("error" => "Ya existe el nombre sub!!" ));
	            }else{
	                echo json_encode(array("exito" => "No existe el nombre sub" ));
	            }
        	} catch (Exception $e) {
        		echo json_encode(array("error2" => $e));
        	}
            


    } else if ($_POST["ele"]=="2") {
            $query_codigo = "SELECT telefono from telefonos_empresa where telefono ='".$_POST[data]."' and telefono<>'".$_POST[correo2]."' ";
            try {
                $comando = Conexion::getInstance()->getDb()->prepare($query_codigo);
                $comando->execute();


                if($comando->rowCount()>0){
                    $array = array("Ya existe el telefono",$query_codigo);
                    echo json_encode(array("error" => $array ));
                }else{
                    $array = array("NO existe el telefono",$query_codigo);
                    echo json_encode(array("exito" => $array ));
                }
            } catch (Exception $e) {
                echo json_encode(array("error2" => $e));
            }
            


    }

  

?>