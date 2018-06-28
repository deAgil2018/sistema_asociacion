<?php 
 	@session_start();
	include_once("../../Conexion/Conexion.php");
	if (isset($_POST["des"]) && $_POST["des"]!="") {

		//Eliminar (DELETE)
		if ($_POST["des"]=="eliminar") {
			
			try {
				$SQL="DELETE FROM oficinas_trader where id ='$_POST[elcorreo]'";
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                
                try {

                	$SQL2="DELETE FROM foranea_oficinas_trader where codigo_oficina ='$_POST[elcorreo]'";
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
			$SQL="UPDATE oficinas_trader SET nombre ='$_POST[nombre1]', direccion ='$_POST[direccion]', codigo_contrato ='$_POST[co_contrato]', contacto_operativo = '$_POST[con_operativo]', contacto_comercial = '$_POST[con_comercial]',otros = '$_POST[con_otros]',codigo_postal = '$_POST[co_direccion]',contacto_financiero = '$_POST[con_financiero]',contacto_documentos = '$_POST[con_documentacion]' where id = '$_POST[id]'";
			try {
				
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                $exito = array("2","Eliminado");
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