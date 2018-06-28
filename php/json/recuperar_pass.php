<?php 

include_once('../../Conexion/Envios.php');

try {
	$variable = Envios::recupearenviarmail($_POST["correo"]);
	$exito = array('1',"exito",$_POST["correo"],$variable);
	echo json_encode(array("exito" => $exito));
} catch (Exception $e) {
	$error = array("-1","error",$e,$_POST["correo"]);
	echo json_encode(array("error" => $error));
}

?>