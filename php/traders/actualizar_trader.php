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
                    <th class="text-left">Fax</th>
                    <th class="text-left">Oficinas</th>
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
                                id,
                                UPPER(nombre) as elnombre,
                                telefono,
                                fax_ingresado,
                                tax_id,
                                correo,
                                UPPER(direccion) as direccion,
                                cuanto
                            FROM
                                (
                                    SELECT
                                    tr.id,
                                    tr.nombre,
                                    tr.telefono,
                                    tr.fax_ingresado,
                                    tr.tax_id,
                                    tr.correo,
                                    tr.direccion,
                                    count(fft.codigo_trader) AS cuanto 
                                FROM
                                    traders as tr
                                left JOIN foranea_oficinas_trader AS fft 
                                ON fft.codigo_trader = tr.id
                                GROUP BY 
                                    id,
                                    nombre,
                                    telefono,
                                    fax_ingresado,
                                    tax_id,
                                    correo,
                                    direccion
                                ORDER BY
                                    nombre ASC 
                                ) as a1";

                    try {
                        require_once '../../Conexion/Conexion.php';
                        $comando = Conexion::getInstance()->getDb()->prepare($sql);
                        $comando->execute();
                        $as = 0;
                        while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                            $as++;
                            echo"<tr>";
                          
                            echo"<td>$row[elnombre]</td>";
                            echo"<td>$row[telefono]</td>";
                            echo"<td>$row[fax_ingresado]</td>";

                            if ($row[cuanto]==0) {
                                echo"<td class='text-center'><a id='ver_oficinas' data-id='-2' href='javascript:void(0)' class='text-right'><strong>SIN OFICINAS</strong></a></td>";
                            }else{
                                echo"<td class='text-center'><a data-id='$row[id]' id='ver_oficinas' href='javascript:void(0)' class='text-right'><strong>$row[cuanto]</strong></a></td>";
                            }
                            


                            echo"<td>$row[correo]</td>";
 

                            echo"<td class='text-center'>
                                 <div class='btn-group'>
                                    <a href='javascript:void(0)' data-toggle='dropdown' class='btn btn-alt btn-primary dropdown-toggle'>Seleccione <span class='caret'></span></a>
                                    <ul class='dropdown-menu dropdown-custom text-left'>
                                        <li class='dropdown-header'>Opciones</li>
                                        <li>
                                            <a id='a1' data-iid ='$row[id]' data-coficina='$row[codigo_oficina]' data-identificador='$row[identificador]' data-direccion='$row[direccion]' data-nombre ='$row[elnombre]' data-telefono ='$row[telefono]' data-fax ='$row[fax_ingresado]' data-correo ='$row[correo]' data-tax ='$row[tax_id]' data-id ='$row[correo]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal'><i class='fa fa-pencil pull-right'></i>Editar Datos</a>
                                            <a data-correo ='$row[correo]' data-elid='$row[id]' id='btn_oficina' data-toggle='tooltip' title='Agregar oficina'><i class='fa fa-plus pull-right'></i>Agregar Oficina</a>
                                            <a data-correo ='$row[correo]' data-elid='$row[id]' id='btn_actualizar_oficina' data-toggle='tooltip' title='Actualizar oficina'><i class='fa fa-wrench pull-right'></i>Actualizar Oficinas</a>
                                            
                                        </li>
                                        <li class='divider'></li>
                                        <li>
                                            <a data-correo ='$row[correo]' id='btneliminar' data-toggle='tooltip' title='Eliminar' ><i class='fa fa-trash pull-right'></i>Eliminar Trader</a>
                                        </li>
                                    </ul>
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
                        <input type="hidden" name="ele" id="ele">
                        <input type="hidden" name="correo_anterior" id="correo_anterior">
                        <input type="hidden" name="elid" id="elid">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="block">
                                    
                                    <div class="block-title">
                                         
                                        <h2><strong>Información de la</strong> Empresa</h2>
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
                                                    <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese su numero de telefono" autocomplete="off">    
                                                </div>    
                                        </div>
                                        <div class="form-group">
                                                <div class="col-xs-12">
                                                    <label for="telefono">FAX(*):</label>
                                                    <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="fax" name="fax" class="form-control" placeholder="Ingrese su numero de fax" autocomplete="off">    
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
                                                <label for="email">Correo(*)</label>
                                                <input type="email" id="email" autocomplete="off" onblur="validar(this)" name="email" class="form-control" placeholder="Ingrese su correo">
                                            </div>
                                        </div>
                                         
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="tax">Codigo de Impuesto(*):</label>
                                                <input data-toggle="tooltip" title="Este campo solo permite letras numeros!" type="text" id="tax" name="tax" class="form-control" placeholder="Ingrese el código de impuesto" autocomplete="off">
                                            </div>  
                                        </div> 

                                        <div class="form-group">
                                                <div class="col-xs-12">
                                                    <label for="direccion">Dirección(*):</label>
                                                    <textarea id="direccion" name="direccion" rows="1" class="form-control" placeholder="Escriba su dirección" autocomplete="off"></textarea>   
                                                </div>    
                                        </div> 
                                    
                                </div>
                                
                            </div>
                             
                        </div>

                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-sm btn-default" data-dismiss="modal"><?php echo CERRAR_MODAL ?></button>
                    <button type="button" id="m_save" class="btn btn-sm btn-primary"><?php echo ACTUALIZAR ?></button>
                </div>
            </div>
        </div>
    </div>



    <div id="modal_oficinas" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Listado de Oficinas</h4>
          </div>
          <div class="modal-body">
            <div class="row" id="cargar_aqui">
                
            </div>
             
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>


    <div id="modal_detalle_oficinas" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detalle de Oficina</h4>
          </div>
          <div class="modal-body">
            <div class="row" id="cargar_aqui_2">
                
            </div>
             
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

</div>
<?php include '../../inc/page_footer.php'; ?>
<?php include '../../inc/template_scripts.php'; ?>

<!-- Load and execute javascript code used only in this page -->
<script src="../../js/pages/ecomProducts.js?id=<?php echo date('Yidisus') ?>"></script>
<script>$(function(){ EcomProducts.init(); });</script>

<script>
    function validar(e){
        console.log("salado");
        var de = $(e).val();
        var email_anterior = $("#correo_anterior").val();
        var eledata = {ele:'2', data:de, email_anterior:email_anterior};
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'json_validar_trader.php',
            data : eledata,
        }).done(function(msg) {
            console.log(msg);
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
        $(document).on("click", "#a_datos", function (e) {
            var elem=$(this);
            var id_traido = elem.attr('data-iid');
            
            console.log("El id que trae",id_traido);
            var datos = { eltrader:id_traido,des:"2"};
            console.log(datos);
            $.ajax({
                dataType: "json",
                method: "POST",
                url:'json_oficinas_trader.php',
                data : datos,
            }).done(function(msg) {
                console.log("esto trae el ver",msg);
                $("#cargar_aqui_2").empty();
                $("#cargar_aqui_2").html(msg.exito[2]);
                $("#modal_detalle_oficinas").modal({
                    show: 'false'
                });

            });
            
            
        });

        /****ver oficinas de traders****/
         $(document).on('click', "#ver_oficinas", function() {
            var elem=$(this);
            var id_traido = elem.attr('data-id');

            if (id_traido=='-2') {
                iziToast.error({
                    title: 'Lo siento',
                    message: '¡El trader seleccinado no posee oficinas!',
                    timeout: 3000,
                });
            }else{
                console.log("El id que trae",id_traido);
                var get = { eltrader:id_traido,des:"1"};
                console.log(get);

                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url:'json_oficinas_trader.php',
                    data : get,
                }).done(function(msg) {

                    console.log("retorna",msg);
                    

                    $("#cargar_aqui").empty();
                    $("#cargar_aqui").html(msg.exito[2]);

                    App.datatables();
                    $('#oficinas_tabla').dataTable({
                        columnDefs: [
                            { type: 'date-custom', targets: [4] },
                            { orderable: false, targets: [5] }
                        ],
                        order: [[ 0, "desc" ]],
                        pageLength: 20,
                        lengthMenu: [[10, 20, 30, -1], [10, 20, 30, 'All']]
                    });


                    $("#modal_oficinas").modal({
                        show: 'false'
                    });
                    //$("#modal_ele").modal('toggle');
                });
            }
            
        });
        /****abrir modal*******/
        
            $(document).on("click", "#btneliminar", function (e) {
                var elem=$(this);
                var elcorre = elem.attr('data-correo');
                console.log("llega correo1",elcorre);
                
                swal({
                    title: '¿<?php echo MENSAJE_ELIMINAR_ALERT?>?',
                    text: "",
                    html: 
                    '<br><button class="btn btn-danger" data-elcorreo ="'+elcorre+'" id="btn_eliminar" data-toggle="tooltip" data-original-title="Eliminar"><?php echo ELIMINAR_ALERT ?></button> ' +
                    '<button class="btn btn-warning" id="btn_cancelar" data-toggle="tooltip" data-original-title="Cancelar"> <?php echo CANCELAR_ALERT ?></button>'
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
                    url:'json_actualizar_traders.php',
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
                        
                    }else if (msg.exito[4]){
                        NProgress.done();
                        iziToast.error({
                            title: '<?php echo ERROR; ?>',
                            message: '<?php echo ERROR_MENSAJE;?>',
                            timeout: 3000,
                        });
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



        $(document).on('click', "#btn_enviar", function() {
            swal.close();
        });


        $(document).on("click", "#btn_oficina", function (e) {
            var elem=$(this);
            var trader =elem.attr('data-elid');
            $(location).attr('href','nueva_oficina_trader.php?id='+trader+'&date=<?php echo date("Yhmsi") ?>');

        });

         $(document).on("click", "#btn_actualizar_oficina", function (e) {
            var elem=$(this);
            var trader =elem.attr('data-elid');
            $(location).attr('href','actualizar_oficinas_trader.php?trader='+trader+'&date=<?php echo date("Yhmsi") ?>');

        });

        $(document).on("click", "#a1", function (e) {
            var elem=$(this);
            $("#nombre").val(elem.attr('data-nombre'));
            $("#elid").val(elem.attr('data-iid'));            
            $("#telefono").val(elem.attr('data-telefono'));
            $("#email").val(elem.attr('data-correo'));
            $("#correo_anterior").val(elem.attr('data-correo'));
            $("#fax").val(elem.attr('data-fax'));
            $("#direccion").val(elem.attr('data-direccion'));
            $("#tax").val(elem.attr('data-tax'));
            $("#coficina").val(elem.attr('data-coficina'));
            $("#identificador").val(elem.attr('data-identificador'));
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
                url:'json_actualizar_traders.php',
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

    });

</script>
<?php include '../../inc/template_end.php'; ?>