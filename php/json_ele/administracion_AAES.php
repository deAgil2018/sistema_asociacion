<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';

	if (isset($_POST[variable]) && $_POST[variable]=='1') {	
		$query = "INSERT INTO asociacion_aaes(nombre,telefono,fax,contacto_operador,contacto_comercial,contacto_documentos,direccion,email,estado)values(?,?,?,?,?,?,?,?,?)";

		try {
			$comando = Conexion::getInstance()->getDb()->prepare($query);
	        $comando->execute(array($_POST[nombre_asociacion],$_POST[telefono],$_POST[fax],$_POST[operador],$_POST[contacto_comercial],$_POST[contacto_documentos],$_POST[direccion],$_POST[email],'1'));
	        echo json_encode(array("exito" => "1"));
	       
		} catch (Exception $ex) {
			 echo json_encode(array("error" => $ex));
		}
	}
	else if (isset($_POST[variable]) && $_POST[variable]=='2') {	
		$query = "INSERT INTO asociacion_aaes(nombre,telefono,fax,contacto_operador,contacto_comercial,contacto_documentos,direccion,email,estado)values(?,?,?,?,?,?,?,?,?)";

		try {
			$comando = Conexion::getInstance()->getDb()->prepare($query);
	        $comando->execute(array($_POST[nombre_asociacion],$_POST[telefono],$_POST[fax],$_POST[operador],$_POST[contacto_comercial],$_POST[contacto_documentos],$_POST[direccion],$_POST[email],'1'));
	        echo json_encode(array("exito" => "1"));
	       
		} catch (Exception $ex) {
			 echo json_encode(array("error" => $ex));
		}
	}else if (isset($_POST[variable]) && $_POST[variable]=='3') {	//valida correos

		$sql = "SELECT email from asociacion_aaes where email = ? and email <> ? ";
		$email="";
		try {
			$comando = Conexion::getInstance()->getDb()->prepare($sql);
	        $comando->execute(array($_POST[email],$_POST[anterior]));
			while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                $email = $row['email'];
            }

            if($comando->rowCount()>0 && $email!=""){
            	$array = array("ya existe",$sql,$email);
            	echo json_encode(array("error" => $array));
            }else{
            	$array = array("no existe",$sql,$email);
            	echo json_encode(array("exito" => $array));
            }

	        
	       
		} catch (Exception $ex) {
			 echo json_encode(array("error" => $ex));
		}

	}

?>