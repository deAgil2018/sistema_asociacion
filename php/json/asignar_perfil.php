<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';
	$eso=0;
	$elid = 0;
	try {
		$ca = $_POST['categorias_selec'];

        for ($i = 0; $i < count($ca); $i++) {
 
            $cat = "INSERT INTO perfiles_asignados(id_persona,id_categoria,id_perfil)values('".$_POST[elid]."','".$_POST['categorias_selec'][$i]."','".$_POST[laper]."')";
            $comando22 = Conexion::getInstance()->getDb()->prepare($cat);
            $comando22->execute();
            $e=$e+1;
        }
        
        echo json_encode(array("exito" => "1"));
      
	} catch (Exception $ex) {
		 echo json_encode(array("error" => $ex));
	}


?>