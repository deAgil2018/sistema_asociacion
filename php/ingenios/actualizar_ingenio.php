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
            <h2><strong>Listado</strong> Registrado</h2>
        </div>
        <!-- END All Products Title -->

        <!-- All Products Content -->
        <table id="ecom-products" class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    
                    <th class="text-left">Nombre</th>
                    <th class="text-left">NRC</th>
                    <th class="text-left">Dirección</th>
                    <th class="text-left">Correo</th>
                    <th class="text-left hidden-xs">FAX</th>
                    <th class="text-left">NIT</th>
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
                        id,
                        nombre,
                        identificador,
                        numero_fda,
                        contacto_operativo,
                        contacto_comercial,
                        contacto_otros,
                        direccion,
                        correo,
                        contacto_financiero,
                        contacto_documentos,
                        nit,
                        nrc,
                        fax,
                        contacto_contabilidad_factura,
                        contacto_contabilidad_emision,
                        contacto_financiero
                    FROM
                        ingenio 
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
                            echo"<td>$row[nrc]</td>";
                            echo"<td>$row[direccion]</td>";
                            echo"<td>$row[correo]</td>";
                            echo"<td>$row[fax]</td>";
                            echo"<td>$row[nit]</td>";


                                    echo"<td class='text-center'>
                                    <div class='btn-group' id='dropdown_aderecha'>
                                    <a href='javascript:void(0)' data-toggle='dropdown' class='btn btn-alt btn-primary dropdown-toggle'>Seleccione <span class='caret'></span></a>
                                    <ul class='dropdown-menu dropdown-custom text-left'>
                                        <li class='dropdown-header'>Opciones</li>
                                        <li>
                                            <a id='a1' data-iid ='$row[id]' data-identificador='$row[identificador]' data-correo='$row[correo]' data-numero_fda='$row[numero_fda]' data-direccion='$row[direccion]' data-nombre ='$row[nombre]' data-nit ='$row[nit]' data-conoperativo ='$row[contacto_operativo]' data-concomercial ='$row[contacto_comercial]' data-contacto_otros ='$row[contacto_otros]' data-confinanciero ='$row[contacto_financiero]' data-condocumentos ='$row[contacto_documentos]' data-nrc ='$row[nrc]' data-fax ='$row[fax]' data-cfactura ='$row[contacto_contabilidad_factura]' data-cenision ='$row[contacto_contabilidad_emision]'data-id ='$row[id]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal'><i class='fa fa-pencil pull-right'></i>Editar Ingenio</a>
                                            <a  data-elid='$row[id]' id='btn_telefono' data-toggle='tooltip' title='Agregar telefono' href='javascript:void(0)'><i class='fa fa-plus pull-right'></i>Agregar Telefono</a>
                                            <a  data-elid='$row[id]' id='btn_actualizar_telefono' data-toggle='tooltip' title='Actualizar telefono' href='javascript:void(0)'><i class='fa fa-wrench pull-right'></i>Actualizar Telefonos</a>
                                            <a data-correo ='$row[correo]' data-elid='$row[id]' id='btn_firma' data-toggle='tooltip' title='Agregar firma' href='javascript:void(0)'><i class='fa fa-plus pull-right'></i>Agregar Firma</a>
                                            <a data-correo ='$row[correo]' data-elid='$row[id]' id='btn_actualizar_firma' data-toggle='tooltip' title='Actualizar firmas' href='javascript:void(0)'><i class='fa fa-wrench pull-right'></i>Actualizar Firmas</a>
                                        </li>
                                        <li class='divider'></li>
                                        <li>

                                        <a data-correo ='$row[id]' id='btneliminar' data-toggle='tooltip' title='Eliminar' href='javascript:void(0)'><i class='fa fa-trash pull-right'></i>Eliminar Ingenio</a>

                                        </li>

                                    </div>
                                </td>";
                                
                            }
                        }
                
                     catch (Exception $ex) {
                        echo $ex->getMessage();
                        echo $ex->getLine();

                    }
                   
                ?>
 
            </tbody>
        </table>
    </div>
 

    <!-- modal editar datos ingenio -->
    <div id="modal_ele" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Editar Datos</h3>
                </div>
                <div class="modal-body">
                    
                    <form method="post" id="registro_ingenio_modal" name="registro_ingenio_modal" class="form-horizontal animation-fadeIn">
                        <input type="hidden" name="des" value="actualizar">
                        <input type="hidden" id = 'email_anterior' name="email_anterior">
                        <input type="hidden" id = 'id' name="id">

                        <div class="row ">
                            <div class="col-md-6">
                                <div class="block">
                                    
                                    <div class="block-title">
                                         
                                        <h2><strong>Información del</strong> Ingenio</h2>
                                    </div>
                                    
                                 
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="nombre1">Nombre(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="nombre1" name="nombre1" class="form-control" placeholder="Ingrese su nombre completo" autocomplete="off">  
                                            </div>  
                                        </div>

                                         <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="numero_fda1">Número FDA(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite numeros!" type="text" id="numero_fda1" name="numero_fda1" class="form-control" placeholder="Ingrese el numero FDA" autocomplete="off">  
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="nit1">NIT(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="nit1" name="nit1" class="form-control" placeholder="Ingrese su código postal" autocomplete="off">  
                                            </div>  
                                        </div>


                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="nrc1">NRC(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="nrc1" name="nrc1" class="form-control" placeholder="Ingrese su código postal" autocomplete="off">  
                                            </div>  
                                        </div>

                                        <!--Codigo Contrato-->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="fax1">Fax(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo numeros que empiezen con 6,2 y 7!" type="text" id="fax1" name="fax1" class="form-control" placeholder="Ingrese su código de contrato" autocomplete="off">  
                                            </div>  
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="correo1">Correo(*):</label>
                                                <input type="email" id="correo1" onblur="validar(this)" name="correo1" class="form-control" placeholder="Ingrese su correo">
                                            </div>
                                        </div>

                                         <!--Direccion-->
                                        <div class="form-group">
                                                <div class="col-xs-12">
                                                    <label for="direccion1">Dirección(*):</label>
                                                    <textarea id="direccion1" name="direccion1" rows="1" class="form-control" placeholder="Escriba su dirección"></textarea>    
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
                                                <label for="con_operativo1">Contacto Operativo(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_operativo1" name="con_operativo1" class="form-control" placeholder="Ingrese contactos" autocomplete="off">  
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="con_comercial1">Contacto Comercial(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_comercial1" name="con_comercial1" class="form-control" placeholder="Ingrese contactos" autocomplete="off">  
                                            </div>  
                                        </div>


                                         <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="con_financiero1">Contacto Financiero(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_financiero1" name="con_financiero1" class="form-control" placeholder="Ingrese contactos" autocomplete="off">  
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="con_documentacion1">Contacto de Documentacion(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_documentacion1" name="con_documentacion1" class="form-control" placeholder="Ingrese contactos" autocomplete="off">  
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="con_contacto_otros1">Otros Contactos(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_contacto_otros1" name="con_contacto_otros1" class="form-control" placeholder="Ingrese contactos, o ninguno" autocomplete="off">  
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="cfactura1">Contacto de Contabilidad Facturación(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="cfactura1" name="cfactura1" class="form-control" placeholder="Ingrese contactos, o ninguno" autocomplete="off">  
                                            </div>  
                                        </div> 

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="cemision1">Contacto de Contabilidad Emisiones(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="cemision1" name="cemision1" class="form-control" placeholder="Ingrese contactos, o ninguno" autocomplete="off">  
                                            </div>  
                                        </div> 
                                    
                                </div>
                                
                            </div>
                             
                        </div>

                    


                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-sm btn-default" data-dismiss="modal"><?php echo CERRAR_MODAL ?></button>
                    <button type="submit" class="btn btn-alt btn-primary"><?php echo ACTUALIZAR ?></button>
                </div>

                </form>
            </div>
        </div>
    </div>

    <!-- modal agregar telefono -->
    <div id="modal_ele_telefono" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Agregar Teléfono a Ingenio</h3>
                </div>
                <div class="modal-body">
                    
                    <form method="post" id="registro_telefono_ingenio" name="registro_telefono_ingenio" class="form-horizontal animation-fadeIn">
                        <input type="hidden" name="des" value="insertar_telefono">
                        <input type="hidden" id = 'elid_i' name="elid_i">

                        <div class="row ">
                            <div class="col-md-6">
                                <div class="block">
                                    
                                    <div class="block-title">
                                         
                                        <h2><strong>Información de</strong> Oficina</h2>
                                    </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="nombre2">Responsable(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="nombre2" name="nombre2" class="form-control" placeholder="Ingrese el nombre de la oficina" autocomplete="off">  
                                            </div>  
                                        </div>                                 
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <div class="block">
                                    
                                    <div class="block-title">
                                         
                                        <h2><strong>Información del </strong> Teléfono</h2>
                                    </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="telefono2">Número de Teléfono(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite números que empiezen en 2,6 y 7!" type="text" id="telefono2" name="telefono2" class="form-control" placeholder="Ingrese número de telefono" autocomplete="off">  
                                            </div>  
                                        </div>
                                </div>
                                
                            </div>
                             
                        </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-sm btn-default" data-dismiss="modal"><?php echo CANCELAR ?></button>
                    <button type="submit" class="btn btn-alt btn-primary"><?php echo GUARDAR ?></button>
                </div>

                </form>
            </div>
        </div>
    </div>


</div>
<?php include '../../inc/page_footer.php'; ?>
<?php include '../../inc/template_scripts.php'; ?>

<script src="../../js/pages/ingenio.js?id=<?php echo date('Yidisus') ?>"></script>
<script>$(function(){ Ingenio.init(); });</script>

<!-- Load and execute javascript code used only in this page -->
<script src="../../js/pages/ecomProducts.js"></script>
<script>$(function(){ EcomProducts.init(); });</script>

<script>
    function validar(e){
        console.log("salado");
        var de = $(e).val();
        var email_anterior=$("#email_anterior").val();
        var eledata = {ele:'2', data:de,email_anterior:email_anterior};
        console.log("eledata",eledata);
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'json_validar_ingenio.php',
            data : eledata,
        }).done(function(msg) {
            console.log("esto retorna",msg);
            if(msg.exito){
                console.log(msg.exito);
            }else if (msg.error){
                
                iziToast.error({
                    title: '<?php echo ERROR; ?>',
                    message: '<?php echo ERROR_CORREO;?>',
                    timeout: 3000,
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
        /****abrir modal*******/
        
        $(document).on("click", "#btneliminar", function (e) {
            var elem=$(this);
            var elcorre = elem.attr('data-correo');
            console.log("llega correo1",elcorre);
            
            swal({
                title: '¿Eliminar ingenio?',
                text: "",
                html: 
                '<br><button class="btn btn-danger" data-elcorreo ="'+elcorre+'" id="btn_eliminar" data-toggle="tooltip" data-original-title="Eliminar"><i class="fa fa-bomb"></i> Eliminar</button> ' +
                '<button class="btn btn-warning" id="btn_cancelar" data-toggle="tooltip" data-original-title="Cancelar"><i class="fa fa-times"></i> Cancelar</button>'
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
                title: '¿Esta seguro?',
                text: "",
                html: '<p class="h4 mensajes_alert">No hay vuelta atras</p><br><button class="btn btn-danger" data-correo="'+elcorreo+'" id="btn_sip" data-toggle="tooltip" data-original-title="Si, eliminar"><i class="fa fa-bomb"></i> Si, eliminar</button> ' +
                '<button class="btn btn-info" id="btn_nop" data-toggle="tooltip" data-original-title="No"><i class="fa fa-times"></i> No</button>',
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
                    url:'json/eliminar_ingenio.php',
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

        $(document).on("click", "#btn_telefono", function (e) {
            var elem=$(this);
            var id =elem.attr('data-elid');
            $("#elid_i").val(id);
            $("#modal_ele_telefono").modal({
                show: 'false'
            });

        });

        $(document).on("click", "#btn_actualizar_telefono", function (e) {
            var elem=$(this);
            var id =elem.attr('data-elid');
            $("#id").val();
            $(location).attr('href','actualizar_telefono_ingenio.php?id='+id+'&date=<?php echo date("Yhmsi") ?>');

        });

        $(document).on("click", "#btn_firma", function (e) {
            var elem=$(this);
            var trader =elem.attr('data-elid');
            $(location).attr('href','nueva_firma.php?id='+trader+'&date=<?php echo date("Yhmsi") ?>');

        });

        $(document).on("click", "#btn_actualizar_firma", function (e) {
            var elem=$(this);
            var trader =elem.attr('data-elid');
            $(location).attr('href','actualizar_firma.php?id='+trader+'&date=<?php echo date("Yhmsi") ?>');

        });



        $(document).on("click", "#a1", function (e) {
            var elem=$(this);
            $("#nombre1").val(elem.attr('data-nombre'));
            $("#numero_fda1").val(elem.attr('data-numero_fda'));
            $("#nit1").val(elem.attr('data-nit'));
            $("#con_operativo1").val(elem.attr('data-conoperativo'));
            $("#direccion1").val(elem.attr('data-direccion'));
            $("#con_comercial1").val(elem.attr('data-concomercial'));
            $("#con_financiero1").val(elem.attr('data-confinanciero'));
            $("#con_documentacion1").val(elem.attr('data-condocumentos'));
            $("#correo1").val(elem.attr('data-correo'));
            $("#email_anterior").val(elem.attr('data-correo'));
            $("#identificador1").val(elem.attr('data-identificador'));
            $("#nrc1").val(elem.attr('data-nrc'));
            $("#fax1").val(elem.attr('data-fax'));
            $("#cfactura1").val(elem.attr('data-cfactura'));
            $("#cemision1").val(elem.attr('data-cenision'));
            $("#con_contacto_otros1").val(elem.attr('data-contacto_otros'));
            $("#id").val(elem.attr('data-id'));
            //$("#rol").select2("val",elem.attr('data-nivel')); 
            $("#modal_ele").modal({
                show: 'false'
            });
        });

        /******cerrar modal*******/ 
        $(document).on("submit", "#registro_ingenio_modal", function (e) {
            //console.log("esta llegando");
            e.preventDefault();
            NProgress.start();
            $("#modal_ele").modal('toggle'); 
            var get = $("#registro_ingenio_modal").serialize();
            ///console.log("el_formulario",get);
            $.ajax({
                dataType: "json",
                method: "POST",
                url:'json_eliminar_ingenio.php',
                data : get,
            }).done(function(msg) {
                //console.log("retorna",msg);
                
                if(msg.exito){
                    iziToast.success({
                        title: '<?php echo EXITO; ?>',
                        message: '<?php echo EXITO_ACTUALIZAR;?>',
                        timeout: 3000,
                    });
                    NProgress.done();

                    $(this).prop('disabled', true);
                    var timer=setInterval(function(){
                        location.reload();
                        clearTimeout(timer);
                    },3500);

                   
                     
                    
                }
                else {
                    NProgress.done();
                    iziToast.error({
                        title: '<?php echo ERROR; ?>',
                        message: '<?php echo ERROR_MENSAJE;?>',
                        timeout: 3000,
                    });
                }

            });
        });



        $(document).on("submit", "#registro_telefono_ingenio", function (e) {
            console.log("esta llegando al registro de telefono");
            e.preventDefault();
            NProgress.start();
            
            var get = $("#registro_telefono_ingenio").serialize();
            console.log("el formulario del telefono",get);
            $.ajax({
                dataType: "json",
                method: "POST",
                url:'json_insertar_telefono.php',
                data : get,
            }).done(function(msg) {
                
                
                if(msg.exito){
                    iziToast.success({
                        title: '<?php echo EXITO; ?>',
                        message: '<?php echo EXITO_MENSAJE;?>',
                        timeout: 3000,
                    });

                    NProgress.done();

          
                    var timer=setInterval(function(){
                        location.reload();
                        clearTimeout(timer);
                    },3500);
                    $("#modal_ele_telefono").modal('toggle'); 
                   
                     
                    
                }
                else {
                    NProgress.done();
                    iziToast.error({
                        title: '<?php echo ERROR; ?>',
                        message: '<?php echo ERROR_MENSAJE;?>',
                        timeout: 3000,
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