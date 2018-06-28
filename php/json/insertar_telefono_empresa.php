<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';
	$query = "INSERT INTO telefonos_empresa(\"nombre\", \"telefono\", \"codigo_oculto\")values(?,?,?)";

	$query1 = "INSERT INTO foranea_telefonos_empresa(\"id_telefonos\",\"id_empresa\")values(?,?)";
	$codigo_oculto=date("Yidisus");
	$id_oficina1="";
	try {
		$comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute(array($_POST[nombre1],$_POST[telefono1],$codigo_oculto));

        //codigo 
        $select_tel = "SELECT id from telefonos_empresa where codigo_oculto='".$codigo_oculto."'";
        $comando = Conexion::getInstance()->getDb()->prepare($select_tel);
        $comando->execute();

        while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
            $id_tel = $row['id'];
        }

       
        try {
        	$comando1 = Conexion::getInstance()->getDb()->prepare($query1);
        	$comando1->execute(array($id_tel,$_POST[ingenio]));
        	echo json_encode(array("exito" => "1"));
        } catch (Exception $es) {
        	echo json_encode(array("error" => $es));
        	exit();
        }
       
	} catch (Exception $ex) {
		$array =array($ex->getMessage(),$ex->getLine());
		 echo json_encode(array("error" => $array));
	}


?>