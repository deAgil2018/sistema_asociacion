<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';
	$query = "INSERT INTO categorias(nombre,estado,padre,oculto)values(?,?,?,?)";
	$h = date("Ymdsisus");

	$elid = "";
	try {
		$select = "SELECT max(id) as maximo from categorias";
        $comando1= Conexion::getInstance()->getDb()->prepare($select);
		$comando1->execute();
		while ($row = $comando1->fetch(PDO::FETCH_ASSOC)) {
	        $elid = $row[maximo];
	    }
	    /*if ($_POST[categoria]=='0') {
	    	$_POST[categoria] = $elid+1;
	    }*/
		$comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute(array($_POST[nombre],'1',$_POST[categoria],$h));
		echo json_encode(array("exito" => "1"));     


	} catch (Exception $ex) {
		 echo json_encode(array("error" => $ex));
	}


?>