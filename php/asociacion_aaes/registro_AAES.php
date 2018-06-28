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
    <form action="page_forms_general.php" method="post" id="registro_AAES" name="registro_AAES" class="form-horizontal animation-fadeIn">
    <div class="row ">
        <div class="col-md-6">
            <div class="block">
                
                <!--Formulario-->
                <div class="block-title">
                     
                    <h2><strong>Información de</strong> Asociación</h2>
                </div>
                
                    <!--Nombre-->
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

                    

                     
                    
                   
                
            </div>
            
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



                    
                
            </div>
            
        </div>


         
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="block">
                
                <div class="block-title">
                     
                    <h2><strong>Información de la</strong> Cuenta</h2>
                </div>
                
                    <div class="form-group form-actions">
                        <center>
                            <button type="submit" class="btn btn-alt btn-success"><i class="fa fa-save"></i> Registro</button>
                            <button type="reset" class="btn btn-alt btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                        </center>
                    </div>
                     <input type="hidden" name="variable" value="1">
                </form>
                
            </div>
            
        </div>
        
    </div>
</div>
<?php include '../../inc/page_footer.php'; ?>
<?php include '../../inc/template_scripts.php'; ?>
<script src="../../js/pages/Validaciones_AAES.js?id=<?php echo date('Yidisus'); ?>"></script>
<script>
$(function(){ 
    Validaciones_AAES.init(); 
    $(document).on("submit", "#registro_AAES", function (e) {
        console.log("eleangel");
        e.preventDefault();
        NProgress.start();
        var datos=$("#registro_AAES").serialize();
        console.log("el formulario",datos);

            $.ajax({
                dataType: "json",
                method: "POST",
                url:'json_ele/administracion_AAES.php',
                data : datos,
            }).done(function(msg) {
            console.log("esto trae",msg);
            if(msg.exito){

                iziToast.success({
                    title: 'Excelente',
                    message: '¡Sus datos han sido almacenados con éxito!',
                    timeout: 3000,
                });

                $(this).prop('disabled', true);
                var timer=setInterval(function(){
                    $(location).attr('href','administrar_AAES.php?id='+msg.exito[1]+'&date=<?php echo date("Yhmsi") ?>');
                    clearTimeout(timer);
                },3500);
                NProgress.done();
            }if(msg.error){
                NProgress.done();
            }
        });


    });
   });
</script>

<script>
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

    }

</script>
<script src="../../js/pages/ecomProducts.js"></script>
<script>$(function(){ EcomProducts.init(); });</script>
<?php include '../../inc/template_end.php'; ?>