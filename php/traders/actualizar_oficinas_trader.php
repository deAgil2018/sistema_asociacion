<?php 
    @session_start();
    //echo $_SESSION['autentica']."STO TRAE";
    if(!isset($_SESSION['loggedin']) && $_SESSION['autentica'] != "simon"){
        if($_SESSION['autentica'] != "simon" )
        {
            header("Location: ingreso/ingreso.php");  
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
            <h2><strong>Listado</strong> Registrado</h2>
        </div>
        <!-- END All Products Title -->

        <!-- All Products Content -->
        <table id="ecom-products" class="table table-bordered table-striped table-vcenter">
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
            <tbody>
                <?php
                $labels['0']['class']   = "label-success";
                $labels['0']['text']    = "Available";
                $labels['1']['class']   = "label-danger";
                $labels['1']['text']    = "Out of Stock";
                ?>

                <?php 
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
                    WHERE f.codigo_trader = '$_GET[trader]'
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
                            echo"<td>$row[codigo_contrato]</td>";
                            echo"<td>$row[contacto_operativo]</td>";
                            echo"<td>$row[contacto_comercial]</td>";
                            echo"<td>$row[contacto_financiero]</td>";
                            echo"<td>$row[contacto_documentos]</td>";


                                    echo"<td class='text-center'>
                                    <div class='btn-group'>
                                    <a href='javascript:void(0)' data-toggle='dropdown' class='btn btn-alt btn-primary dropdown-toggle'>Seleccione <span class='caret'></span></a>
                                    <ul class='dropdown-menu dropdown-custom text-left'>
                                        <li class='dropdown-header'>Opciones</li>
                                        <li>
                                        <a id='a1' data-iid ='$row[id]' data-coficina='$row[codigo_oficina]' data-ctrader='$row[codigo_trader]' data-ccontrato='$row[codigo_contrato]' data-direccion='$row[direccion]' data-nombre ='$row[nombre]' data-cpostal ='$row[codigo_postal]' data-conoperativo ='$row[contacto_operativo]' data-concomercial ='$row[contacto_comercial]' data-otros ='$row[otros]' data-confinanciero ='$row[contacto_financiero]' data-condocumentos ='$row[contacto_documentos]' data-id ='$row[id]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal' ><i class='fa fa-pencil pull-right'></i>Editar Oficina</a>

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
 


    <div id="modal_ele" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Editar Datos</h3>
                </div>
                <div class="modal-body">
                    
                    <form method="post" id="registro" name="registro" class="form-horizontal animation-fadeIn">
                        <input type="hidden" name="des" value="actualizar">
                        <input type="hidden" id = 'correo1' name="correo" value="">
                        <input type="hidden" id = 'id' name="id">

                        <div class="row ">
                            <div class="col-md-6">
                                <div class="block">
                                    
                                    <div class="block-title">
                                         
                                        <h2><strong>Información de la</strong> Empresa</h2>
                                    </div>
                                    
                                 
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="nombre1">Nombre(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="nombre1" name="nombre1" class="form-control" placeholder="Ingrese su nombre completo" autocomplete="off">  
                                            </div>  
                                        </div>

                                        <!--Codigo Contrato-->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="co_contrato">Código de Contrato(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="co_contrato" name="co_contrato" class="form-control" placeholder="Ingrese su código de contrato" autocomplete="off">  
                                            </div>  
                                        </div>

                                        <!--Codigo Direccion-->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="co_direccion">Código Postal(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="co_direccion" name="co_direccion" class="form-control" placeholder="Ingrese su código postal" autocomplete="off">  
                                            </div>  
                                        </div>

                                         <!--Direccion-->
                                        <div class="form-group">
                                                <div class="col-xs-12">
                                                    <label for="direccion">Dirección(*):</label>
                                                    <textarea id="direccion" name="direccion" rows="3" class="form-control" placeholder="Escriba su dirección"></textarea>    
                                                </div>    
                                        </div>

                                                 
                                                                         
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <div class="block">
                                    
                                    <div class="block-title">
                                         
                                        <h2><strong>Información de la</strong> Cuenta</h2>
                                    </div>
                                    
                                     
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="con_operativo">Contacto Operativo(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_operativo" name="con_operativo" class="form-control" placeholder="Ingrese contactos" autocomplete="off">  
                                            </div>  
                                        </div>


                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="con_comercial">Contacto Comercial(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_comercial" name="con_comercial" class="form-control" placeholder="Ingrese contactos" autocomplete="off">  
                                            </div>  
                                        </div>


                                         <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="con_financiero">Contacto Financiero(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_financiero" name="con_financiero" class="form-control" placeholder="Ingrese contactos" autocomplete="off">  
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="con_documentacion">Contacto de Documentacion(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_documentacion" name="con_documentacion" class="form-control" placeholder="Ingrese contactos" autocomplete="off">  
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="con_otros">Otros Contactos(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_otros" name="con_otros" class="form-control" placeholder="Ingrese contactos, o ninguno" autocomplete="off">  
                                            </div>  
                                        </div> 
                                    
                                </div>
                                
                            </div>
                             
                        </div>

                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="m_save" class="btn btn-sm btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>



</div>
<?php include '../../inc/page_footer.php'; ?>
<?php include '../../inc/template_scripts.php'; ?>

<!-- Load and execute javascript code used only in this page -->
<script src="../../js/pages/ecomProducts.js"></script>
<script>$(function(){ EcomProducts.init(); });</script>


<script>
    $(function(){
        /****abrir modal*******/
        
        $(document).on("click", "#btneliminar", function (e) {
            var elem=$(this);
            var elcorre = elem.attr('data-correo');
            console.log("llega correo1",elcorre);
            
            swal({
                title: '<?php echo MENSAJE_ELIMINAR_ALERT?>',
                text: "",
                html: 
                '<br><button class="btn btn-danger" data-elcorreo ="'+elcorre+'" id="btn_eliminar" data-toggle="tooltip" data-original-title="Eliminar">'+'<?php echo ELIMINAR_ALERT ?>'+'</button> ' +
                '<button class="btn btn-warning" id="btn_cancelar" data-toggle="tooltip" data-original-title="Cancelar"><?php echo CANCELAR_ALERT ?></button>'
                ,
                type: 'info',
                showCancelButton: false,
                showConfirmButton: false,
                allowEscapeKey:false,
                allowOutsideClick:false,
            });


        });
            
            $(document).on('click', "#btn_cancelar", function() {
                swal.close();
            });



            $(document).on('click', "#btn_eliminar", function(e) {
                swal.close();
                var elem=$(this);
                var elcorreo = elem.attr('data-elcorreo');
                console.log("llega correo2",elcorreo);
                swal({
                title: '<?php echo MENSAJE_ELIMINAR_CONFIRMAR?>',
                text: "",
                html: '<p class="h4 mensajes_alert">No hay vuelta atras</p><br><button class="btn btn-danger" data-correo="'+elcorreo+'" id="btn_sip" data-toggle="tooltip" data-original-title="Si, eliminar"><?php echo CONFIRMAR_ELIMINAR ?></button> ' +
                '<button class="btn btn-info" id="btn_nop" data-toggle="tooltip" data-original-title="No"><?php echo CANCELAR_ALERT ?></button>',
                type: 'info',
                showCancelButton: false,
                showConfirmButton: false,
                allowEscapeKey:false,
                allowOutsideClick:false,
                });
            });
            
            $(document).on('click', "#btn_sip", function() {
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
                    url:'json_eliminar_oficina.php',
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

             $(document).on('click', "#btn_nop", function() {
                swal.close();
            });



        $(document).on('click', "#btn_enviar", function() {
            swal.close();
        });



        $(document).on("click", "#a1", function (e) {
            var elem=$(this);
            $("#nombre1").val(elem.attr('data-nombre'));
            $("#co_contrato").val(elem.attr('data-ccontrato'));
            $("#co_direccion").val(elem.attr('data-cpostal'));
            $("#con_operativo").val(elem.attr('data-conoperativo'));
            $("#direccion").val(elem.attr('data-direccion'));
            $("#con_comercial").val(elem.attr('data-concomercial'));
            $("#con_financiero").val(elem.attr('data-confinanciero'));
            $("#con_documentacion").val(elem.attr('data-condocumentos'));
            $("#con_otros").val(elem.attr('data-otros'));
            $("#id").val(elem.attr('data-id'));
            //$("#rol").select2("val",elem.attr('data-nivel')); 
            $("#modal_ele").modal({
                show: 'false'
            });
        });

        /******cerrar modal*******/
        $(document).on("click", "#m_save", function (e) {
            $("#modal_ele").modal('toggle'); 
            var get = $("#registro").serialize();
            console.log(get);
                $.ajax({
                dataType: "json",
                method: "POST",
                url:'json/eliminar_oficina.php',
                data : get,
            }).done(function(msg) {
                console.log("esto trae",msg);
                
                if(msg.exito){
                        $.bootstrapGrowl('<h4>Excelente !</h4> <p>Datos Actualizados!</p>', {
                        type: "success",
                        delay: 2500,
                        allow_dismiss: true
                    });

                    NProgress.done();
                    location.reload();
                    /*var timer=setInterval(function(){
                        
                        clearTimeout(timer);
                    },100);*/
                    
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
            var valor = $(this).attr('data-id');
            
        });

        $(document).on("click", "#a3", function (e) {

            var email = $(this).attr('data-correo');
            var id = $(this).attr('data-iid');
            
            $(location).attr('href','actualizar_perfiles.php?id='+id+'&date=<?php echo date("Yhmsi") ?>');
                    clearTimeout(timer);
        });

    });

</script>
<?php include '../../inc/template_end.php'; ?>