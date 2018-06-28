<?php 
    @session_start();
	include_once("../../Conexion/Conexion.php");
    if ($_POST["ele"]=="1") {
        	$query_codigo = "SELECT correo as useres from usuarios where correo ='".$_POST[data]."'";
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
            


    }

  

?>