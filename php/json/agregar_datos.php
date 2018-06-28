<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';
	
	if ($_POST[viene]=='1') {

		$query = "INSERT INTO contenido(id,contenido,id_perfil,id_categoria,fecha,estado,nombre)values(?,?,?,?,?,?,?)";
		$elid = "";
		try {
			$h = date("Ymdsisus");


			$dia = substr($_POST["fecha"],0,2);
	        $mes = substr($_POST["fecha"],3,2);
	        $anio = substr($_POST["fecha"],6,4);
	        
	        $fecha1 = $anio.'-'.$mes.'-'.$dia;


			$comando = Conexion::getInstance()->getDb()->prepare($query);
	        $comando->execute(array($h,$_POST[enlace],$_POST[perfil_h],$_POST[categoria_h],$fecha1,'1',$_POST[nombreenlance]));
			echo json_encode(array("exito" => "1"));     


		} catch (Exception $ex) {
			 echo json_encode(array("error" => $ex));
		}
	}else{


		$query = "INSERT INTO contenido(id,contenido,id_perfil,id_categoria,fecha,estado,nombre)values(?,?,?,?,?,?,?)";
		$elid = "";
		try {
			$h = date("Ymdsisus");
			$fecha1 = date("Y-m-d");

			$dia = substr($_POST["fecha"],0,2);
	        $mes = substr($_POST["fecha"],3,2);
	        $anio = substr($_POST["fecha"],6,4);
	        
	       


			$comando = Conexion::getInstance()->getDb()->prepare($query);
	        $comando->execute(array($h,$_POST[contenido],$_POST[id],$_POST[cat],$fecha1,'1',$_POST[catn]));
			echo json_encode(array("exito" => "1"));     


		} catch (Exception $ex) {
			 echo json_encode(array("error" => $ex));
		}


	}

?>