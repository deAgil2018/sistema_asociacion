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
                    <th class="text-left">Número de Telefono</th>
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
                        f.id_telefonos,
                        f.id_empresa,
                        p.id,
                        p.nombre,
                        p.telefono
                        
                    FROM
                        telefonos_empresa as p JOIN
                        foranea_telefonos_empresa AS f
                        ON p.id = f.id_telefonos
                    WHERE f.id_empresa = '$_GET[id]'
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


                                    echo"<td class='text-center'>
                                    <div class='btn-group'>
                                    <a href='javascript:void(0)' data-toggle='dropdown' class='btn btn-alt btn-primary dropdown-toggle'>Seleccione <span class='caret'></span></a>
                                    <ul class='dropdown-menu dropdown-custom text-left'>
                                        <li class='dropdown-header'>Opciones</li>
                                        <li>
                                        <a id='a1' data-iid ='$row[id]' data-telefono='$row[telefono]' data-nombre ='$row[nombre]'  data-id ='$row[id]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal' ><i class='fa fa-pencil pull-right'></i>Editar Número</a>

                                        </li>
                                        <li class='divider'></li>
                                        <li>
                                        <a data-correo ='$row[id]' id='btneliminar' data-toggle='tooltip' href='javascript:void(0)' title='Eliminar' ><i class='fa fa-trash pull-right'></i>Eliminar Número</a>
                                        </li>

                                    </div>
                                </td>
                            </tr>";
                                
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
                                         
                                        <h2><strong>Información del</strong> Contacto</h2>
                                    </div>
                                    
                                 
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="nombre1">Nombre(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="nombre1" name="nombre1" class="form-control" placeholder="Ingrese su nombre completo" autocomplete="off">  
                                            </div>  
                                        </div>   
                                                                         
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <div class="block">
                                    
                                    <div class="block-title">
                                         
                                        <h2><strong>Información del</strong> Telefono</h2>
                                    </div>
                                    
                                     
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="telefono1">Número de Telefono(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="telefono1" name="telefono1" class="form-control" placeholder="Ingrese contactos" autocomplete="off">  
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

         App.datatables();
        $('#ecom-products2').dataTable();

        /****abrir modal*******/
        
        $(document).on("click", "#btneliminar", function (e) {
            var elem=$(this);
            var elcorre = elem.attr('data-correo');
            console.log("llega correo1",elcorre);
            
            swal({
                title: '¿Eliminar número?',
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
                    url:'eliminar_telefono_empresa.php',
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
            $("#telefono1").val(elem.attr('data-telefono'));
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
                url:'eliminar_telefono_empresa.php',
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