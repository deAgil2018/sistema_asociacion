<?php 
 	@session_start();
	include_once("../../Conexion/Conexion.php");
		if (isset($_POST["nombre"]) && $_POST["nombre"]!="") {
			
			$SQL = "UPDATE categorias SET padre ='$_POST[categoria]',nombre ='$_POST[nombre]' where id = '$_POST[id]'";

			try {
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                
        		$exito = array("2","Actualizado");
				echo json_encode(array("exito" => $exito));
                	
                
			} catch (Exception $execute) {
				$exito = array("-1","error",$execute);
            	echo json_encode(array("error" => $exito));
			}
		}
		else{
			$exito = array("-1","error",$execute);
            echo json_encode(array("error" => $exito));
		}
	

?>