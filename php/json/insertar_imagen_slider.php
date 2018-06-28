<?php 
    @session_start();
    include_once("../../Conexion/Conexion.php");

    $file_path = "imagenes/";
    $file_path = $file_path . basename($_FILES['file-0']['name']);
    $file_path2 = "imagenes/";

    $trozos = explode(".", $file_path); 
    $extension = end($trozos);

    $id_prod=$_GET['id'];

    $nombre2=$file_path2."img_".$id_prod.date("Ymdsisus").".".$extension;

    $nombre3="img_".$id_prod.date("Ymdsisus").".".$extension;

    $nombre_anterior="";

    $sql_archivo = "SELECT imagen from categoria_sliders where id = '$id_prod'";

    $comando1 = Conexion::getInstance()->getDb()->prepare($sql_archivo);
    $comando1->execute();
    while ($row1 = $comando1->fetch(PDO::FETCH_ASSOC)) {
        $nombre_anterior = $row1["imagen"];
    }
    if ($nombre_anterior!="") {
        unlink($file_path2.$nombre_anterior);
    } 

    if(move_uploaded_file($_FILES['file-0']['tmp_name'], $file_path)) {

        rename($file_path, $nombre2);

        $sql = "UPDATE  categoria_sliders SET imagen = '$nombre3' where id = '$id_prod'";
        /*$sql = "UPDATE `t_producto` SET imagen = '".$nombre3."'";
        $sql.=" WHERE `id` = '$id_prod'";*/

        $comando4 = Conexion::getInstance()->getDb()->prepare($sql);
        if($comando4->execute()){
            echo json_encode(array("Exito" => "Exito al insertar adentro adentro adentro adntro " ));
        }else{
            echo json_encode(array("error" => "NO se puedo insertar adentro adentro adentro adentro " ));
        }


     
     }else{
          echo json_encode(array("error" => "NO se puedo insertar adentro adentro adentro adentro " ));
    }
?>