<?php 
 	@session_start();
	include_once("../../Conexion/Conexion.php");
	if ($_POST[des]= '1') {
	 
			
			$SQL = "DELETE FROM  categoria_sliders WHERE id ='$_POST[codigo]' AND id_perfil = '$_POST[codigo_row]'";

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