<?php 
    @session_start();
    include_once("../../Conexion/Conexion.php");
    $estado = '1';
    
    if ($_POST[id]=='1') {
        $fecha1="";
        $query1 = "INSERT INTO contenido(id,contenido,id_perfil,id_categoria,fecha,estado,nombre)values(?,?,?,?,?,?,?)";

        $queryd = "DELETE FROM contenido where id_perfil ='$_POST[jejeje]'  and id_categoria = '$_POST[categgo]' and DATE_FORMAT(fecha, '%m-%Y')='$_POST[fecha]'";

        $elid = "";
        try {
            $h = date("Ymdsisus");
 

            $comando = Conexion::getInstance()->getDb()->prepare($queryd);
            $comando->execute();
            //01/2018
            

            echo json_encode(array("exito" => $queryd));     


        } catch (Exception $ex) {
             echo json_encode(array("error" => $ex));
        }
     


    }

?>