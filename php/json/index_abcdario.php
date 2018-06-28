<?php 
    $html = "";
    $contact_cat = array('Trip', 'Friends', 'Family', 'Work'); 
    $sql_sacar = "SELECT
                    nombre,
                    partido_politico,
                    imagen,
                    id 
                FROM
                    perfiles 
                WHERE
                    estado = '1' ";
    try {
        include_once("../../Conexion/Conexion.php");
        $comando_1 = Conexion::getInstance()->getDb()->prepare($sql_sacar);
        $comando_1->execute();
        while ($row1 = $comando_1->fetch(PDO::FETCH_ASSOC)) {
             
                       
 

        $html.="<div class='col-sm-6 col-lg-4'>
                    <div class='widget'>
                        <div class='widget-simple'>";
                       if($row1[imagen]==""){ 
                        $html.="<a href='nuevo_perfil.php'>
                                <img src='../img/imagenes_mias/user.svg' alt='avatar' class='widget-image img-circle pull-left animation-fadeIn'>
                            </a>";
                         } else{
                            $html.="<a href='nuevo_perfil.php'>
                                <img src='json/imagenes/$row1[imagen]' alt='avatar' class='widget-image img-circle pull-left animation-fadeIn'>
                            </a>";
                      }

                        $html.="<h4 class='widget-content text-right'>
                                <a href='nuevo_perfil.php' class='elea'>$row1[nombre]</a><br>
                                <span class='btn-group'>
                                    <a href='nuevo_perfil.php' class='btn btn-xs btn-default' data-toggle='tooltip' title='Partido Político'>$row1[partido_politico]</a>
                                    <a href='nuevo_perfil.php' class='btn btn-xs btn-warning' data-toggle='tooltip' title='Ver Perfil'><i class='gi gi-direction'></i></a>
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>";
  

               
                             }
                        } catch (Exception $e) {
                            echo $e;
                        }
                  



?>