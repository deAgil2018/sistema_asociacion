<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';
	
	if ($_POST[viene]=='1') {
		$fecha1="";
		$query1 = "INSERT INTO contenido(id,contenido,id_perfil,id_categoria,fecha,estado,nombre)values(?,?,?,?,?,?,?)";

		$queryd = "DELETE FROM contenido where id_perfil ='$_POST[id]'  and id_categoria = '$_POST[cat]' and DATE_FORMAT(fecha, '%m-%Y')='$_POST[fecha]'";

		$elid = "";
		try {
			$h = date("Ymdsisus");
 

			$comando = Conexion::getInstance()->getDb()->prepare($queryd);
	        $comando->execute();
	        //01/2018
			$mes = substr($_POST["fecha"],0,2);
	        $anio = substr($_POST["fecha"],3,4);
	         
	        $fecha1 = $anio.'-'.$mes.'-'.'01';


	        $comando1 = Conexion::getInstance()->getDb()->prepare($query1);
	        $comando1->execute(array($h,$_POST[contenido],$_POST[id],$_POST[cat],$fecha1,'1',$_POST[nombre]));


			echo json_encode(array("exito" => $fecha1));     


		} catch (Exception $ex) {
			 echo json_encode(array("error" => $ex));
		}
	 


	}

?>