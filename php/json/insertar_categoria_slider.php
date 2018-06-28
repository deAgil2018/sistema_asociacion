<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';
	$query = "INSERT INTO categoria_sliders(id,texto,enlace,id_categoria,id_perfil)values(?,?,?,?,?)";
	$h = date("Ymdsisus");

	$elid = "";
	try {
		
		$comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute(array($h,$_POST[nombre],$_POST[enlace],$_POST[categoria1],$_POST[codigo_ele]));
		echo json_encode(array("exito" => $h));     


	} catch (Exception $ex) {
		 echo json_encode(array("error" => $ex));
	}


?>