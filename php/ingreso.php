<?php 
    @session_start();
    //echo $_SESSION['autentica']."STO TRAE";
    if(isset($_SESSION['loggedin']) && $_SESSION['autentica'] == "simon"){
        if($_SESSION['autentica'] == "simon" )
        {
            header("Location: index.php");  
            exit(); 
        }else{
          
             

        }
    }else{
        
    }
?>
<?php include '../inc/config.php'; ?>
<?php include '../inc/template_start.php'; ?>

<!-- Login Full Background -->
<!-- For best results use an image with a resolution of 1280x1280 pixels (prefer a blurred image for smaller file size) -->
<img src="../img/placeholders/backgrounds/coming_soon_full_bg.jpg" alt="Login Full Background" class="full-bg animation-pulseSlow">
<!-- END Login Full Background -->

<!-- Login Container -->
<div id="login-container" class="animation-fadeIn">
    <!-- Login Title -->
    <div class="login-title text-center">
        <h1>  <strong><?php echo $template['name']; ?></strong><br><small>Por favor  <strong>Ingrese sus datos</strong></small></h1>
    </div>
    <!-- END Login Title -->

    <!-- Login Block -->
    <div class="block push-bit">
        <!-- Login Form -->
        <form action="duo_pass.php" method="post" id="form-login_duo" class="hidden-print">
            <input type="hidden" id="duo_user" name="user" value="">
            <input type="hidden" id="duo_mensaje2" name="mensaje2" value="">
        </form>

        <form action="index.php" method="post" id="form-login" class="form-horizontal form-bordered form-control-borderless">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                        <input type="text" id="login-email" name="login-email" class="form-control input-lg" placeholder="Email">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        <input type="password" id="login-password" name="login-password" class="form-control input-lg" placeholder="Password">
                    </div>
                </div>
            </div>
            <div class="form-group form-actions">
                
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Iniciar sesión</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 text-left">
                    <!--a href="javascript:void(0)" id="link-reminder-login"><small>Olvidó su contraseña?</small></a--> 
                </div>
            </div>
        </form>
       
    </div>
 
</div>

 

<?php include '../inc/template_scripts.php'; ?>
<script src="../js/pages/login.js"></script>
<script>
$(function(){ 
    Login.init(); 
   
    $(document).on("submit", "#form-login", function (e) {
        console.log("eleangel");
        e.preventDefault();

        var get = { usuario:$("#login-email").val(), password:$("#login-password").val() ,id:"1" };
        console.log(get);
        $.ajax({
            dataType: "json",
            method: "POST",
            url:'json/consultar_usuario.php',
            data : get,
        }).done(function( msg ) {
            console.log("esto trae",msg);
            if(msg.exito[0] == '0'){
               
                $.bootstrapGrowl('<h4>Error !</h4> <p>Datos muy invalidos!</p>', {
                    type: "danger",
                    delay: 2500,
                    allow_dismiss: true
                });
            }
            else if(msg.exito[0] == '1'){
                
                $.bootstrapGrowl('<h4>Bienvenido!</h4> <p>'+msg.exito[1]+'!</p>', {
                    type: "success",
                    delay: 2500,
                    allow_dismiss: true
                });

                $(this).prop('disabled', true);
                var timer=setInterval(function(){
                    $(location).attr('href','index.php?id='+msg.exito[1]+'&date=<?php echo date("Yhmsi") ?>');
                    clearTimeout(timer);
                },2500);
                /*$("#duo_user").val($("#login-email").val());
                $("#duo_mensaje2").val(msg.exito[1]);
                $("#form-login_duo").submit();*/
            }
            else if(msg.exito[0] == '2'){
               
                $.bootstrapGrowl('<h4>Error !</h4> <p>Usuario desactivado!</p>', {
                    type: "warning",
                    delay: 2500,
                    allow_dismiss: true
                });

            }else{
                $.bootstrapGrowl('<h4>Error !</h4> <p>Datos invalidos!</p>', {
                    type: "danger",
                    delay: 2500,
                    allow_dismiss: true
                });
            }
        });

        return false;
    });
});


</script>

<?php include '../inc/template_end.php'; ?>