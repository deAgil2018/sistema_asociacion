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
        <table id="ecom-products2" class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    
                    <th class="text-left">Nombre</th>
                    <th class="text-left">Correo</th>
                    <th class="text-left">NIT</th>
                    <th class="text-left">Credito</th>
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
                        email,
                        nit,
                        credito,
                        detalle_cuenta_bancaria_nombre,
                        detalle_cuenta_bancaria_numero,
                        cheque_nombre_de
                    FROM
                        operadores_carga 
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
                            echo"<td>$row[email]</td>";
                            echo"<td>$row[nit]</td>";
                            echo"<td>$row[credito]</td>";


                                    echo"<td class='text-center'>
                                    <div class='btn-group'>
                                    <a href='javascript:void(0)' data-toggle='dropdown' class='btn btn-alt btn-primary dropdown-toggle'>Seleccione <span class='caret'></span></a>
                                    <ul class='dropdown-menu dropdown-custom text-left'>
                                        <li class='dropdown-header'>Opciones</li>
                                        <li>
                                            <a id='a1' data-iid ='$row[id]' data-credito='$row[credito]' data-correo='$row[email]'  data-detalle_cuenta_bancaria_numero='$row[detalle_cuenta_bancaria_numero]' data-nombre ='$row[nombre]' data-nit ='$row[nit]' data-detalle_cuenta_bancaria_nombre ='$row[detalle_cuenta_bancaria_nombre]' data-cheque_nombre_de ='$row[cheque_nombre_de]' data-id ='$row[id]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal'><i class='fa fa-pencil pull-right'></i>Editar Ingenio</a>
                                            <a data-correo ='$row[email]' data-elid='$row[id]' id='btn_telefono' data-toggle='tooltip' title='Agregar telefono' href='javascript:void(0)'><i class='fa fa-plus pull-right'></i>Agregar Telefono</a>
                                            <a data-correo ='$row[email]' data-elid='$row[id]' id='btn_actualizar_telefono' data-toggle='tooltip' title='Actualizar telefono' href='javascript:void(0)'><i class='fa fa-wrench pull-right'></i>Actualizar Telefonos</a>
                                        </li>
                                        <li class='divider'></li>
                                        <li>

                                        <a data-correo ='$row[email]' id='btneliminar' data-toggle='tooltip' title='Eliminar' href='javascript:void(0)'><i class='fa fa-trash pull-right'></i>Eliminar Ingenio</a>

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
                        <input type="hidden" id = 'correo2' name="correo2" value="">
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
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="nombre1" name="nombre1" class="form-control" placeholder="Ingrese el nombre de la empresa" autocomplete="off">  
                                            </div>  
                                        </div>

                                                            <!--Codigo Direccion-->
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="credito1">Credito(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite numeros!" type="text" id="credito1" name="credito1" class="form-control" placeholder="Ingrese el credito" autocomplete="off">
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="nit1">NIT(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite numeros!" type="text" id="nit1" name="nit1" class="form-control" placeholder="Ingrese el NIT" autocomplete="off">  
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
                                            <label for="correo1">Correo</label>
                                            <input type="email" id="correo1" onblur="validar(this)" name="correo1" class="form-control" placeholder="Ingrese el correo">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <label for="detalle_nombre1">Detalle del Nombre de la Cuenta Bancaria(*):</label>
                                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="detalle_nombre1" name="detalle_nombre1" class="form-control" placeholder="Ingrese nombre de la cuenta" autocomplete="off">  
                                        </div>  
                                    </div>


                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <label for="detalle_numero1">Detalle del Número de la Cuenta Bancaria(*):</label>
                                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="detalle_numero1" name="detalle_numero1" class="form-control" placeholder="Ingrese número de la cuenta bancaria" autocomplete="off">  
                                        </div>  
                                    </div>


                                     <div class="form-group">
                                        <div class="col-xs-12">
                                            <label for="cheque_nombre1">Cheques a Nombre de(*):</label>
                                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="cheque_nombre1" name="cheque_nombre1" class="form-control" placeholder="Ingrese nombre de persona que firmara cheques" autocomplete="off">  
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


<script>
    $(function(){
        /****abrir modal*******/
         App.datatables();
        $('#ecom-products2').dataTable();
        
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
                    url:'eliminar_operadores_carga.php',
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
            var trader =elem.attr('data-elid');
            $(location).attr('href','nuevo_telefono_operador.php?id='+trader+'&date=<?php echo date("Yhmsi") ?>');

        });

         $(document).on("click", "#btn_actualizar_telefono", function (e) {
            var elem=$(this);
            var trader =elem.attr('data-elid');
            $(location).attr('href','actualizar_telefono_operador.php?id='+trader+'&date=<?php echo date("Yhmsi") ?>');

        });



        $(document).on("click", "#a1", function (e) {
            var elem=$(this);
            $("#nombre1").val(elem.attr('data-nombre'));
            $("#credito1").val(elem.attr('data-credito'));
            $("#nit1").val(elem.attr('data-nit'));
            $("#correo1").val(elem.attr('data-correo'));
            $("#cheque_nombre1").val(elem.attr('data-cheque_nombre_de'));
            $("#detalle_nombre1").val(elem.attr('data-detalle_cuenta_bancaria_nombre'));
            $("#detalle_numero1").val(elem.attr('data-detalle_cuenta_bancaria_numero'));
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
                url:'eliminar_operadores_carga.php',
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