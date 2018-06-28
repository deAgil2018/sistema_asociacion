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
                     
                    <h2><strong>Información del</strong> Contacto</h2>
                </div>
                    <input type="hidden" name="ingenio" id="ingenio" value="<?php echo $_GET[id] ?>">
                    <!--Nombre-->
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="nombre1">Nombre(*):</label>
                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="nombre1" name="nombre1" class="form-control" placeholder="Ingrese el nombre del contacto" autocomplete="off">  
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
                     
                    <h2><strong>Información del</strong> Telefono</h2>
                </div>
                
                 
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="telefono1">Número de Telefono(*):</label>
                            <input data-toggle="tooltip" title="Este campo solo permite numeros que empiezen en 2,6 y 7!" type="text" id="telefono1" name="telefono1" class="form-control" placeholder="Ingrese número de telefono" autocomplete="off">  
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
<script src="../../js/pages/telefono_operador.js?id=<?php echo date('Yidisus') ?>"></script>
<script>
$(function(){ 
    Telefonos_operador.init(); 
    $(document).on("submit", "#registro", function (e) {
        console.log("eleangel");
        e.preventDefault();
        NProgress.start();
        var datos=$("#registro").serialize();
        console.log("el formulario",datos);

            $.ajax({
                dataType: "json",
                method: "POST",
                url:'insertar_telefono_operador.php',
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
                NProgress.done();
                $(location).attr('href','actualizar_telefono_operador.php?date=<?php echo date("Yhmsi") ?>&id=<?php echo $_GET[id] ?>');

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