

<?php 
 	@session_start();
	include_once("../../Conexion/Conexion.php");
	if (isset($_POST["elcorreo"]) && $_POST["elcorreo"]!="" || isset($_POST["correo"]) && $_POST["correo"]!="") {

		//Eliminar (DELETE)
		if ($_POST["des"]=="eliminar") {
			
			try {
				$SQL="DELETE FROM traders where correo ='$_POST[elcorreo]'";
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                $exito = array("0","Eliminado");
				echo json_encode(array("exito" => $exito));
                
                
			} catch (Exception $execute) {
				$exito = array("1","error",$execute);
            	echo json_encode(array("error" => $exito));
			}

		//Actualizar (UPDATE) -TABLA-
		} else if($_POST["des"]=="actualizar"){
			try {
				$SQL="UPDATE traders SET nombre ='$_POST[nombre]', direccion ='$_POST[direccion]', telefono ='$_POST[telefono]', fax_ingresado = '$_POST[fax]', correo = '$_POST[email]', \"codigo_oficina\" = '$_POST[coficina]', identificador = '$_POST[identificador]', \"TAX_ID\" = '$_POST[tax]'where correo = '$_POST[correo]'";
				$comando = Conexion::getInstance()->getDb()->prepare($SQL);
                $comando->execute();
                $exito = array("2","Actualizado");
				echo json_encode(array("exito" => $exito));

                
			} catch (Exception $exec) {
				$exito = array("4","error",$exec,$_POST["des"]);
            	echo json_encode(array("error" => $exito));
			}
		}
		
	}
	else{
		$exito = array("4.fin","error",$execute,$_POST["des"]);
            	echo json_encode(array("error" => $exito));
	}
	

?>