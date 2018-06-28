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


			$SQL="UPDATE ingenio SET nombre ='$_POST[nombre1]', numero_fda ='$_POST[numero_fda1]', direccion = '$_POST[direccion1]', contacto_comercial = '$_POST[con_comercial1]',contacto_operativo = '$_POST[con_operativo1]',contacto_documentos = '$_POST[con_documentacion1]',contacto_otros = '$_POST[con_contacto_otros1]',correo = '$_POST[correo1]',nit = '$_POST[nit1]',nrc = '$_POST[nrc1]',fax = '$_POST[fax1]',contacto_contabilidad_factura = '$_POST[cfactura1]',contacto_contabilidad_emision = '$_POST[cemision1]',contacto_financiero = '$_POST[con_financiero1]' where id = '$_POST[id]'";
			try {
				
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                $exito = array("2","Actualizado",$SQL);
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