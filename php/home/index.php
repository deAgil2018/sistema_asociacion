<?php 
    @session_start();
    //echo $_SESSION['autentica']."STO TRAE"; exit();
    if(!isset($_SESSION['loggedin']) && $_SESSION['autentica'] != "simon"){
        if($_SESSION['autentica'] != "simon" )
        {
             header("Location: destruir.php");  
            exit(); 
        }else{
          
             header("Location: destruir.php");  
            exit(); 

        }
    }else{
        
    }//prueba
?>

<?php 

include '../../inc/config.php'; ?>
<?php include '../../inc/template_start.php'; ?>
<?php include '../../inc/page_head.php'; ?>


<?php
    
    include_once('../../Conexion/Conexion.php');
    $sql= "SELECT 
    p.direccion,
    p.telefono,
    p.correo,
    p.genero,
    p.estado, 
    p.nombre,
    p.nivel,
    p.id 
    AS elid 
    FROM personas AS p  
    WHERE p.estado = '1' OR p.estado = '2'";
    $datos =null;
    try {
        $comandose = Conexion::getInstance()->getDb()->prepare($sql);
        $comandose->execute();
        $datos = $comandose->fetchAll();
    } catch (Exception $exxx) {
        echo $exxx->getMessage();
    }
    
?>


<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
    <div class="content-header content-header-media">
        <div class="header-section">
            <div class="row">
                <!-- Main Title (hidden on small devices for the statistics to fit) -->
                <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                    <h1>Bienvenido <strong><?php echo $_SESSION['nombre']; ?></strong><br><small></small></h1>
                </div>
                <!-- END Top Stats -->
            </div>
        </div>
        <!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
        <img src="../../img/placeholders/headers/dashboard_header.jpg" alt="header image" class="animation-pulseSlow">
    </div>
    <!-- END Dashboard Header -->

    <!-- Mini Top Stats Row -->
    


    <div class="block">
        <!-- Progress Bars Wizard Title -->
        <div class="block-title">
            <h2><strong>Listado de Contactos</strong></h2>
        </div>
        <!-- END Progress Bar Wizard Title -->

        <!-- Progress Bar Wizard Content -->
        <div class="row">
            <div class="col-sm-12 col-sm-offset-0">
                <a class="btn btn-sm btn-primary" href="excel" target="_blank"><i class="fa fa-user"></i> Descargar</a>
                <table id="ecom-products" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $n=1; foreach ($datos as $row) { ?>
                        <tr>
                            <td><?=$n?></td>
                            <td><?=($row[nombre])?></td>
                            <td><?=($row[direccion])?></td>
                            <td style="white-space: nowrap;"><?=$row[correo]?></td>
                            <td style="white-space: nowrap;"><?=$row[telefono]?></td>
                        </tr>
                        <?php $n++;} ?>
                    </tbody>
                </table>
                <br><br>
            </div>
        </div>
    </div>

     
</div>
<!-- END Page Content -->

<?php include '../../inc/page_footer.php'; ?>
<?php include '../../inc/template_scripts.php'; ?>

<script src="../../js/pages/tabla_perfiles.js"></script>
<script>$(function(){ Perfiles.init(); });</script>
<!-- Google Maps API Key (you will have to obtain a Google Maps API key to use Google Maps) -->
<!-- For more info please have a look at https://developers.google.com/maps/documentation/javascript/get-api-key#key -->


<!-- Load and execute javascript code used only in this page -->







<?php include '../../inc/template_end.php'; ?>



<script>

</script>
