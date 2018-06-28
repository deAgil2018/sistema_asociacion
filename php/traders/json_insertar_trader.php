<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';
	//$query = "INSERT INTO traders (nombre,telefono,FAX,TAX_ID,correo,direccion,identificador,codigo_oficina)values(?,?,?,?,?,?,?,?)";
	$query = "INSERT INTO traders (\"fax_ingresado\", \"tax_id\", \"codigo_oficina\", \"nombre\", \"identificador\", \"telefono\", \"correo\", \"direccion\")values(?,?,?,?,?,?,?,?)";

	try {
		$comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute(array($_POST[fax],$_POST[tax],$_POST[codigo_ofi],$_POST[nombre1],$_POST[identificador],$_POST[telefono],$_POST[email],$_POST[direccion]));
        echo json_encode(array("exito" => "1"));

	} catch (Exception $ex) {
		$array = array($ex->getMessage(),$ex->getLine(),$query);
		 echo json_encode(array("error" => $array));
	}


?>