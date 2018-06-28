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
<?php include '../inc/config.php'; ?>
<?php include '../inc/template_start.php'; ?>
<?php include '../inc/page_head.php'; ?>
<div id="page-content"  >
    <form action="page_forms_general.php" method="post" id="registro" name="registro" class="form-horizontal animation-fadeIn">
    <div class="row ">
        <div class="col-md-6">
            <div class="block">
                
                <!--Formulario-->
                <div class="block-title">
                     
                    <h2><strong>Información de la</strong> Empresa</h2>
                </div>
                    <input type="hidden" name="trader" id="trader" value="<?php echo $_GET[id] ?>">
                    <!--Nombre-->
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

 
                    <div class="form-group">
                            <div class="col-xs-12">
                                <label for="tipo_empresa1">Tipo de Empresa(*):</label>
                                <input data-toggle="tooltip" title="Este campo solo premite letras mayusculas, minusculas y espacios!" type="text" id="tipo_empresa1" name="tipo_empresa1" class="form-control" placeholder="Ingreso el tipo de empresa" autocomplete="off">    
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
                     
                    <h2><strong>Información </strong> Adicional</h2>
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
<?php include '../inc/page_footer.php'; ?>
<?php include '../inc/template_scripts.php'; ?>
<script src="../js/pages/empresa.js?id=<?php echo date('Yidisus') ?>"></script>
<script>
$(function(){ 
    Empresa.init(); 
    $(document).on("submit", "#registro", function (e) {
        console.log("eleangel");
        e.preventDefault();
        NProgress.start();
        var datos=$("#registro").serialize();
        console.log("el formulario",datos);

            $.ajax({
                dataType: "json",
                method: "POST",
                url:'json/insertar_empresa.php',
                data : datos,
            }).done(function(msg) {
            console.log("esto trae",msg);
            if(msg.exito){

                $.bootstrapGrowl('<h4>Excelente!</h4> <p>el cliente ha sido registrado!</p>', {
                    type: "success",
                    delay: 2500,
                    allow_dismiss: true
                });

                /*$(this).prop('disabled', true);
                var timer=setInterval(function(){
                    location.reload();
                    clearTimeout(timer);
                },2500);*/
                $('#registro')[0].reset();
                NProgress.done();
                $(location).attr('href','actualizar_empresa.php?date=<?php echo date("Yhmsi") ?>');

            }if(msg.error){
                NProgress.done();
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
<script src="../js/pages/ecomProducts.js"></script>
<script>$(function(){ EcomProducts.init(); });</script>
<?php include '../inc/template_end.php'; ?>