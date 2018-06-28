<?php 
 	@session_start();
	include_once("../../Conexion/Conexion.php");
	if (isset($_POST["des"]) && $_POST["des"]!="") {

		//Eliminar (DELETE)
		if ($_POST["des"]=="eliminar") {
			
			try {
				$SQL="DELETE FROM operadores_carga where email ='$_POST[elcorreo]'";
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                $exito = array("0","Eliminado",$SQL);
				echo json_encode(array("exito" => $exito));
                
                
			} catch (Exception $execute) {
				$exito = array("1","error",$execute, $SQL);
            	echo json_encode(array("error" => $exito));
			}

		//Actualizar (UPDATE) -TABLA-
		} else if($_POST["des"]=="actualizar"){
			try {
				$SQL="UPDATE operadores_carga SET nombre ='$_POST[nombre1]', nit ='$_POST[nit1]', credito ='$_POST[credito1]', detalle_cuenta_bancaria_nombre = '$_POST[detalle_nombre1]', email = '$_POST[correo1]', detalle_cuenta_bancaria_numero = '$_POST[detalle_numero1]', cheque_nombre_de = '$_POST[cheque_nombre1]' where id = '$_POST[id]'";
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                $exito = array("2","Actualizado",$SQL);
				echo json_encode(array("exito" => $exito));

                
			} catch (Exception $exec) {
				$exito = array("4","error",$exec,$_POST["des"]);
            	echo json_encode(array("error" => $exito));
			}
		}
		
	}
	else{
		$exito = array("4.fin","error",$execute,$_POST);
            	echo json_encode(array("error" => $exito));
	}
	

?>