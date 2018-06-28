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
                    <th class="text-left">Teléfono</th>
                    <th class="text-left">Rol</th>
                    <th class="hidden-xs">Estado</th>
                    <th class="text-left hidden-xs">Correo</th>
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
                        u.id,
                        u.usuario,
                        p.id,
                        p.nombre,
                        p.telefono,
                        CASE
                            WHEN p.nivel = 1 THEN 'Administrador'
                            WHEN p.nivel = 2 THEN 'Cliente'
                        END as elnivel,
                        p.nivel,
                        p.estado,
                        CASE
                            WHEN p.estado = 1 THEN 'Activo'
                            WHEN p.estado = 2 THEN 'Inactivo'
                        END as elestado,
                        p.correo,
                        p.direccion,
                        p.genero

                    FROM
                        personas AS p
                    JOIN
                        usuarios AS u
                        ON p.correo = u.correo
                    ORDER BY p.nombre desc";

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
                            echo"<td><span class='label ".(($row[nivel] == '1') ? 'label-success':'label-warning')."'>$row[elnivel]</span></td>";
                            echo"<td><span class='label ".(($row[estado] == '1') ? 'themed-background-dark':'label-danger')."'>$row[elestado]</span></td>";
                            echo"<td>$row[correo]</td>";
                            if(!$row[estado] == '2'){
                                echo"<td class='text-center'>
                                    <div class='btn-group btn-group-xs'>
                                        
                                        <a href='javascript:void(0)' id='a2' data-estado = '1' data-id ='$row[correo]' data-toggle='tooltip' title='Activar' class='btn btn-xs btn-warning'><i class='fa fa-retweet'></i></a>
                                    </div>
                                </td>";
                            }else{
                                if($row[estado] == '1'){
                                    echo"<td class='text-center'>
                                    <div class='btn-group'>
                                    <a href='javascript:void(0)' data-toggle='dropdown' class='btn btn-alt btn-primary dropdown-toggle'>Seleccione <span class='caret'></span></a>
                                    <ul class='dropdown-menu dropdown-custom text-left'>
                                        <li class='dropdown-header'>Opciones</li>
                                        <li>
                                            <a id='a1' data-iid ='$row[id]' data-genero='$row[genero]' data-usuario='$row[usuario]' data-direccion='$row[direccion]' data-nombre ='$row[nombre]' data-telefono ='$row[telefono]' data-nivel ='$row[nivel]' data-correo ='$row[correo]'  data-id ='$row[correo]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal' ><i class='fa fa-pencil pull-right'></i>Editar Usuario</a>
                                            <a data-toggle='tooltip' data-correo ='$row[correo]' id = 'btn_recuperar' title='Recuperar Contraseña' ><i class='fa fa-key pull-right'></i>Recuperar Contraseña</a>
                                            <a href='javascript:void(0)' id='a2' data-estado = '2' data-id ='$row[correo]' data-toggle='tooltip' title='Desactivar'><i class='fa fa-lock pull-right'></i>Desactivar Usuario</a>
                                        </li>
                                        <li class='divider'></li>
                                        <li>
                                            <a data-correo ='$row[correo]' id='btneliminar' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash pull-right'></i>Eliminar Usuario</a>
                                        </li>

                                    </div>
                                </td>";
                                }else{
                                    echo"<td class='text-center'>
                                    <div class='btn-group'>
                                    <a href='javascript:void(0)' data-toggle='dropdown' class='btn btn-alt btn-primary dropdown-toggle'>Seleccione <span class='caret'></span></a>
                                    <ul class='dropdown-menu dropdown-custom text-left'>
                                        <li class='dropdown-header'>Opciones</li>
                                        <li>
                                            <a id='a1' data-iid ='$row[id]' data-usuario='$row[usuario]' data-genero='$row[genero]' data-usuario='$row[usuario]' data-direccion='$row[direccion]' data-nombre ='$row[nombre]' data-telefono ='$row[telefono]' data-nivel ='$row[nivel]' data-correo ='$row[correo]'  data-id ='$row[correo]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal' ><i class='fa fa-pencil pull-right'></i>Editar Usuario</a>
                                            <a data-toggle='tooltip' data-correo ='$row[correo]' id = 'btn_recuperar' title='Recuperar Contraseña' ><i class='fa fa-key pull-right'></i>Recuperar Contraseña</a>
                                            <a href='javascript:void(0)' id='a2' data-estado = '1' data-id ='$row[correo]' data-toggle='tooltip' title='Activar'><i class='fa fa-unlock pull-right'></i>Activar Usuario</a>
                                        </li>
                                        <li class='divider'></li>
                                        <li>
                                            <a data-correo ='$row[correo]' id='btneliminar' data-toggle='tooltip' title='Eliminar' ><i class='fa fa-trash pull-right'></i>Eliminar Usuario</a>
                                        </li>
                                    </div>
                                </td>";
                                }
                                
                            }
                        }
                
                    } catch (Exception $ex) {
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
                    <h3 class="modal-title">Editar Cliente</h3>
                </div>
                <div class="modal-body">
                    
                    <form method="post" id="registro" name="registro" class="form-horizontal animation-fadeIn">
                        <input type="hidden" name="des" value="actualizar">
                        <input type="hidden" id = 'correo1' name="correo" value="">

                        <div class="row ">
                            <div class="col-md-6">
                                <div class="block">
                                    
                                    <div class="block-title">
                                         
                                        <h2><strong>Información</strong> Personal</h2>
                                    </div>
                                    
                                 
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="nombre">Nombre(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese su nombre completo" autocomplete="off">  
                                            </div>  
                                        </div>
                                        <div class="form-group">
                                                <div class="col-xs-12">
                                                    <label for="telefono">Télefono(*):</label>
                                                    <input data-toggle="tooltip" title="Este campo solo numeros que empiezen con 6,2 y 7!!" type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese su numero de telefono" autocomplete="off">    
                                                </div>    
                                        </div>
                                        <div class="form-group">
                                                <div class="col-xs-12">
                                                    <label for="direccion">Dirección(*):</label>
                                                    <textarea id="direccion" name="direccion" rows="3" class="form-control" placeholder="Escriba su dirección" autocomplete="off"></textarea>   
                                                </div>    
                                        </div>
                                        <div class="form-group"> 
                                            <div class="col-xs-12">   
                                                <label class="control-label" for="genero">Sexo</label>
                                                    <select id="genero" name="genero" class="select-chosen" data-placeholder="Seleccione el sexo" style="width: 250px;">
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Femenino">Femenino</option>
                                                    </select>
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
                                                <label for="email">Correo</label>
                                                <input type="email" id="email" onblur="validar(this)" name="email" class="form-control" placeholder="Ingrese su correo">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="usuario">Nombre de Usuario</label>
                                                <input type="usuario" id="usuario" onblur="validar(this)" name="usuario" class="form-control" placeholder="Ingrese su nombre de usuario">
                                            </div>
                                        </div>
                                        <div class="form-group"> 
                                            <div class="col-xs-12">   
                                                <label class="control-label" for="rol">Rol</label>
                                                    <select id="rol" name="rol" class="select-chosen" data-placeholder="Seleccione el rol" style="width: 250px;">
                                                        <option value="1">Administrador</option>
                                                        <option value="2">Cliente</option> 
                                                    </select>
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
                title: '¿Eliminar usuario?',
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
                    url:'json_administrar_personas.php',
                    data : get,
                }).done(function(msg) {
                    console.log(msg);
                     if(msg.exito[0]){
                        iziToast.success({
                            title: '<?php echo ELIMINAR; ?>',
                            message: '<?php echo ELIMINAR_MENSAJE;?>',
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

             $(document).on('click', "#btn_nop", function() {
                swal.close();
            });

             //recuperar contraseña


 

         $(document).on('click', "#btn_recuperar", function(e) {
            console.log("si llega");

            var elem=$(this);
            var elcorreo = elem.attr('data-correo');
            console.log(elem.attr('data-correo'));

            var get = { correo:elcorreo};
            console.log(get);
            $.ajax({
                dataType: "json",
                method: "POST",
                url:'json/recuperar_pass.php',
                data : get,
            }).done(function(msg) {
                console.log("esto trae el msg de correo",msg);
                if (msg.exito[0]=='1') {
                    swal({
                        title: 'Le hemos enviado un correo',
                        text: "",
                        html: '<br><button class="btn btn-info" id="btn_enviar" data-toggle="tooltip" data-original-title="Enviar"><i class="fa fa-check"></i> Continuar</button> ',
                        type: 'info',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowEscapeKey:false,
                        allowOutsideClick:false,
                    });
                }else {
                    swal({
                        title: 'Le hemos enviado un correo',
                        text: "",
                        html: '<br><button class="btn btn-info" id="btn_enviar" data-toggle="tooltip" data-original-title="Enviar"><i class="fa fa-check"></i> Continuar</button> ',
                        type: 'error',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowEscapeKey:false,
                        allowOutsideClick:false,
                    });
                }
            });
           
        });

        $(document).on('click', "#btn_enviar", function() {
            swal.close();
        });



        $(document).on("click", "#a1", function (e) {
            var elem=$(this);
            $("#nombre").val(elem.attr('data-nombre'));
            $("#telefono").val(elem.attr('data-telefono'));
            $("#email").val(elem.attr('data-correo'));
            console.log("el nivel",elem.attr('data-nivel'));
            $("#rol").val(elem.attr('data-nivel'));
            $("#rol").trigger('chosen:updated');
            $("#direccion").val(elem.attr('data-direccion'));
            $("#genero").val(elem.attr('data-genero'));
            $("#genero").trigger('chosen:updated');
            $("#usuario").val(elem.attr('data-usuario'));
            $("#correo1").val(elem.attr('data-correo'));
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
                url:'json_administrar_personas.php',
                data : get,
            }).done(function(msg) {
                console.log("esto trae",msg);
                
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

        $(document).on("click", "#a1", function (e) {
            var valor = $(this).attr('data-id');
            
        });

        $(document).on("click", "#a3", function (e) {

            var email = $(this).attr('data-correo');
            var id = $(this).attr('data-iid');
            
            $(location).attr('href','actualizar_perfiles.php?id='+id+'&date=<?php echo date("Yhmsi") ?>');
                    clearTimeout(timer);
        });


        $(document).on("click", "#a2", function (e) {
            var valor = $(this).attr('data-id');
            var estado = $(this).attr('data-estado');
            
            console.log(valor);
            NProgress.start();
            var get = { elcorreo:valor,des:"1",estado:estado};
            console.log(get);
            $.ajax({
                dataType: "json",
                method: "POST",
                url:'json_administrar_personas.php',
                data : get,
            }).done(function(msg) {
                console.log("esto trae",msg);
                
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

    });

</script>
<?php include '../../inc/template_end.php'; ?>