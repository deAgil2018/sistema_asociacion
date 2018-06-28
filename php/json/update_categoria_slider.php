<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';

	$query = "UPDATE categoria_sliders SET texto = ?, enlace = ?, id_categoria=? where id=? and id_perfil=?";
	$elid = "";
	try {
		$array = array($_POST[nombre],$_POST[enlace],$_POST[categoria1],$_POST[codigo_id_row],$_POST[codigo_perfil]);
		$comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute(array($_POST[nombre],$_POST[enlace],$_POST[categoria1],$_POST[codigo_id_row],$_POST[codigo_perfil]));
		echo json_encode(array("exito" => $_POST[codigo_id_row]));     


	} catch (Exception $ex) {
		 echo json_encode(array("error" => $ex));
	}


?>