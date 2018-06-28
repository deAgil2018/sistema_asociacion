<?php
@session_start();
$imagen=$nombre=$partido_politico=$alma_mater="";
include_once("../../Conexion/Conexion.php");
$sql = "SELECT
        id,
        nombre,
        nacimiento,
        nacionalidad,
        grado_academico,
        alma_mater,
        partido_politico,
        padres,
        madre,
        hermanos,
        conyuge,
        hijos,
        imagen,estado_civil
    FROM
        perfiles 
    WHERE
        codigo_generado = '$_POST[jejeje]'";

$imagen=$nombre=$partido_politico=$alma_mater="";
try {
         
        $comando = Conexion::getInstance()->getDb()->prepare($sql);
        $comando->execute();
        while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
            $imagen = $row['imagen'];
            $nombre = $row['nombre'];
            $nacimiento = $row['nacimiento'];
            $nacionalidad = $row['nacionalidad'];
            $grado_academico = $row['grado_academico'];
            $alma_mater = $row['alma_mater'];
            $partido_politico = $row['partido_politico'];
            $alma_mater = $row['alma_mater'];
            $padres = $row['padres'];
            $hermanos = $row['hermanos'];
            $conyuges = $row['conyuge'];
            $estado_civil = $row['estado_civil'];
            $madre = $row['madre'];
            $hijos = $row['hijos'];
            $elid = $row['id'];
        }

    
} catch (Exception $e) {
    
}

$html="";
$hnoticias="";
$fecha11 ="";
 
    /*******trayectoria y noticias*******/
    /****NOTICIAS******/
    $sql_noticias = "SELECT DISTINCT
                (c.id_categoria) AS id_categoria,
                c.contenido as elcontenido,
                DATE_FORMAT(c.fecha, '%d-%m-%Y') as lafecha,
                DATE_FORMAT(c.fecha, '%m-%Y') as lafecha11,
                c.nombre as elnombre2,
                cc.nombre as elnombre,
                c.id_perfil as elperfil
            FROM
                contenido AS c
            JOIN categorias as cc
            ON c.id_categoria = cc.id
            WHERE
                c.id_perfil = '$elid'
            and  DATE_FORMAT(c.fecha, '%m-%Y')='$_POST[fecha]'
            and c.id_categoria = '$_POST[categgo]'
            
            ORDER BY
                c.id_categoria DESC";

         
        $cc22 = Conexion::getInstance()->getDb()->prepare($sql_noticias);
        $cc22->execute();

        if($cc22->rowCount()>0){
            $simon2 = false;
                while ($rw3 = $cc22->fetch(PDO::FETCH_ASSOC)) {

                    $hnoticias.=$rw3[elcontenido];
                    $fecha11 = $rw3[lafecha11];
                    if ($simon2 == false) {
                        $html.='<div class="block full ">
                                            
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <a href="javascript:void(0)" id="marcador_'.$ele.'" class="a6 btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Asignar información a la categoría '.$rw3[elnombre]. '" data-nombrecategoria ="'.$rw3[elnombre].'"  data-perfil ="'.$rw3[elperfil].'" data-categoria="'.$rw3[id_categoria].'" data-nombrepersona="'.$nombre.'"><i class="fa fa-pencil"></i></a>
                                        </div>
                                            <h2><strong>Datos para la Categoría</strong> <span class="animation-pulse eleanimacionn1">'.$rw3[elnombre].'</span></h2>
                                    </div>';
                            $html.='<div class="row block-section eleangel_t">
                                        <div class="col-sm-12 text-left">';
                                        if (substr($rw3[elcontenido],0,4)=='http') {
                                            $html.='<a href='.$rw3[elcontenido].' target="_blank">'.$rw3[elcontenido].' ('.$rw3[lafecha].') '.'</a>';
                                        }
                                        else{
                                            $html.=$rw3[elcontenido];
                                        }  
                                $html.='</div> ';
                        $simon2 = true;
                    }
                    else{
                                $html.='<div class="col-sm-12 text-left">';
                                            if (substr($rw3[elcontenido],0,4)=='http') {
                                              $html.='<a href='.$rw3[elcontenido].' target="_blank">'.$rw3[elcontenido].' ('.$rw3[lafecha].') '.'</a>';
                                            }
                                            else{
                                                $html.=$rw3[elcontenido];
                                            }
                                $html.='</div>';                 
                    }
                     

                    
                }
                            $html.='</div>';
                        $html.='</div>';

            $exito = array("1",$html,$sql_noticias,$hnoticias,$fecha11);
            echo json_encode(array("exito" => $exito));  
        }else{
            $ss12 = "SELECT
                pc.id_perfil as elperfil,
                pc.id_categorias as lacategoria,
                c.nombre as elnombre1
            FROM
                perfiles_categorias as pc
                JOIN categorias as c ON pc.id_categorias = c.id
            WHERE
                pc.id_perfil = '$elid'
                AND pc.id_categorias = '$_POST[categgo]' 
                
                
                GROUP BY pc.id_categorias
            ORDER BY pc.id_categorias DESC";

            try {

                $comando_12 = Conexion::getInstance()->getDb()->prepare($ss12);
                $comando_12->execute();
                $ele = 0;
                while ($row_comando12 = $comando_12->fetch(PDO::FETCH_ASSOC)) {
                    $ele++;

                    $html.='<div class="block full ">
                                            
                                <div class="block-title">
                                    <div class="block-options pull-right">
                                        <a href="javascript:void(0)" id="marcador_'.$ele.'" class="a6 btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Asignar información a la categoría '.$row_comando12[elnombre1]. '" data-nombrecategoria ="'.$row_comando12[elnombre1].'"  data-perfil ="'.$row_comando12[elperfil].'" data-categoria="'.$row_comando12[lacategoria].'" data-nombrepersona="'.$nombre.'"><i class="fa fa-pencil"></i></a>
                                    </div>
                                    <h2><strong>Datos para la Categoría</strong> <span class="animation-pulse eleanimacionn1">'.$row_comando12[elnombre1]. '</span></h2>
                                </div>';
                        $html.='<div class="row block-section eleangel_t">
                                    <div class="col-sm-12 text-left">';
                             $html.='</div> ';
                        $html.='</div> ';
                    $html.='</div> ';

                }
                $exito = array("1",$html,$sql_noticias,$hnoticias,$fecha11);
                echo json_encode(array("exito" => $exito));

            } catch (Exception $e) {
                $exito = array("-1",$e->getMessage(),$e->getLine());
                echo json_encode(array("exito" => $exito));
            }
        }


 



?>