<?php 
include_once("../../Conexion/Conexion.php");

$consulta="SELECT
                u.ID,
                u.correo,
                u.password,
                per.nombre,
                per.estado 
                FROM
                usuarios AS u
                JOIN personas AS per ON u.correo = per.correo

                WHERE
                u.correo = 'chalogonzruiz@gmail.com' 
                AND u.password = 'tucutan' 
                and estado='1'";
try{
    $comando = Conexion::getInstance()->getDb()->prepare($consulta);
    $comando->execute();
    while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
        print_r($row);
        
    }
} catch (Exception $e) {
    print_r($e);
}

?>