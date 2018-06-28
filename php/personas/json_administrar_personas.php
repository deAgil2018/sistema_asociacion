<?php 
 	@session_start();
	include_once("../../Conexion/Conexion.php");
	if (isset($_POST["elcorreo"]) && $_POST["elcorreo"]!="" || isset($_POST["correo"]) && $_POST["correo"]!="") {

		//Eliminar (DELETE)
		if ($_POST["des"]=="eliminar") {
			
			try {
				$SQL="DELETE FROM personas where correo ='$_POST[elcorreo]'";
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                
                try {

                	$SQL2="DELETE FROM usuarios where correo ='$_POST[elcorreo]'";
                	$comando = Conexion::getInstance()->getDb()->prepare($SQL2);
               		$comando->execute();
                	$exito = array("2","Eliminado");
					echo json_encode(array("exito" => $exito));
                } catch (Exception $ex) {
                	$exito = array("1","error",$ex);
            		echo json_encode(array("error" => $exito));
                }
                
			} catch (Exception $execute) {
				$exito = array("2","error",$execute);
            	echo json_encode(array("error" => $exito));
			}

		//Actualizar (UPDATE) -TABLA-
		} else if($_POST["des"]=="actualizar"){
			try {
				$SQL="UPDATE personas SET nombre ='$_POST[nombre]', direccion ='$_POST[direccion]', telefono ='$_POST[telefono]', genero = '$_POST[genero]', correo = '$_POST[email]', nivel = '$_POST[rol]' where correo = '$_POST[correo]'";
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                try {

                	$SQL2="UPDATE usuarios SET correo = '$_POST[email]', usuario = '$_POST[usuario]' where correo ='$_POST[correo]'";
                	$comando = Conexion::getInstance()->getDb()->prepare($SQL2);
               		$comando->execute();
                	$exito = array("2","Eliminado");
					echo json_encode(array("exito" => $exito));
                } catch (Exception $exe) {
                	$exito = array("3","error",$exe);
            		echo json_encode(array("error" => $exito));
                }

                
			} catch (Exception $exec) {
				$exito = array("4","error",$exec,$_POST["des"]);
            	echo json_encode(array("error" => $exito));
			}
		}

		//Atualizar (UPDATE) -ESTADO-
		else{
			try {
				$SQL="UPDATE personas SET estado ='$_POST[estado]' where correo = '$_POST[elcorreo]'";
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
				echo json_encode(array("exito" => "exito"));	
                
			} catch (Exception $execute) {
				$exito = array("5","error",$execute,$_POST["des"]);
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