<?php 
    @session_start();
    //echo $_SESSION['autentica']."STO TRAE";
    if(!isset($_SESSION['loggedin']) && $_SESSION['autentica'] != "simon"){
        if($_SESSION['autentica'] != "simon" )
        {
            header("Location: ingreso.php");  
            exit(); 
        }else{
          
             

        }
    }else{
        
    }
?>
<?php include '../../inc/config.php'; ?>
<?php include '../../inc/template_start.php'; ?>
<?php include '../../inc/page_head.php'; ?>

<!-- Page content -->
<div id="page-content">
    <!-- Quick Stats -->

    <!-- All Products Block -->
    <div class="block full">
        <!-- All Products Title -->
        <div class="block-title">
            <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
            </div>
            <h2><strong>Listado</strong> Registrado de Asociación</h2>
        </div>
        <!-- END All Products Title -->

        <!-- All Products Content -->
        <table id="ecom-products" class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    
                    <th class="text-left">Nombre</th>
                    <th class="text-left">Teléfono</th>
                    <th class="text-left">Contacto Operador</th>
                    <th class="text-left">Contacto Comercial</th>
                    <th class="text-left">Contacto Documentos</th>
                    <th class="text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $labels['0']['class']   = "label-success";
                $labels['0']['text']    = "Available";
                $labels['1']['class']   = "label-danger";
                $labels['1']['text']    = "Out of Stock";
                ?>

                <?php 
                    $sql = "SELECT id,
                        nombre,telefono,fax,contacto_operador,contacto_comercial,contacto_documentos,direccion,email
                    FROM
                        asociacion_aaes
                    ORDER BY nombre desc";

                    try {
                        require_once '../../Conexion/Conexion.php';
                        $comando = Conexion::getInstance()->getDb()->prepare($sql);
                        $comando->execute();
                        $as = 0;
                        while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                            $as++;
                            echo"<tr>";
                          
                            echo"<td>$row[nombre]</td>";
                            echo"<td>$row[telefono]</td>";
                            echo"<td>$row[contacto_operador]</td>";
                            echo"<td>$row[contacto_comercial]</td>";
                            echo"<td>$row[contacto_documentos]</td>";
                            echo"<td class='text-center'>
                                    <div class='btn-group' id='dropdown_aderecha'>
                                    <a href='javascript:void(0)' data-toggle='dropdown' class='btn btn-alt btn-primary dropdown-toggle'>Seleccione <span class='caret'></span></a>
                                    <ul class='dropdown-menu dropdown-custom text-left'>
                                        <li class='dropdown-header'>Opciones</li>
                                        <li>
                                        <a id='a1' data-iid ='$row[id]' data-nombre='$row[nombre]' data-direccion='$row[direccion]' data-contacto_documentos='$row[contacto_documentos]' data-contacto_comercial='$row[contacto_comercial]' data-operador='$row[contacto_operador]' data-email='$row[email]' data-fax='$row[fax]' data-telefono='$row[telefono]'  data-id ='$row[id]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal' ><i class='fa fa-pencil pull-right'></i>Editar Oficina</a>

                                        </li>
                                        <li class='divider'></li>
                                        <li>
                                        <a data-correo ='$row[id]' id='btneliminar' data-toggle='tooltip' title='Eliminar' ><i class='fa fa-trash pull-right'></i>Eliminar Oficina</a>
                                        </li>

                                    </div>
                                </td>";

                            
                            }
                        }
                
                     catch (Exception $ex) {
                        echo $ex;
                    }
                   

                ?>
 
            </tbody>
        </table>
    </div>
 


    <div id="modal_eleAAES" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Editar Datos</h3>
             </div>
             <div class="modal-body">
                <form action="" method="post" id="actualizacion_AAES" name="actualizacion_AAES" class="form-horizontal animation-fadeIn">
                    <input type="hidden" name="elid" id="elid" >
                    <input type="hidden" name="anterior" id="anterior">
                   <div class="row">
                      <div class="col-md-6">
                         <div class="block">
                            
                            <div class="block-title">
                               <h2><strong>Información de</strong> Asociación</h2>
                            </div>

                            <div class="form-group">
                               <div class="col-xs-12">
                                  <label for="nombre_asociacion">Nombre(*):</label>
                                  <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="nombre_asociacion" name="nombre_asociacion" class="form-control" placeholder="Ingrese el nombre de la asociación" autocomplete="off">  
                               </div>
                            </div>
                             <!--Telefono-->
                            <div class="form-group">
                               <div class="col-xs-12">
                                  <label for="telefono">Télefono(*):</label>
                                  <input data-toggle="tooltip" title="Este campo permite solo números y debe de comenzar con 2,6 o 7" type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese el télefono" autocomplete="off">
                               </div>
                            </div>
                             <!--FAX-->
                            <div class="form-group">
                               <div class="col-xs-12">
                                  <label for="fax">FAX:</label>
                                  <input data-toggle="tooltip" title="Este campo permite solo números y debe de comenzar con 2,6 o 7" type="text" id="fax" name="fax" class="form-control" placeholder="Ingrese el FAX" autocomplete="off">    
                               </div>
                            </div>
                            <div class="form-group">
                               <div class="col-xs-12">
                                  <label for="email">Correo</label>
                                  <input type="email" id="email" onblur="validar(this)" name="email" class="form-control" placeholder="Ingrese su correo">
                               </div>
                            </div>
                         </div><!-- end block-->
                      </div>

                      <div class="col-md-6">
                         <div class="block">
                            <div class="block-title">
                               <h2><strong>Datos de </strong> Contactos</h2>
                            </div>
                            <div class="form-group">
                               <div class="col-xs-12">
                                  <label for="operador">Contacto Operador</label>
                                  <input type="text" id="operador"  name="operador" class="form-control" placeholder="Ingrese el contacto del Operador">
                               </div>
                            </div>
                            <div class="form-group">
                               <div class="col-xs-12">
                                  <label for="contacto_comercial">Contacto Comercial</label>
                                  <input type="text" id="contacto_comercial"  name="contacto_comercial" class="form-control" placeholder="Ingrese el Contacto Comercial">
                               </div>
                            </div>
                            <div class="form-group">
                               <div class="col-xs-12">
                                  <label for="contacto_documentos">Contacto Documentos</label>
                                  <input type="text" id="contacto_documentos"  name="contacto_documentos" class="form-control" placeholder="Ingrese el Contacto de Documentos">
                               </div>
                            </div>
                            <div class="form-group">
                               <div class="col-xs-12">
                                  <label for="direccion">Dirección(*):</label>
                                  <textarea id="direccion" name="direccion" rows="1" class="form-control" placeholder="Escriba la dirección de la Asociación"></textarea>    
                               </div>
                            </div>
                         </div><!-- end block-->
                      </div>
                   </div>

                
             </div>
          </div>
          <div class="modal-footer">
             <button type="button"  class="btn btn-sm btn-default" data-dismiss="modal"><?php echo CERRAR_MODAL; ?></button>
             <button type="submit" id="m_save" class="btn btn-sm btn-info"><?php echo ACTUALIZAR; ?></button>
          </div>
            </form>
       </div>
    </div>



</div>
<?php include '../../inc/page_footer.php'; ?>
<?php include '../../inc/template_scripts.php'; ?>

<!-- Load and execute javascript code used only in this page -->
<script src="../../js/pages/ecomProducts.js"></script>
<script>$(function(){ EcomProducts.init(); });</script>
<script src="../../js/pages/Validaciones_AAES.js?id=<?php echo date('Yidisus'); ?>"></script>

<script>
    function validar(e){
        console.log("salado");
        var de = $(e).val();
        var anterior = $("#anterior").val();
        var eledata = {variable:'3', email:de,anterior:anterior};
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'json_ele/administracion_AAES.php',
            data : eledata,
        }).done(function(msg) {
            console.log(msg);
            if(msg.exito){
                console.log(msg.exito);
            }else if (msg.error){
                 $.bootstrapGrowl('<h4>Error !</h4> <p>El correo ya existe</p>', {
                    type: "danger",
                    delay: 2500,
                    allow_dismiss: true
                });
                $(e).val("");
                console.log(msg.error);
            }
            else{
               console.log(msg.error2);
            }


        });

    }

</script>
<script>
    $(function(){
        Validaciones_AAES.init(); 
        /****abrir modal*******/
       $(document).on("submit", "#actualizacion_AAES", function (e) {
            console.log("eleangel");
            e.preventDefault();
            var elem=$(this);
            var elcorreo = elem.attr('data-correo');
            console.log("llega correo3 listo para ajax",elcorreo);
            //funcion ajax eliminar

            swal.close();
            var get = { elcorreo:elcorreo,des:"eliminar"};
            console.log(get);
            $.ajax({
                dataType: "json",
                method: "POST",
                url:'json/eliminar_empresa.php',
                data : get,
            }).done(function(msg) {
                console.log(msg);
                 if(msg.exito[0]){
                        $.bootstrapGrowl('<h4>Excelente !</h4> <p>Datos Eliminados!</p>', {
                        type: "success",
                        delay: 2500,
                        allow_dismiss: true
                    });

                    NProgress.done();
                    location.reload();
                    /*var timer=setInterval(function(){
                        
                        clearTimeout(timer);
                    },100);*/

                    
                }else if (msg.exito[4]){
                    console.log('Error fatal en la base de datos, contacte a su administrador');
                }
                else {
                    NProgress.done();
                    $.bootstrapGrowl('<h4>Error!</h4> <p>el cliente  no ha sido elimnado!</p>', {
                        type: "danger",
                        delay: 2500,
                        allow_dismiss: true
                    });
                }
            });

        });

        $(document).on("click", "#a1", function (e) {
            var elem=$(this);

            $("#elid").val(elem.attr('data-iid'));
            $("#nombre_asociacion").val(elem.attr('data-nombre'));
            $("#telefono").val(elem.attr('data-telefono'));
            $("#email").val(elem.attr('data-email'));
            $("#anterior").val(elem.attr('data-email'));
            $("#fax").val(elem.attr('data-fax'));
            $("#operador").val(elem.attr('data-operador'));
            $("#contacto_comercial").val(elem.attr('data-contacto_comercial'));
            $("#contacto_documentos").val(elem.attr('data-contacto_documentos'));
            $("#direccion").val(elem.attr('data-direccion'));
            $("#modal_eleAAES").modal({
                show: 'false'
            });
        });

        /******cerrar modal*******/
         

        
         
    });

</script>
<?php include '../../inc/template_end.php'; ?>