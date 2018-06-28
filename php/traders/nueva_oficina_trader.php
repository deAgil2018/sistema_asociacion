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
<div id="page-content"  >
    <form action="page_forms_general.php" method="post" id="registro" name="registro" class="form-horizontal animation-fadeIn">
    <div class="row ">
        <div class="col-md-6">
            <div class="block">
                
                <!--Formulario-->
                <div class="block-title">
                     
                    <h2><strong>Información de la</strong> Oficina</h2>
                </div>
                    <input type="hidden" name="trader" id="trader" value="<?php echo $_GET[id] ?>">
                    <!--Nombre-->
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="nombre1">Nombre(*):</label>
                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="nombre1" name="nombre1" class="form-control" placeholder="Ingrese el nombre de la oficina" autocomplete="off">  
                        </div>  
                    </div>

                                        <!--Codigo Contrato-->
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="co_contrato">Código de Contrato(*):</label>
                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="co_contrato" name="co_contrato" class="form-control" placeholder="Ingrese el código de contrato" autocomplete="off">  
                        </div>  
                    </div>

                                        <!--Codigo Direccion-->
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="co_direccion">Código Postal(*):</label>
                            <input data-toggle="tooltip" title="Este campo solo permite numeros!" type="text" id="co_direccion" name="co_direccion" class="form-control" placeholder="Ingrese el código postal" autocomplete="off">  
                        </div>  
                    </div>

                    <!--Direccion-->
                    <div class="form-group">
                            <div class="col-xs-12">
                                <label for="direccion">Dirección(*):</label>
                                <textarea id="direccion" name="direccion" rows="5" class="form-control" placeholder="Ingrese la dirección"></textarea>    
                            </div>    
                    </div>
                             
                    
                    <!--div class="form-group">
                        <div class="col-xs-12">
                            <label for="direccion">Dirección(*):</label>
                            <textarea id="direccion" name="direccion" rows="2" data-toggle="tooltip" title="Ingrese su dirección
                            !" class="form-control" placeholder="Ingrese su dirección"></textarea>
                        </div>
                    </div-->
                
                
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
                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_operativo" name="con_operativo" class="form-control" placeholder="Ingrese contacto operativo" autocomplete="off">  
                        </div>  
                    </div>


                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="con_comercial">Contacto Comercial(*):</label>
                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_comercial" name="con_comercial" class="form-control" placeholder="Ingrese contacto comercial" autocomplete="off">  
                        </div>  
                    </div>


                     <div class="form-group">
                        <div class="col-xs-12">
                            <label for="con_financiero">Contacto Financiero(*):</label>
                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_financiero" name="con_financiero" class="form-control" placeholder="Ingrese contacto financiero" autocomplete="off">  
                        </div>  
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="con_documentacion">Contacto de Documentacion(*):</label>
                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_documentacion" name="con_documentacion" class="form-control" placeholder="Ingrese contacto de la documentación" autocomplete="off">  
                        </div>  
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="con_otros">Otros Contactos(*):</label>
                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas, numeros y espacios!" type="text" id="con_otros" name="con_otros" class="form-control" placeholder="Ingrese otros contactos" autocomplete="off">  
                        </div>  
                    </div>
                
            </div>
            
        </div>


         
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="block">
                
                <div class="block-title">
                     
                    <h2><strong>Area de</strong> Acciones</h2>
                </div>
                
                    <div class="form-group form-actions">
                        <center>
                            <button type="submit" class="btn btn-alt btn-success"><i class="fa fa-save"></i> Registro</button>
                            <button type="reset" class="btn btn-alt btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                        </center>
                    </div>
                </form>
                
            </div>
            
        </div>
        
    </div>
</div>
<?php include '../../inc/page_footer.php'; ?>
<?php include '../../inc/template_scripts.php'; ?>
<script src="../../js/pages/oficinas_trader.js?id=<?php echo date('Yidisus') ?>"></script>
<script>
$(function(){ 
    Oficinas_trader.init(); 
    $(document).on("submit", "#registro", function (e) {
        console.log("eleangel");
        e.preventDefault();
        NProgress.start();
        var datos=$("#registro").serialize();
        console.log("el formulario",datos);

            $.ajax({
                dataType: "json",
                method: "POST",
                url:'json_insertar_oficina.php',
                data : datos,
            }).done(function(msg) {
            console.log("esto trae",msg);
            if(msg.exito){

                

                iziToast.success({
                    title: '<?php echo EXITO; ?>',
                    message: '<?php echo EXITO_MENSAJE;?>',
                    timeout: 3000,
                });
                NProgress.done();

                $(this).prop('disabled', true);
                var timer=setInterval(function(){
                     $(location).attr('href','actualizar_oficinas_trader.php?date=<?php echo date("Yhmsi") ?>'+'&trader=<?php echo $_GET[id]?>');
                    clearTimeout(timer);
                },3500);



              
                

            }if(msg.error){
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

<!--<script>
    function validar(e){
        console.log("salado");
        var de = $(e).val();
        var eledata = {ele:'1', data:de};
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'json/validar_trader.php',
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

    }-->

</script>
<script src="../../js/pages/ecomProducts.js"></script>
<script>$(function(){ EcomProducts.init(); });</script>
<?php include '../../inc/template_end.php'; ?>