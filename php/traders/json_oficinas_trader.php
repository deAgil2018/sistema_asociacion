<?php 
    @session_start();
    include_once("../../Conexion/Conexion.php");
    $estado = '1';
    $html="";
    $as = 0;
    if (isset($_POST[des]) && $_POST[des]=='1') { 
        $html.='<div class="block full">
       
                    <div class="block-title">
                        <div class="block-options pull-right">
                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                        </div>
                        <h2><strong>Listado</strong> Registrado</h2>
                    </div>
        
                    <table id="oficinas_tabla" class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                
                                <th class="text-left">Nombre</th>
                                <th class="text-left">Código de Contrato</th>
                                <th class="text-left">Contacto Operativo</th>
                                <th class="text-left">Contacto Comercial</th>
                                <th class="text-left hidden-xs">Contacto Financiero</th>
                                <th class="text-left">Contacto Documentación</th>
                                <th class="text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>';
                            
                            $labels['0']['class']   = "label-success";
                            $labels['0']['text']    = "Available";
                            $labels['1']['class']   = "label-danger";
                            $labels['1']['text']    = "Out of Stock";
                            
  
                            $sql = "SELECT 
                                f.codigo_trader,
                                f.codigo_oficina,
                                p.id,
                                p.nombre,
                                p.codigo_contrato,
                                p.contacto_operativo,
                                p.contacto_comercial,
                                p.otros,
                                p.direccion,
                                p.codigo_postal,
                                p.contacto_financiero,
                                p.contacto_documentos
                            FROM
                                oficinas_trader as p JOIN
                                foranea_oficinas_trader AS f
                                ON p.id = f.codigo_oficina
                            WHERE f.codigo_trader = '$_POST[eltrader]'
                            ORDER BY nombre desc";

                            try {
                                
                                $comando = Conexion::getInstance()->getDb()->prepare($sql);
                                $comando->execute();
                                
                                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                                    $as++;
                                    $html.="<tr>";
                                  
                                    $html.="<td>$row[nombre]</td>";
                                    $html.="<td>$row[codigo_contrato]</td>";
                                    $html.="<td>$row[contacto_operativo]</td>";
                                    $html.="<td>$row[contacto_comercial]</td>";
                                    $html.="<td>$row[contacto_financiero]</td>";
                                    $html.="<td>$row[contacto_documentos]</td>";

                                    $html.="<td class='text-center'>";
                                  
                                            $html.="<div class='btn-group btn-group-xs'>
                                                        <a href='javascript:void(0)' id='a_datos' data-iid ='$row[id]' data-coficina='$row[codigo_oficina]' data-ctrader='$row[codigo_trader]' data-ccontrato='$row[codigo_contrato]' data-direccion='$row[direccion]' data-nombre ='$row[nombre]' data-cpostal ='$row[codigo_postal]' data-conoperativo ='$row[contacto_operativo]' data-concomercial ='$row[contacto_comercial]' data-otros ='$row[otros]' data-confinanciero ='$row[contacto_financiero]' data-condocumentos ='$row[contacto_documentos]' data-id ='$row[id]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal' class='text-center' ><i class='fa fa-eye pull-right'></i></a>
                                                    </div>";
                                    $html.="</td>";//cambio

                                      
                                        
                                }
                            }
                        
                             catch (Exception $ex) {
                                $html.= $ex;
                            }
                               
                          
             
                         $html.="</tbody>
                    </table>
                </div>";

        if ($as >0) {
            $array = array("1",$as,$html,sql);
             echo json_encode(array("exito" => $array));
        }else{
            $array = array("0",$as,$html,sql,$ex);
            echo json_encode(array("error" => $array));
        }
    }else if(isset($_POST[des]) && $_POST[des]=='2'){

        $html2="";
        $query = "SELECT
                    f.codigo_trader,
                    f.codigo_oficina,
                    P.ID,
                    P.nombre,
                    P.codigo_contrato,
                    P.contacto_operativo,
                    P.contacto_comercial,
                    P.otros,
                    P.direccion,
                    P.codigo_postal,
                    P.contacto_financiero,
                    P.contacto_documentos 
                FROM
                    oficinas_trader
                    AS P JOIN foranea_oficinas_trader AS f ON P.ID = f.codigo_oficina 
                WHERE
                    f.codigo_oficina =  '$_POST[eltrader]'
                ORDER BY
                    nombre DESC";

        try {
                         
            $comando = Conexion::getInstance()->getDb()->prepare($query);
            $comando->execute();
            
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                $as++;
                $nombre = $row[nombre];
                $codito_contrato = $row[codigo_contrato];
                $contacto_operativo = $row[contacto_operativo];
                $contacto_comercial=$row[contacto_comercial];
                $contacto_financiero=$row[contacto_financiero];
                $contacto_documentos=$row[contacto_documentos];

                    
            }
            $html2.='<table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Dato</th>
                            <th>Información</th>
                            
                          </tr>
                        </thead>
                        <tbody>';    
            $html2.='<tr>
                        <td>Nombre</td>
                        <td>'.$nombre.'</td>
                         
                      </tr>
                      <tr>
                        <td>Contacto Operativo</td>
                        <td>'.$contacto_operativo.'</td>
                         
                      </tr>
                      <tr>
                        <td>Contacto Comercial</td>
                        <td>'.$contacto_comercial.'</td>
                         
                      </tr>
                      <tr>
                        <td>Contacto Financiero</td>
                        <td>'.$contacto_financiero.'</td>
                         
                      </tr>
                      <tr>
                        <td>Contacto Documentos</td>
                        <td>'.$contacto_documentos.'</td>
                         
                      </tr>
                </tbody>
            </table>';
            $array1 = array("1",$as,$html2,query);
            echo json_encode(array("exito" => $array1));
       
        }
    
         catch (Exception $ex) {
            $array1 = array("0",$as,$html2,query,$ex);
            echo json_encode(array("exito" => $array1));
            
        }

         
    }

?>