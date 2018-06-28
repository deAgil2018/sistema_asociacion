<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';
	$eso=0;
	$elid = 0;
	$query = "INSERT INTO perfiles(nombre,nacimiento,nacionalidad,grado_academico,alma_mater,partido_politico,estado_civil,padres,madre,hermanos,hijos,conyuge,estado,codigo_generado)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

	try {

		$codigo_generado = date("Ymdhmsisus");

		$select = "SELECT max(id) as maximo from perfiles";
        $comando1= Conexion::getInstance()->getDb()->prepare($select);
		$comando1->execute();
		while ($row = $comando1->fetch(PDO::FETCH_ASSOC)) {
	        $elid = $row[maximo];
	    }

	    $eso = ($elid+1);
		$ca = $_POST['categorias_selec'];

        for ($i = 0; $i < count($ca); $i++) {
 
            $cat = "INSERT into perfiles_categorias(id_categorias,id_perfil)values('".$_POST['categorias_selec'][$i]."','".$eso."')";
            $comando22 = Conexion::getInstance()->getDb()->prepare($cat);
            $comando22->execute();
            $e=$e+1;
        }


		$comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute(array($_POST[nombre],$_POST[nacimiento],$_POST[nacionalidad],$_POST[acedemico],$_POST[mater],$_POST[partido],$_POST[estado_civil],$_POST[padre],$_POST[madre],$_POST[hermanos],$_POST[hijos],$_POST[conyuge],$estado,$codigo_generado));

        echo json_encode(array("exito" => $codigo_generado));
      
	} catch (Exception $ex) {
		 echo json_encode(array("error" => $ex->getMessage()));
	}


?>