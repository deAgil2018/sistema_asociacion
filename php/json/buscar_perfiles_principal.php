<?php 
@session_start();
    $html = "";
    $contact_cat = array('Trip', 'Friends', 'Family', 'Work'); 
    if ($_POST[letra]=='az') {
        if($_SESSION['nivel']=='1'){
            $sql_sacar = "SELECT
                    nombre,
                    partido_politico,
                    imagen,
                    id 
                FROM
                    perfiles 
                WHERE
                    estado = '1' GROUP BY id order by id";
        }else{
            $sql_sacar = "SELECT
                        p.id_persona,
                        p.id_categoria,
                      p.id_perfil,
                        per.nombre,
                        per.partido_politico,
                        per.imagen,
                        per.id 
                    FROM
                        perfiles_asignados as p
                    JOIN perfiles as per
                    on per.id = p.id_persona
                    WHERE
                        p.id_perfil = '$_SESSION[elid]'
                        and per.estado = '1' GROUP BY per.id";

        }
        
    }
    else if ($_POST[letra]=='2') {
        if($_SESSION['nivel']=='1'){
            $sql_sacar = "SELECT
                            pc.id_categorias,
                            pc.id_perfil,
                            pe.nombre,
                            pe.partido_politico,
                            pe.imagen,
                            pe.id as id,
                            pe.estado
                        FROM
                            perfiles_categorias as pc
                        JOIN perfiles as pe
                        ON pc.id_perfil = pe.id
                        WHERE
                            pc.id_categorias = '$_POST[id]'
                            and pe.estado = '1'";
        }else{
            $sql_sacar = "SELECT
                        p.id_persona,
                        p.id_categoria,
                        p.id_perfil,
                        per.nombre,
                        per.partido_politico,
                        per.imagen,
                        per.id 
                    FROM
                        perfiles_asignados as p
                    JOIN perfiles as per
                    on per.id = p.id_persona
                    WHERE
                        p.id_perfil = '$_SESSION[elid]'
                        and per.estado = '1' GROUP BY per.id";

        }
        
    }else{

        $sql_sacar11 = "SELECT
                        nombre,
                        partido_politico,
                        imagen,
                        id 
                    FROM
                        perfiles 
                    WHERE
                        nombre like '$_POST[letra]%' OR 'LOWER($_POST[letra])%'
                        and estado = '1' GROUP BY per.id";
        if($_SESSION['nivel']=='1'){
            $sql_sacar = "SELECT
                    nombre,
                    partido_politico,
                    imagen,
                    id 
                FROM
                    perfiles 
                WHERE
                    nombre like '$_POST[letra]%' OR 'LOWER($_POST[letra])%'
                    and estado = '1' GROUP BY id  ORDER BY id DESC";
        }else{
            $sql_sacar = "SELECT
                        p.id_persona,
                        p.id_categoria,
                      p.id_perfil,
                        per.nombre,
                        per.partido_politico,
                        per.imagen,
                        per.id 
                    FROM
                        perfiles_asignados as p
                    JOIN perfiles as per
                    on per.id = p.id_persona
                    WHERE
                        p.id_perfil = '$_SESSION[elid]'
                        and nombre like '$_POST[letra]%' OR 'LOWER($_POST[letra])%'
                    
                        and per.estado = '1' 
                        GROUP BY per.id
                        ORDER BY per.id DESC";

        }
    }
    $ele = 0;
    $conta = 0;
    try {
        include_once("../../Conexion/Conexion.php");
        $comando_1 = Conexion::getInstance()->getDb()->prepare($sql_sacar);
        $comando_1->execute();
        
        
        if ($comando_1->rowCount()>0) {
            $html.="<div class='row'>";
            while ($row1 = $comando_1->fetch(PDO::FETCH_ASSOC)) {

                if($ele < 3){
                    $html.="<div class='col-md-4 $conta' >
                            <div class='widget'>
                                <div class='widget-simple'>";
                               if($row1[imagen]==""){ 
                                $html.="<a href='perfil.php?ides=$row1[id]'>
                                        <img src='../img/imagenes_mias/user.svg' alt='avatar' class='widget-image img-circle pull-left animation-fadeIn'>
                                    </a>";
                                 } else{
                                    $html.="<a href='perfil.php?ides=$row1[id]'>
                                        <img src='json/imagenes/$row1[imagen]' alt='avatar' class='widget-image img-circle pull-left animation-fadeIn'>
                                    </a>";
                              }

                                $html.="<h4 class='widget-content text-right'>
                                        <a href='perfil.php?ides=$row1[id]' class='elea'>$row1[nombre]</a><br>
                                        <span class='btn-group'>
                                            <a href='perfil.php?ides=$row1[id]' class='btn btn-xs btn-default' data-toggle='tooltip' title='Partido Político'>Ver Perfil</a>
                                            <a href='perfil.php?ides=$row1[id]' class='btn btn-xs btn-warning' data-toggle='tooltip' title='Ver Perfil'><i class='gi gi-direction'></i></a>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        </div>";
                }else{
                    $ele = 0;
                    $html.="</div>";
                    $html.="<div class='row row_$ele' >";

                    $html.="<div class='col-md-4 $conta' >
                            <div class='widget'>
                                <div class='widget-simple'>";
                               if($row1[imagen]==""){ 
                                $html.="<a href='perfil.php?ides=$row1[id]'>
                                        <img src='../img/imagenes_mias/user.svg' alt='avatar' class='widget-image img-circle pull-left animation-fadeIn'>
                                    </a>";
                                 } else{
                                    $html.="<a href='perfil.php?ides=$row1[id]'>
                                        <img src='json/imagenes/$row1[imagen]' alt='avatar' class='widget-image img-circle pull-left animation-fadeIn'>
                                    </a>";
                              }

                                $html.="<h4 class='widget-content text-right'>
                                        <a href='perfil.php?ides=$row1[id]' class='elea'>$row1[nombre]</a><br>
                                        <span class='btn-group'>
                                            <a href='perfil.php?ides=$row1[id]' class='btn btn-xs btn-default' data-toggle='tooltip' title='Partido Político'>Ver Perfil</a>
                                            <a href='perfil.php?ides=$row1[id]' class='btn btn-xs btn-warning' data-toggle='tooltip' title='Ver Perfil'><i class='gi gi-direction'></i></a>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        </div>";
                }
                $conta++;
                $ele++;
                   
            }
        $html.="</div>";
        }else{
            $html.='<div class="alert alert-warning">
                        <h5><i class="fa fa-check"></i> <strong>Esta categiría</strong> no posee datos, seleccione otra por favor!</h5>
                    </div>';
        }

        
        
        $exito = array('1',$html,$sql_sacar,$conta);
        echo json_encode(array("exito" => $exito));
  
    } catch (Exception $e) {
        echo $e;
    }
                  



?>