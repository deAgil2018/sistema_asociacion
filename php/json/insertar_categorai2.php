<?php 
  @session_start();
  include_once("../../Conexion/Conexion.php");
  $estado = '1';
  $query = "INSERT INTO categorias(nombre,estado,padre,oculto)values(?,?,?,?)";
  $h = date("Ymdsisus");

  $elid = "";
  $html = "";
  $eso=0;
  $cat="";
  $albums = array();
  try {
    $select = "SELECT max(id) as maximo from categorias";
        $comando1= Conexion::getInstance()->getDb()->prepare($select);
    $comando1->execute();
    while ($row = $comando1->fetch(PDO::FETCH_ASSOC)) {
          $elid = $row[maximo];
      }
      if ($_POST[categoria]=='0') {
        //$_POST[categoria] = $elid+1;
        $eso = $elid+1;
      }
    $comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute(array($_POST[nombre],'1',$_POST[categoria],$h));

       


         


      $albums1 = array();
      
      $sql1= "SELECT id,padre, nombre FROM categorias where padre = '0' order by padre asc";
      $comando1 = Conexion::getInstance()->getDb()->prepare($sql1);
      $comando1->execute();
      $previous1 = "";
      $first_group1 = true;
     
      while ($row1 = $comando1->fetch(PDO::FETCH_ASSOC)) {

          array_push($albums, $row1);
          $sacado_cargo1 .=" <option value='".$row1['id']."'>".$row1['nombre']."</option>";
      }


        /*$album_type = '';
        foreach ($albums as $album) {
          if ($album_type != $album['padre']) {
            if ($album_type != '') {
              $html.= '</optgroup>';
            }
            $html.= '<optgroup label="'.ucfirst($album['nombre']).'">';
          }
           $html.=  '<option value="'.$album['id'].'">'.htmlspecialchars($album['nombre']).'</option>';
          $album_type = $album['padre'];    
        }
        if ($album_type != '') {
           $html.=  '</optgroup>';
        }*/




        $album_type = '';
        $ele = 0;

        foreach ($albums as $album) {

            $html.= '<optgroup label="'.ucfirst($album['nombre']).'">';
      
            $mas = "SELECT id,nombre FROM categorias WHERE padre = '$album[id]' order by nombre asc ";
            //echo $mas;
            $comando2 = Conexion::getInstance()->getDb()->prepare($mas);
            $comando2->execute();
            $es = false;
            while ($row2= $comando2->fetch(PDO::FETCH_ASSOC)) {

               $html.= '<option value="'.$row2['id'].'">'.htmlspecialchars($row2['nombre']).'</option>';
               $es = true;
                 
            }

            
                $html.= '<option value="'.$album['id'].'">'.htmlspecialchars($album['nombre']).'</option>';
           
            $html.= '</optgroup>';
              


          
        }





      $exito = array('1',$html,$cat);
      echo json_encode(array("exito" => $exito));     


  } catch (Exception $ex) {
     echo json_encode(array("error" => $ex));
  }


?>