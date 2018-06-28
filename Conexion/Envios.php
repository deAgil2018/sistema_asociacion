<?php 
	@session_start();
	require_once 'Conexion.php';
	/**
	* 
	*/
	class Envios 
	{
		
		function __construct()
		{
			# code...
		}

		public static function generarpass(){
            $cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $cadena_base .= '0123456789' ;
            //$cadena_base .= '!@#%^&*()_,./<>?;:[]{}\|=+';
            $cadena_base .= '%&()=+';

          $password = '';
          $limite = strlen($cadena_base) - 1;
            $largo = 10;
          for ($i=0; $i < $largo; $i++)
            $password .= $cadena_base[rand(0, $limite)];

          return $password;
        }


        public static function actualizarcontrase($email,$contra){
			
			$query1 = "UPDATE usuarios as u SET u.password=PASSWORD('$contra'),recuperado='1' WHERE u.correo = '$email' OR u.usuario = '$email'";
			try {
				$comando1 = Conexion::getInstance()->getDb()->prepare($query1);
        		$comando1->execute();
        		 
			} catch (Exception $e) {
				return -1;
			}


			$query_otro = "SELECT
								e.correo,
								e.nombre as elnombre,
								e.empresa,
								em.nombre, em.imagen
							FROM
								empleados as e
							JOIN empresas as em
							ON e.empresa = em.id
							WHERE
								e.correo='$email'";

			 
			try {
				$ejecucion = Conexion::getInstance()->getDb()->prepare($query_otro);
	          	$ejecucion->execute();
	          	while ($row = $ejecucion->fetch(PDO::FETCH_ASSOC)) {
	          		$empresa = $row[nombre];
	          		$imagen = $row[imagen];
	          		$elnombre = $row[elnombre];
	          	}
			} catch (Exception $ex) {
				return $ex;
			}
			
			
            $para = $email;
            $asunto = 'ACTUALIZACIÓN DE CONTRASEÑA';
			$anio = date("Y");
            $mensaje = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				    <head>
				        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				        <title>BIENVENIDO A '.$empresa.'</title>
				        <meta name="viewport" content="width=device-width" />
				       <style type="text/css">
				            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
				                body[yahoo] .buttonwrapper { background-color: transparent !important; }
				                body[yahoo] .button { padding: 0 !important; }
				                body[yahoo] .button a { background-color: #1ec1b8; padding: 15px 25px !important; }
				            }

				            @media only screen and (min-device-width: 601px) {
				                .content { width: 600px !important; }
				                .col387 { width: 387px !important; }
				            }
				            td {
				            	box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);
							}
				        </style>
				    </head>
				    <body bgcolor="#32323a" style="margin: 0; padding: 0;" yahoo="fix">
				        <!--[if (gte mso 9)|(IE)]>
				        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
				          <tr>
				            <td>
				        <![endif]-->
				        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
				             
				            <tr>
				                <td align="center" bgcolor="#ffffff" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; background-color: #575756; font-size: 36px; font-weight: bold; box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <img src="http://'.$_SERVER[SERVER_NAME].'/'.HOST.'/php/json/imagenes/'.$imagen.'" alt="LOGODELE" width="105" height="83" style="display:block;" />
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#ffffff" style="padding: 40px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6; box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>Hola '.$_SESSION[nombre].'</b><br>Su contrase&ntilde;a ha sido actualizada, para poder ingresar de ahora en adelante  utilice su nueva contrase&ntilde;a y su correo:
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#f9f9f9" style="padding: 20px 20px 0 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>Cuenta:</b> '.$email.' <br>
				                   
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif; border-bottom: 1px solid #f6f6f6;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <table bgcolor="#1ec1b8" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
				                        <tr>
				                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);" class="button">
				                                <a href="#" style="color: #ffffff; text-align: center; text-decoration: none;">Descargar Aplicaci&oacute;n</a>
				                            </td>
				                        </tr>
				                    </table>
				                </td>
				            </tr>
				             
				            <tr>
				                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>'.$empresa.'</b><br/>El Salvador
				                </td>
				            </tr>
				            <tr>
				                <td style="padding: 15px 10px 15px 10px;">
				                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
				                        <tr>
				                            <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
				                                <?php echo $anio;?> &copy; <a href="estudioagil.com" style="color: #1ec1b8;">estudioagil.com</a>
				                            </td>
				                        </tr>
				                    </table>
				                </td>
				            </tr>
				        </table>
				        <!--[if (gte mso 9)|(IE)]>
				                </td>
				            </tr>
				        </table>
				        <![endif]-->
				    </body>
				</html>';
            // Para enviar un correo HTML, debe establecerse la cabecera Content-type
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $cabeceras .= 'From: contacto@empresa.com' . "\r\n" . //La direccion de correo desde donde supuestamente se envió
                        'X-Mailer: PHP/' . phpversion();  //información sobre el sistema de envio de correos, en este caso la version de PHP
            // Cabeceras adicionales
            $cabeceras .= 'To: NutriConsultores Registro <registro@empresa.com>' . "\r\n";
            // Enviarlo
            try {
                 if(mail($para, $asunto, $mensaje, $cabeceras)){

                    return 1;
                }else{
                    return -2;
                }

            } catch (Exception $e) {
                return -3;
            }


        }


        public static function actualizarcontrase2($email,$contra){
			
			$query1 = "UPDATE usuarios as u SET u.password=PASSWORD('$contra'),recuperado='0' WHERE u.correo = '$email'";
			try {
				$comando1 = Conexion::getInstance()->getDb()->prepare($query1);
        		$comando1->execute();
        		 
			} catch (Exception $e) {
				return -1;
			}


			$query_otro = "SELECT
								e.correo,
								e.empresa,
								e.nombre as elnombre,
								em.nombre, em.imagen
							FROM
								empleados as e
							JOIN empresas as em
							ON e.empresa = em.id
							WHERE
								e.correo='$email'";

			 
			try {
				$ejecucion = Conexion::getInstance()->getDb()->prepare($query_otro);
	          	$ejecucion->execute();
	          	while ($row = $ejecucion->fetch(PDO::FETCH_ASSOC)) {
	          		$empresa = $row[nombre];
	          		$imagen = $row[imagen];
	          		$elnombre = $row[elnombre];
	          	}
			} catch (Exception $ex) {
				return $ex;
			}
			
			
            $para = $email;
            $asunto = 'ACTUALIZACIÓN DE CONTRASEÑA';
			$anio = date("Y");
            $mensaje = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				    <head>
				        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				        <title>BIENVENIDO A '.$empresa.'</title>
				        <meta name="viewport" content="width=device-width" />
				       <style type="text/css">
				            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
				                body[yahoo] .buttonwrapper { background-color: transparent !important; }
				                body[yahoo] .button { padding: 0 !important; }
				                body[yahoo] .button a { background-color: #1ec1b8; padding: 15px 25px !important; }
				            }

				            @media only screen and (min-device-width: 601px) {
				                .content { width: 600px !important; }
				                .col387 { width: 387px !important; }
				            }
				            td {
				            	box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);
							}
				        </style>
				    </head>
				    <body bgcolor="#32323a" style="margin: 0; padding: 0;" yahoo="fix">
				        <!--[if (gte mso 9)|(IE)]>
				        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
				          <tr>
				            <td>
				        <![endif]-->
				        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
				             
				            <tr>
				                <td align="center" bgcolor="#ffffff" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; background-color: #575756; font-size: 36px; font-weight: bold; box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <img src="http://'.$_SERVER[SERVER_NAME].'/'.HOST.'/php/json/imagenes/'.$imagen.'" alt="LOGODELE" width="105" height="83" style="display:block;" />
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#ffffff" style="padding: 40px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6; box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>Hola '.$elnombre.'</b><br>Su contrase&ntilde;a ha sido actualizada automaticamente, para poder ingresar de ahora en adelante  utilice su nueva contrase&ntilde;a y su correo:
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#f9f9f9" style="padding: 20px 20px 0 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>Cuenta:</b> '.$email.' <br>
				                   
				                </td>
				            </tr>

				            <tr>
				                <td align="center" bgcolor="#f9f9f9" style="padding: 20px 20px 0 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>Contrase&ntilde;a:</b> '.$contra.' <br>
				                   
				                </td>
				            </tr>


				            <tr>
				                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif; border-bottom: 1px solid #f6f6f6;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <table bgcolor="#1ec1b8" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
				                        <tr>
				                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);" class="button">
				                                <a href="#" style="color: #ffffff; text-align: center; text-decoration: none;">Descargar Aplicaci&oacute;n</a>
				                            </td>
				                        </tr>
				                    </table>
				                </td>
				            </tr>
				             
				            <tr>
				                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>'.$empresa.'</b><br/>El Salvador
				                </td>
				            </tr>
				            <tr>
				                <td style="padding: 15px 10px 15px 10px;">
				                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
				                        <tr>
				                            <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
				                                <?php echo $anio;?> &copy; <a href="estudioagil.com" style="color: #1ec1b8;">estudioagil.com</a>
				                            </td>
				                        </tr>
				                    </table>
				                </td>
				            </tr>
				        </table>
				        <!--[if (gte mso 9)|(IE)]>
				                </td>
				            </tr>
				        </table>
				        <![endif]-->
				    </body>
				</html>';
            // Para enviar un correo HTML, debe establecerse la cabecera Content-type
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $cabeceras .= 'From: contacto@empresa.com' . "\r\n" . //La direccion de correo desde donde supuestamente se envió
                        'X-Mailer: PHP/' . phpversion();  //información sobre el sistema de envio de correos, en este caso la version de PHP
            // Cabeceras adicionales
            $cabeceras .= 'To: NutriConsultores Registro <registro@empresa.com>' . "\r\n";
            // Enviarlo
            try {
                 if(mail($para, $asunto, $mensaje, $cabeceras)){

                    return 1;
                }else{
                    return -2;
                }

            } catch (Exception $e) {
                return -3;
            }


        }



        public static function recupearenviarmail($email){
			$elpass = Envios::generarpass();
			$query1 = "UPDATE usuarios SET password='$elpass' WHERE correo = '$email'";
			try {
				$comando1 = Conexion::getInstance()->getDb()->prepare($query1);
        		$comando1->execute();
        		 
			} catch (Exception $e) {
				$retorno = array($query1,$e);
				return $retorno;
			}
			
            $para = $email;
            $asunto = 'BIENVENIDO A COSASE';
			$anio = date("Y");
            $mensaje = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				    <head>
				        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				        <title>BIENVENIDO A COSASE</title>
				        <meta name="viewport" content="width=device-width" />
				       <style type="text/css">
				            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
				                body[yahoo] .buttonwrapper { background-color: transparent !important; }
				                body[yahoo] .button { padding: 0 !important; }
				                body[yahoo] .button a { background-color: #1ec1b8; padding: 15px 25px !important; }
				            }

				            @media only screen and (min-device-width: 601px) {
				                .content { width: 600px !important; }
				                .col387 { width: 387px !important; }
				            }
				            td {
				            	box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);
							}
				        </style>
				    </head>
				    <body bgcolor="#32323a" style="margin: 0; padding: 0;" yahoo="fix">
				        <!--[if (gte mso 9)|(IE)]>
				        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
				          <tr>
				            <td>
				        <![endif]-->
				        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
				             
				            <tr>
				                <td align="center" bgcolor="#ffffff" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;background-color: #575756;  box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <img src="http://contenucompany.com/nutriconsultores/img/imagenes_mias/esta.png" alt="ProUI Logo" width="105" height="83" style="display:block;" />
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#ffffff" style="padding: 40px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6; box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>Bienvenido a la aplicación de COSASSE</b><br>Para poder ingresar a la aplicaci&oacute;n utilice los siguientes datos:
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#f9f9f9" style="padding: 20px 20px 0 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>Cuenta:</b> '.$email.' <br>
				                    <b>Contrase&ntilde;a:</b> '.$elpass.'
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif; border-bottom: 1px solid #f6f6f6;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <table bgcolor="#1ec1b8" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
				                        <tr>
				                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);" class="button">
				                                <a href="#" style="color: #ffffff; text-align: center; text-decoration: none;">Descargar Aplicaci&oacute;n</a>
				                            </td>
				                        </tr>
				                    </table>
				                </td>
				            </tr>
				             
				            <tr>
				                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>NutriConsultores</b><br/>El Salvador
				                </td>
				            </tr>
				            <tr>
				                <td style="padding: 15px 10px 15px 10px;">
				                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
				                        <tr>
				                            <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
				                                <?php echo $anio;?> &copy; <a href="nutriconsultores.com" style="color: #1ec1b8;">NutriConsultores</a>
				                            </td>
				                        </tr>
				                    </table>
				                </td>
				            </tr>
				        </table>
				        <!--[if (gte mso 9)|(IE)]>
				                </td>
				            </tr>
				        </table>
				        <![endif]-->
				    </body>
				</html>';
            // Para enviar un correo HTML, debe establecerse la cabecera Content-type
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $cabeceras .= 'From: contacto@empresa.com' . "\r\n" . //La direccion de correo desde donde supuestamente se envió
                        'X-Mailer: PHP/' . phpversion();  //información sobre el sistema de envio de correos, en este caso la version de PHP
            // Cabeceras adicionales
            $cabeceras .= 'To: Empresa Registro <registro@empresa.com>' . "\r\n";
            // Enviarlo
            try {
                 if(mail($para, $asunto, $mensaje, $cabeceras)){

                    return 1;
                }else{
                    return -2;
                }

            } catch (Exception $e) {
                return -3;
            }


        }




		public static function enviarmail($email,$codigo,$empresa){
			$elpass = Envios::generarpass();
			$nombre="";
			$query_empresa = "SELECT nombre from empresas where id = '$empresa'";
			try {
				$comando12 = Conexion::getInstance()->getDb()->prepare($query_empresa);
        		$comando12->execute();
        		while ($row = $comando12->fetch(PDO::FETCH_ASSOC)) {
	          		$nombre=$row[nombre];
	          	}
			} catch (Exception $e) {
				
			}
			
			$query1 = "INSERT INTO usuarios(correo,usuario,password,nivel,estado,codigo_oculto)values(?,?,PASSWORD(?),?,?,?)";
			try {
				$comando1 = Conexion::getInstance()->getDb()->prepare($query1);
        		$comando1->execute(array($email,$email,$elpass,'2','1',$codigo));

			} catch (Exception $e) {
				return $e->getMessage();

			}

			$query_otro = "SELECT
								e.correo,
								e.empresa,
								em.nombre, em.imagen
							FROM
								empleados as e
							JOIN empresas as em
							ON e.empresa = em.id
							WHERE
								e.correo='$email'";

			 
			try {
				$ejecucion = Conexion::getInstance()->getDb()->prepare($query_otro);
	          	$ejecucion->execute();
	          	while ($row = $ejecucion->fetch(PDO::FETCH_ASSOC)) {
	          		$empresa = $row[nombre];
	          		$imagen = $row[imagen];
	          	}
			} catch (Exception $ex) {
				return $ex;
			}
			


			
            $para = $email;
            $asunto = 'BIENVENIDO A LA APLICACIÓN DE '.$nombre;
			$anio = date("Y");
            $mensaje = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				    <head>
				        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				        <title>BIENVENIDO '.$nombre.'</title>
				        <meta name="viewport" content="width=device-width" />
				       <style type="text/css">
				            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
				                body[yahoo] .buttonwrapper { background-color: transparent !important; }
				                body[yahoo] .button { padding: 0 !important; }
				                body[yahoo] .button a { background-color: #1ec1b8; padding: 15px 25px !important; }
				            }

				            @media only screen and (min-device-width: 601px) {
				                .content { width: 600px !important; }
				                .col387 { width: 387px !important; }
				            }
				            td {
				            	box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);
							}
				        </style>
				    </head>
				    <body bgcolor="#32323a" style="margin: 0; padding: 0;" yahoo="fix">
				        <!--[if (gte mso 9)|(IE)]>
				        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
				          <tr>
				            <td>
				        <![endif]-->
				        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
				             
				            <tr>
				                <td align="center" bgcolor="#ffffff" style="padding: 20px 20px 20px 20px; color: #ffffff; background-color: #575756; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold; box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <img src="http://'.$_SERVER[SERVER_NAME].'/'.HOST.'/php/json/imagenes/'.$imagen.'" alt="LOGODELE" width="105" height="83" style="display:block;" />
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#ffffff" style="padding: 40px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6; box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>BIENVENIDO A LA APLICACIÓN DE '.$nombre.'</b><br>Para poder ingresar a la aplicaci&oacute;n utilice los siguientes datos:
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#f9f9f9" style="padding: 20px 20px 0 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>Cuenta:</b> '.$email.' <br>
				                    <b>Contrase&ntilde;a:</b> '.$elpass.'
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif; border-bottom: 1px solid #f6f6f6;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <table bgcolor="#1ec1b8" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
				                        <tr>
				                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);" class="button">
				                                <a href="#" style="color: #ffffff; text-align: center; text-decoration: none;">Descargar Aplicaci&oacute;n</a>
				                            </td>
				                        </tr>
				                    </table>
				                </td>
				            </tr>
				             
				            <tr>
				                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>'.$nombre.'</b><br/>El Salvador
				                </td>
				            </tr>
				            <tr>
				                <td style="padding: 15px 10px 15px 10px;">
				                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
				                        <tr>
				                            <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
				                                <?php echo $anio;?> &copy; <a href="http://www.estudioagil.com/" style="color: #1ec1b8;">ESTUDIO A</a>
				                            </td>
				                        </tr>
				                    </table>
				                </td>
				            </tr>
				        </table>
				        <!--[if (gte mso 9)|(IE)]>
				                </td>
				            </tr>
				        </table>
				        <![endif]-->
				    </body>
				</html>';
            // Para enviar un correo HTML, debe establecerse la cabecera Content-type
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $cabeceras .= 'From: noresponder@empresa.com' . "\r\n" . //La direccion de correo desde donde supuestamente se envió
                        'X-Mailer: PHP/' . phpversion();  //información sobre el sistema de envio de correos, en este caso la version de PHP
            // Cabeceras adicionales
            $cabeceras .= 'To: Empresa Registro <registro@empresa.com>' . "\r\n";
            // Enviarlo
            try {
                 if(mail($para, $asunto, $mensaje, $cabeceras)){

                    return 1;
                }else{
                    return -2;
                }

            } catch (Exception $e) {
                return -1;
            }


        }


        public static function enviarmail2($email,$rol,$id){
			$elpass = Envios::generarpass();
			$nombre="";
			$query_empresa = "SELECT nombre from empresas where id = '$empresa'";
			try {
				$comando12 = Conexion::getInstance()->getDb()->prepare($query_empresa);
        		$comando12->execute();
        		while ($row = $comando12->fetch(PDO::FETCH_ASSOC)) {
	          		$nombre=$row[nombre];
	          	}
			} catch (Exception $e) {
				
			}
			
			 
			$query_update = "UPDATE usuarios SET correo='$email',nivel='$rol' where codigo_oculto = '$id'";
			try {
				$comando1 = Conexion::getInstance()->getDb()->prepare($query_update);
        		$comando1->execute();

			} catch (Exception $e) {
				return $e->getMessage();

			}

			$query_otro = "SELECT
								e.correo,
								e.empresa,
								em.nombre, em.imagen
							FROM
								empleados as e
							JOIN empresas as em
							ON e.empresa = em.id
							WHERE
								e.correo='$email'";

			 
			try {
				$ejecucion = Conexion::getInstance()->getDb()->prepare($query_otro);
	          	$ejecucion->execute();
	          	while ($row = $ejecucion->fetch(PDO::FETCH_ASSOC)) {
	          		$empresa = $row[nombre];
	          		$imagen = $row[imagen];
	          	}
			} catch (Exception $ex) {
				return $ex;
			}
			


			
            $para = $email;
            $asunto = 'BIENVENIDO A LA APLICACIÓN DE '.$nombre;
			$anio = date("Y");
            $mensaje = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				    <head>
				        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				        <title>BIENVENIDO '.$nombre.'</title>
				        <meta name="viewport" content="width=device-width" />
				       <style type="text/css">
				            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
				                body[yahoo] .buttonwrapper { background-color: transparent !important; }
				                body[yahoo] .button { padding: 0 !important; }
				                body[yahoo] .button a { background-color: #1ec1b8; padding: 15px 25px !important; }
				            }

				            @media only screen and (min-device-width: 601px) {
				                .content { width: 600px !important; }
				                .col387 { width: 387px !important; }
				            }
				            td {
				            	box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);
							}
				        </style>
				    </head>
				    <body bgcolor="#32323a" style="margin: 0; padding: 0;" yahoo="fix">
				        <!--[if (gte mso 9)|(IE)]>
				        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
				          <tr>
				            <td>
				        <![endif]-->
				        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
				             
				            <tr>
				                <td align="center" bgcolor="#ffffff" style="padding: 20px 20px 20px 20px; color: #ffffff; background-color: #575756; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold; box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <img src="http://'.$_SERVER[SERVER_NAME].'/'.HOST.'/php/json/imagenes/'.$imagen.'" alt="LOGODELE" width="105" height="83" style="display:block;" />
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#ffffff" style="padding: 40px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6; box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>BIENVENIDO A LA APLICACIÓN DE '.$nombre.'</b><br>Para poder ingresar a la aplicaci&oacute;n utilice los siguientes datos:
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#f9f9f9" style="padding: 20px 20px 0 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>Cuenta:</b> '.$email.' <br>
				                    <b>Contrase&ntilde;a:</b> '.$elpass.'
				                </td>
				            </tr>
				            <tr>
				                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif; border-bottom: 1px solid #f6f6f6;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <table bgcolor="#1ec1b8" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
				                        <tr>
				                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);" class="button">
				                                <a href="#" style="color: #ffffff; text-align: center; text-decoration: none;">Descargar Aplicaci&oacute;n</a>
				                            </td>
				                        </tr>
				                    </table>
				                </td>
				            </tr>
				             
				            <tr>
				                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);">
				                    <b>'.$nombre.'</b><br/>El Salvador
				                </td>
				            </tr>
				            <tr>
				                <td style="padding: 15px 10px 15px 10px;">
				                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
				                        <tr>
				                            <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
				                                <?php echo $anio;?> &copy; <a href="http://www.estudioagil.com/" style="color: #1ec1b8;">ESTUDIO A</a>
				                            </td>
				                        </tr>
				                    </table>
				                </td>
				            </tr>
				        </table>
				        <!--[if (gte mso 9)|(IE)]>
				                </td>
				            </tr>
				        </table>
				        <![endif]-->
				    </body>
				</html>';
            // Para enviar un correo HTML, debe establecerse la cabecera Content-type
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $cabeceras .= 'From: noresponder@empresa.com' . "\r\n" . //La direccion de correo desde donde supuestamente se envió
                        'X-Mailer: PHP/' . phpversion();  //información sobre el sistema de envio de correos, en este caso la version de PHP
            // Cabeceras adicionales
            $cabeceras .= 'To: Empresa Registro <registro@empresa.com>' . "\r\n";
            // Enviarlo
            try {
                 if(mail($para, $asunto, $mensaje, $cabeceras)){
                 	return array($query_update,'1');
                    
                }else{
                    return -2;
                }

            } catch (Exception $e) {
                return -1;
            }


        }

         
	}


?>