<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';
	//$query = "INSERT INTO traders (nombre,telefono,FAX,TAX_ID,correo,direccion,identificador,codigo_oficina)values(?,?,?,?,?,?,?,?)";
	$query = "INSERT INTO operadores_carga (\"nit\", \"email\", \"credito\", \"nombre\", \"detalle_cuenta_bancaria_nombre\", \"detalle_cuenta_bancaria_numero\", \"cheque_nombre_de\")values(?,?,?,?,?,?,?)";

	try {
		$comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute(array($_POST[nit1],$_POST[correo1],$_POST[credito1],$_POST[nombre1],$_POST[detalle_nombre1],$_POST[detalle_numero1],$_POST[cheque_nombre1]));
        echo json_encode(array("exito" => "1"));

	} catch (Exception $ex) {
		$array = array($ex->getMessage(),$ex->getLine(),$query);
		 echo json_encode(array("error" => $array));
	}

?>