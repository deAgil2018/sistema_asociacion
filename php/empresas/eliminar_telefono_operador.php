<?php 
 	@session_start();
	include_once("../../Conexion/Conexion.php");
	if (isset($_POST["des"]) && $_POST["des"]!="") {

		//Eliminar (DELETE)
		if ($_POST["des"]=="eliminar") {
			
			try {
				$SQL="DELETE FROM telefonos_operadores_carga where id ='$_POST[elcorreo]'";
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                
                try {

                	$SQL2="DELETE FROM foranea_telefonos_operadores_carga where id_telefonos ='$_POST[elcorreo]'";
                	$comando = Conexion::getInstance()->getDb()->prepare($SQL2);
               		$comando->execute();
                	$exito = array("2","Eliminado");
					echo json_encode(array("exito" => $exito));
                } catch (Exception $ex) {
                	$exito = array("0","error",$ex);
            		echo json_encode(array("error" => $exito));
                }
                
			} catch (Exception $execute) {
				$exito = array("1","error",$execute);
            	echo json_encode(array("error" => $exito));
			}

		//Actualizar (UPDATE) -TABLA-
		} else if($_POST["des"]=="actualizar"){
			$SQL="UPDATE telefonos_operadores_carga SET telefono ='$_POST[telefono1]', nombre ='$_POST[nombre1]'where id = '$_POST[id]'";
			try {
				
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                $exito = array("2","Actualizado");
				echo json_encode(array("exito" => $exito));

                
			} catch (Exception $exec) {
				$exito = array("4","error",$exec->getMessage(),$_POST["des"],$SQL);
            	echo json_encode(array("error" => $exito));
			}
		}
		//$SQL = "UPDATE personas SET estado ='$_POST[estado]' where correo = '$_POST[elcorreo]'";
		
	}
	else{
		$exito = array("4.fin","error",$execute,$_POST["des"]);
            	echo json_encode(array("error" => $exito));
	}
	

?>