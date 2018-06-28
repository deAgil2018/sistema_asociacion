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
		$columnas=0;
		$contar = "SELECT count(id) as contadas from contenido";
		$contar_c = Conexion::getInstance()->getDb()->prepare($contar);
	    $contar_c->execute();
		while ($row_comando1 = $contar_c->fetch(PDO::FETCH_ASSOC)) {
			$columnas = $row_comando1[contadas];
		}
		$columnas = $columnas+1;

		if ($_POST[cat]=='6' || $_POST[cat]=='1' || $_POST[cat]=='7') {
			$fecha1 = date("Y-m-d");
			$consulta = "SELECT id from contenido where id_categoria = '$_POST[cat]' and id_perfil = '$_POST[perfil]'";
			$com = Conexion::getInstance()->getDb()->prepare($consulta);
	        $com->execute();
	        if ($cuenta = $com->rowCount()>0) {
	        	$query_update = "UPDATE contenido set contenido =(?), fecha = (?), nombre = (?) where id_perfil =(?) and id_categoria = (?)";
				try {
					$comando = Conexion::getInstance()->getDb()->prepare($query_update);
		        	$comando->execute(array($_POST[contenido],$fecha1,$_POST[catn],$_POST[perfil],$_POST[cat]));
					echo json_encode(array("exito" => "1"));     
				} catch (Exception $ex) {
					 echo json_encode(array("error" => $ex->getLine()));
				} 
	        }else{
		        	$query = "INSERT INTO contenido(id,contenido,id_perfil,id_categoria,fecha,estado,nombre)values(?,?,?,?,?,?,?)";
					$elid = "";
					try {
						$h = date("Ymdsisus");
						$h = $h.$columnas;
						$fecha1 = date("Y-m-d");

						$comando = Conexion::getInstance()->getDb()->prepare($query);
				        $comando->execute(array($h,$_POST[contenido],$_POST[perfil],$_POST[cat],$fecha1,'1',$_POST[catn]));
						echo json_encode(array("exito" => "1"));     


					} catch (Exception $ex) {
						 echo json_encode(array("error" => $ex));
					}
	        }

			

			
		}else{

			
				$query = "INSERT INTO contenido(id,contenido,id_perfil,id_categoria,fecha,estado,nombre)values(?,?,?,?,?,?,?)";
				$elid = "";
				try {
					$h = date("Ymdsisus");
					$h = $h.$columnas;
					//$fecha1 = date("Y-m-d");

					 
					//03/2017
					$mes = substr($_POST["fecha"],0,2);
			        $anio = substr($_POST["fecha"],3,4);
			        $dia = '01';
			        $fecha1 = $anio.'-'.$mes.'-'.$dia;
			       


					$comando = Conexion::getInstance()->getDb()->prepare($query);
			        $comando->execute(array($h,$_POST[contenido],$_POST[perfil],$_POST[cat],$fecha1,'1',$_POST[catn]));
					echo json_encode(array("exito" => $fecha1));     


				} catch (Exception $ex) {
					 echo json_encode(array("error" => $ex));
				}
			 

			
		}


	}

?>