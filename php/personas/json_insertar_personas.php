<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';
	$query = "INSERT INTO personas(nombre,telefono,nivel,estado,correo,direccion,genero)values(?,?,?,?,?,?,?)";

	$query1 = "INSERT INTO usuarios(correo,password,usuario)values(?,?,?)";

	try {
		$comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute(array($_POST[nombre1],$_POST[telefono],$_POST[rol],'1',$_POST[email],$_POST[direccion],$_POST[sexo]));
        try {
        	$comando1 = Conexion::getInstance()->getDb()->prepare($query1);
        	$comando1->execute(array($_POST[email],$_POST[contra],$_POST[usuario]));
        	echo json_encode(array("exito" => "1"));
        } catch (Exception $es) {
        	echo json_encode(array("error" => $es));
        }
       
	} catch (Exception $ex) {
		 echo json_encode(array("error" => $ex));
	}


?>