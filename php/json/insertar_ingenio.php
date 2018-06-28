<?php 
	@session_start();
	include_once("../../Conexion/Conexion.php");
	$estado = '1';
	$query = "INSERT INTO ingenio(\"nombre\",\"numero_fda\", \"direccion\", \"contacto_comercial\", \"contacto_operativo\", \"contacto_documentos\", \"contacto_otros\", \"correo\", \"nit\", \"nrc\", \"fax\", \"contacto_contabilidad_factura\", \"contacto_contabilidad_emision\", \"contacto_financiero\",\"codigo_oculto\")values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

	$query1 = "INSERT INTO foranea_oficinas_trader(\"codigo_trader\",\"codigo_oficina\")values(?,?)";
	$codigo_oculto=date("Yidisus");
	$id_oficina1="";
	try {
		$comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute(array($_POST[nombre1],$_POST[numero_fda],$_POST[direccion],$_POST[con_comercial],$_POST[con_operativo],$_POST[con_documentacion],$_POST[con_otros],$_POST[correo],$_POST[nit],$_POST[nrc],$_POST[fax],$_POST[con_emision],$_POST[con_factura],$_POST[con_financiero],$codigo_oculto));

        //codigo 
       /* $select_oficina = "SELECT id from oficinas_trader where codigo_oculto='".$codigo_oculto."'";
        $comando = Conexion::getInstance()->getDb()->prepare($select_oficina);
        $comando->execute();

        while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
            $id_oficina1 = $row['id'];
        }

       
        try {
        	$comando1 = Conexion::getInstance()->getDb()->prepare($query1);
        	$comando1->execute(array($_POST[trader],$id_oficina1));
        	echo json_encode(array("exito" => "1"));
        } catch (Exception $es) {
        	echo json_encode(array("error" => $es));
        	exit();
        }*/
       echo json_encode(array("exito" => "1"));
	} catch (Exception $ex) {
		$array =array($ex->getMessage(),$ex->getLine());
		 echo json_encode(array("error" => $array));
	}


?>