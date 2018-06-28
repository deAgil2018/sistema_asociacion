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
        codigo_generado = '$_POST[jajaja]'";

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

if (isset($_POST[ele]) && $_POST[ele]=='10') {
  
    $ss12 = "SELECT
                pc.id_perfil as elperfil,
                pc.id_categorias as lacategoria,
                c.nombre as elnombre1
            FROM
                perfiles_categorias as pc
                JOIN categorias as c ON pc.id_categorias = c.id
            WHERE
                pc.id_perfil = '$elid'
                AND pc.id_categorias = '6' 
                or pc.id_categorias = '1'
                
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
                                    <a href="javascript:void(0)" id="marcador_'.$ele.'" class="a6  btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Asignar información a la categoría '.$row_comando12[elnombre1]. '" data-nombrecategoria ="'.$row_comando12[elnombre1].'"  data-perfil ="'.$row_comando12[elperfil].'" data-categoria="'.$row_comando12[lacategoria].'" data-nombrepersona="'.$nombre.'"><i class="fa fa-pencil"></i></a>

                                </div>
                                <h2><strong>Datos para la Categoría</strong> <span class="animation-pulse eleanimacion">'.$row_comando12[elnombre1]. '</span></h2>
                            </div>';
                    $html.='<div class="row block-section eleangel_t">
                                <div class="col-sm-12 text-left">';
                         $html.='</div> ';
                    $html.='</div> ';
                $html.='</div> ';

            }
            

        } catch (Exception $e) {
            $exito = array("-1",$e);
            echo json_encode(array("exito" => $exito));
        }





        $ss1 = "SELECT
                pc.id_perfil,
                pc.id_categorias,
                c.nombre as elnombre1
            FROM
                perfiles_categorias as pc
                JOIN categorias as c ON pc.id_categorias = c.id
            WHERE
                pc.id_perfil = '$elid'
                 
                and pc.id_categorias != '1'
                AND pc.id_categorias != '6'
                and pc.id_categorias != '7'
                GROUP BY pc.id_categorias
                ORDER BY pc.id_categorias DESC";
        try {

            $comando_1 = Conexion::getInstance()->getDb()->prepare($ss1);
            $comando_1->execute();
            $ele = 0;
            while ($row_comando1 = $comando_1->fetch(PDO::FETCH_ASSOC)) {
                $ele++;
                $html.='<div class="block full ">
                                        
                            <div class="block-title">
                                <div class="block-options pull-right">
                                    <a href="javascript:void(0)" id="marcador_'.$ele.'" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="para asignar información a la categoría'.$row_comando1[elnombre1]. ' por favor haga click aqui" data-original-title="Clic para agregar datos"><i class="fa fa-pencil"></i></a>
                                </div>
                                <h2><strong>Datos para la Categoría</strong> <span class="animation-pulse eleanimacion">'.$row_comando1[elnombre1]. '</span></h2>
                            </div>';
                    $html.='<div class="row block-section eleangel_t">
                                <div class="col-sm-12 text-left">';
                         $html.='</div> ';
                    $html.='</div> ';
                $html.='</div> ';

            }
            
             


            $exito = array("1",$html,$ss1,$ss12);
            echo json_encode(array("exito" => $exito));
            

        } catch (Exception $e) {
            $exito = array("-1",$e);
            echo json_encode(array("exito" => $exito));
        }
/***termina if principal y viene el de cargar datos***/
}else{

    /*******trayectoria y noticias*******/
    /****NOTICIAS******/
    $sql_noticias = "SELECT DISTINCT
                (c.id_categoria) AS id_categoria,
                c.contenido as elcontenido,
                DATE_FORMAT(c.fecha, '%d-%m-%Y') as lafecha,
                
                c.nombre as elnombre2,
                cc.nombre as elnombre,
                c.id_perfil as elperfil
            FROM
                contenido AS c
            JOIN categorias as cc
            ON c.id_categoria = cc.id
            WHERE
                c.id_perfil = '$elid'
             
            and c.id_categoria = '6'
            
            ORDER BY
                c.id_categoria DESC";

         
        $cc22 = Conexion::getInstance()->getDb()->prepare($sql_noticias);
        $cc22->execute();

        if($cc22->rowCount()>0){
            $simon2 = false;
                while ($rw3 = $cc22->fetch(PDO::FETCH_ASSOC)) {

                    $hnoticias.=$rw3[elcontenido];
                    if ($simon2 == false) {
                        $html.='<div class="block full ">
                                            
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <button type="button" id="ver_ele" data-perfil ="'.$rw3[elperfil].'" class="btn btn-alt btn-xs btn-primary">Ver Perfil</button>
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

                /*$exito = array("1",$html,$sql_noticias,$hnoticias);
                echo json_encode(array("exito" => $exito));*/
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
                AND pc.id_categorias = '6' 
               
                
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
                        $html.='</div>';
                    $html.='</div> ';

                }
                /*$exito = array("1",$html,$sql_noticias,$hnoticias);
                echo json_encode(array("exito" => $exito));*/

            } catch (Exception $e) {
                /*$exito = array("-1",$e);
                echo json_encode(array("exito" => $exito));*/
            }
        }






    /****TRAYECTORIA******/
    $sql_trayectoria = "SELECT DISTINCT
                (c.id_categoria) AS id_categoria,
                c.contenido as elcontenido,
                DATE_FORMAT(c.fecha, '%d-%m-%Y') as lafecha,
                
                c.nombre as elnombre2,
                cc.nombre as elnombre,
                c.id_perfil as elperfil
            FROM
                contenido AS c
            JOIN categorias as cc
            ON c.id_categoria = cc.id
            WHERE
                c.id_perfil = '$elid'
             
            and c.id_categoria = '7'
            
            ORDER BY
                c.id_categoria DESC";

         
        $cc22_tra = Conexion::getInstance()->getDb()->prepare($sql_trayectoria);
        $cc22_tra->execute();

        if($cc22_tra->rowCount()>0){
            $simon2_tra = false;
                while ($rw3_tra = $cc22_tra->fetch(PDO::FETCH_ASSOC)) {

                    $hnoticias.=$rw3_tra[elcontenido];
                    if ($simon2_tra == false) {
                        $html.='<div class="block full ">
                                            
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <a href="javascript:void(0)" id="marcador_'.$ele.'" class="a6 btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Asignar información a la categoría '.$rw3_tra[elnombre]. '" data-nombrecategoria ="'.$rw3_tra[elnombre].'"  data-perfil ="'.$rw3_tra[elperfil].'" data-categoria="'.$rw3_tra[id_categoria].'" data-nombrepersona="'.$nombre.'"><i class="fa fa-pencil"></i></a>
                                        </div>
                                            <h2><strong>Datos para la Categoría</strong> <span class="animation-pulse eleanimacionn1">'.$rw3_tra[elnombre].'</span></h2>
                                    </div>';
                            $html.='<div class="row block-section eleangel_t">
                                        <div class="col-sm-12 text-left">';
                                        if (substr($rw3_tra[elcontenido],0,4)=='http') {
                                            $html.='<a href='.$rw3_tra[elcontenido].' target="_blank">'.$rw3_tra[elcontenido].' ('.$rw3_tra[lafecha].') '.'</a>';
                                        }
                                        else{
                                            $html.=$rw3_tra[elcontenido];
                                        }  
                                $html.='</div> ';
                        $simon2_tra = true;
                    }
                    else{
                                $html.='<div class="col-sm-12 text-left">';
                                            if (substr($rw3_tra[elcontenido],0,4)=='http') {
                                              $html.='<a href='.$rw3_tra[elcontenido].' target="_blank">'.$rw3_tra[elcontenido].' ('.$rw3[lafecha].') '.'</a>';
                                            }
                                            else{
                                                $html.=$rw3_tra[elcontenido];
                                            }
                                $html.='</div>';                 
                    }
                     

                    
                }
                            $html.='</div>';
                        $html.='</div>';

                /*$exito = array("1",$html,$sql_noticias,$hnoticias);
                echo json_encode(array("exito" => $exito));*/
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
                AND pc.id_categorias = '7' 
               
                
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
                /*$exito = array("1",$html,$sql_noticias,$hnoticias);
                echo json_encode(array("exito" => $exito));*/

            } catch (Exception $e) {
                /*$exito = array("-1",$e);
                echo json_encode(array("exito" => $exito));*/
            }
        }
        

        /*otras categorias**/

        $cat_asignadas = "SELECT
                pc.id_perfil as elperfil,
                pc.id_categorias as lacategoria,
                c.nombre as elnombre1
            FROM
                perfiles_categorias as pc
                JOIN categorias as c ON pc.id_categorias = c.id
            WHERE
                pc.id_perfil = '$elid'
                AND pc.id_categorias != '6'
                AND pc.id_categorias != '7'
                AND pc.id_categorias != '14'
                AND pc.id_categorias != '15'
                AND pc.id_categorias != '16'
                AND pc.id_categorias != '17'
            GROUP BY pc.id_categorias
            ORDER BY pc.id_categorias DESC";


        try {
            $ccat_1 = Conexion::getInstance()->getDb()->prepare($cat_asignadas);
            $ccat_1->execute();
            while ($r1 = $ccat_1->fetch(PDO::FETCH_ASSOC)) {

                    $sql_cat = "SELECT DISTINCT
                        (c.id_categoria) AS id_categoria,
                        c.contenido as elcontenido,
                        DATE_FORMAT(c.fecha, '%d-%m-%Y') as lafecha,
                        DATE_FORMAT(c.fecha, '%m-%Y') as lafecha1,
                        
                        c.nombre as elnombre2,
                        cc.nombre as elnombre,
                        c.id_perfil as elperfil
                    FROM
                        contenido AS c
                    JOIN categorias as cc
                    ON c.id_categoria = cc.id
                    WHERE
                        c.id_perfil = '$elid'
                     
                    and c.id_categoria = '$r1[lacategoria]'
                    

                    
                    ORDER BY

                        c.fecha,
                        c.id_categoria DESC";

                 
                $ccat = Conexion::getInstance()->getDb()->prepare($sql_cat);
                $ccat->execute();

                if($ccat->rowCount()>0){
                    $simon2 = false;
                    $mes_actual="";
                        while ($rw3_cat = $ccat->fetch(PDO::FETCH_ASSOC)) {

                            $hnoticias.=$rw3[elcontenido];

                            
 

                            if ($simon2 == false) {
                                $html.='<div class="block full ">
                                                    
                                            <div class="block-title">
                                                <div class="block-options pull-right">
                                                    <a href="javascript:void(0)" id="marcador_'.$ele.'" class="a7 btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Asignar información a la categoría '.$rw3_cat[elnombre]. '" data-nombrecategoria ="'.$rw3_cat[elnombre].'"  data-perfil ="'.$rw3_cat[elperfil].'" data-categoria="'.$rw3_cat[id_categoria].'" data-fecha ="'.$rw3_cat[lafecha].'" data-nombrepersona="'.$nombre.'"><i class="fa fa-pencil"></i></a>
                                                </div>
                                                    <h2><strong>Datos para la Categoría</strong> <span class="animation-pulse eleanimacionn1">'.$rw3_cat[elnombre].'</span></h2>
                                            </div>';

                                        $time = strtotime($rw3_cat[lafecha]);
                                        $newformat = date('F',$time);
                                        $newformat2 = date('Y',$time);
                                        $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
                                        $mes=date('n',$time)-1;
                                        $mes_actual = $mes;

                                $html.='<div class="row block-section eleangel_t">

                                                
                                                    
                                                 
                                                <div class="col-sm-12 if text-left">
                                                
                                                    <div class="btn-group">
                                                        <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-alt btn-success dropdown-toggle" aria-expanded="false"   >'.$rw3_cat[elnombre].' '.$meses[$mes].' '.$newformat2. ' <span class="caret"></span></a>
                                                        <ul class="dropdown-menu dropdown-custom text-left">
                                                            <li class="dropdown-header">Seleccione Acción</li>
                                                            <li>
                                                                <a href="javascript:void(0)" class="a77"  title="Editar información de la categoría '.$rw3_cat[elnombre]. '" data-nombrecategoria ="'.$rw3_cat[elnombre].'"  data-perfil ="'.$rw3_cat[elperfil].'" data-categoria="'.$rw3_cat[id_categoria].'" data-fecha ="'.$rw3_cat[lafecha1].'" data-nombrepersona="'.$nombre.'" ><i class="fa fa-pencil pull-right"></i>Editar</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <a href="javascript:void(0)" class="a88" title="Editar información de la categoría '.$rw3_cat[elnombre]. '" data-nombrecategoria ="'.$rw3_cat[elnombre].'"  data-perfil ="'.$rw3_cat[elperfil].'" data-categoria="'.$rw3_cat[id_categoria].'" data-fecha ="'.$rw3_cat[lafecha1].'" data-nombrepersona="'.$nombre.'"><i class="fa fa-trash pull-right"></i>Eliminar</a>
                                                            </li>
                                                        </ul>
                                                    </div><br><br>
                                                ';
                                                if (substr($rw3_cat[elcontenido],0,4)=='http') {
                                                    $html.='<a href='.$rw3_cat[elcontenido].' target="_blank">'.$rw3_cat[elcontenido].' ('.$rw3_cat[lafecha].') '.'</a>';
                                                }
                                                else{
                                                    $html.=$rw3_cat[elcontenido];
                                                }  
                                        $html.='</div> ';
                                $simon2 = true;
                            }
                            else{      

                                       $time = strtotime($rw3_cat[lafecha]);
                                       $newformat = date('F',$time);
                                       $newformat2 = date('Y',$time);
                                       $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
                                       $mes=date('n',$time)-1;

                                        if ($mes_actual == $mes) {

                                            $html.='<div class="col-sm-12 else text-left"> ';
                                                    if (substr($rw3_cat[elcontenido],0,4)=='http') {
                                                      $html.='<a href='.$rw3_cat[elcontenido].' target="_blank">'.$rw3_cat[elcontenido].' ('.$rw3_cat[lafecha].') '.'</a>';
                                                    }
                                                    else{
                                                        $html.=$rw3_cat[elcontenido];
                                                    }
                                            $html.='</div>'; 

                                            
                                        }else{
                                            $html.='<div class="col-sm-12 else text-left"> 
                                                        <div class="btn-group">
                                                            <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-alt btn-success dropdown-toggle" aria-expanded="false"   >'.$rw3_cat[elnombre].' '.$meses[$mes].' '.$newformat2. ' <span class="caret"></span></a>
                                                            <ul class="dropdown-menu dropdown-custom text-left">
                                                                <li class="dropdown-header">Seleccione Acción</li>
                                                                <li>
                                                                    <a href="javascript:void(0)" class="a77"  title="Editar información de la categoría '.$rw3_cat[elnombre]. '" data-nombrecategoria ="'.$rw3_cat[elnombre].'"  data-perfil ="'.$rw3_cat[elperfil].'" data-categoria="'.$rw3_cat[id_categoria].'" data-fecha ="'.$rw3_cat[lafecha1].'" data-nombrepersona="'.$nombre.'" ><i class="fa fa-pencil pull-right"></i>Editar</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <a href="javascript:void(0)" class="a88" title="Editar información de la categoría '.$rw3_cat[elnombre]. '" data-nombrecategoria ="'.$rw3_cat[elnombre].'"  data-perfil ="'.$rw3_cat[elperfil].'" data-categoria="'.$rw3_cat[id_categoria].'" data-fecha ="'.$rw3_cat[lafecha1].'" data-nombrepersona="'.$nombre.'"><i class="fa fa-trash pull-right"></i>Eliminar</a>
                                                                </li>
                                                            </ul>
                                                        </div><br><br>


                                            ';
                                                    if (substr($rw3_cat[elcontenido],0,4)=='http') {
                                                      $html.='<a href='.$rw3_cat[elcontenido].' target="_blank">'.$rw3_cat[elcontenido].' ('.$rw3_cat[lafecha].') '.'</a>';
                                                    }
                                                    else{
                                                        $html.=$rw3_cat[elcontenido];
                                                    }
                                            $html.='</div>'; 
                                            $mes_actual = $mes;          
                                        }


                                              
                            }
                             

                            
                        }
                                    $html.='</div>';
                                $html.='</div>';

                        /*$exito = array("1",$html,$sql_noticias,$hnoticias,$cat_asignadas);
                        echo json_encode(array("exito" => $exito));*/
                }else{
                    $sql_cat = "SELECT
                        pc.id_perfil as elperfil,
                        pc.id_categorias as lacategoria,
                        c.nombre as elnombre1
                    FROM
                        perfiles_categorias as pc
                        JOIN categorias as c ON pc.id_categorias = c.id
                    WHERE
                        pc.id_perfil = '$elid'
                        AND pc.id_categorias = '$r1[lacategoria]'
                        

                       
                        
                        GROUP BY pc.id_categorias
                    ORDER BY pc.id_categorias DESC";

                    try {

                        $comando_122 = Conexion::getInstance()->getDb()->prepare($sql_cat);
                        $comando_122->execute();
                        $ele = 0;
                        while ($row_comando122 = $comando_122->fetch(PDO::FETCH_ASSOC)) {
                            $ele++;

                            $html.='<div class="block full ">
                                                    
                                        <div class="block-title">
                                            <div class="block-options pull-right">
                                                <a href="javascript:void(0)" id="marcador_'.$ele.'" class="a7 btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Asignar información a la categoría '.$row_comando122[elnombre1]. '" data-nombrecategoria ="'.$row_comando122[elnombre1].'"  data-perfil ="'.$row_comando122[elperfil].'" data-categoria="'.$row_comando122[lacategoria].'" data-nombrepersona="'.$nombre.'"><i class="fa fa-pencil"></i></a>
                                            </div>
                                            <h2><strong>Datos para la Categoría:</strong> <span class="animation-pulse eleanimacionn1">'.$row_comando122[elnombre1]. '</span></h2>
                                        </div>';
                                $html.='<div class="row block-section eleangel_t">
                                            <div class="col-sm-12 text-left">';
                                     $html.='</div> ';
                                $html.='</div>';
                            $html.='</div> ';

                        }
                        /*$exito = array("1",$html,$sql_noticias,$hnoticias);
                        echo json_encode(array("exito" => $exito));*/

                    } catch (Exception $e) {
                        $html.=$e;
                        /*$exito = array("-1",$e);
                        echo json_encode(array("exito" => $exito));*/
                    }
                }

            }

            $exito = array("1",$html,$sql_noticias,$hnoticias);
            echo json_encode(array("exito" => $exito));
            
        } catch (Exception $e) {
            
        }
        


        
     



}



?>