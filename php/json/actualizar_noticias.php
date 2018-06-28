<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");

	$query = "UPDATE contenido set contenido  = (?),id_categoria =(?),fecha=(?),estado=(?),nombre=(?) where id = (?)";
	$elid = "";
	try {
		$h = date("Ymdsisus");


		$dia = substr($_POST["fecha"],0,2);
        $mes = substr($_POST["fecha"],3,2);
        $anio = substr($_POST["fecha"],6,4);
        
        $fecha1 = $anio.'-'.$mes.'-'.$dia;


		$comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute(array($_POST[enlace],$_POST[categoria1],$fecha1,$_POST[estado],$_POST[nombreenlance],$_POST[codigo_id]));
		echo json_encode(array("exito" => "1"));     


	} catch (Exception $ex) {
		 echo json_encode(array("error" => $ex));
	}


?>