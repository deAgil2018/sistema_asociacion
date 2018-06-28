<?php 
 	@session_start();
	include_once("../../Conexion/Conexion.php");
	if (isset($_POST["usuario"]) && isset($_POST["password"])) {
		

		$consultar = "SELECT 
		u.id,
		u.correo,
		u.password,
		u.usuario,
		p.estado, 
		p.nombre,
		p.nivel,
		p.id 
		AS elid 
		FROM personas AS p 
		JOIN usuarios AS u 
		ON p.correo = u.correo 
		WHERE u.correo = '$_POST[usuario]' AND u.password = '$_POST[password]' AND p.estado = '1'";

		try {
			 	$comando = Conexion::getInstance()->getDb()->prepare($consultar);
                $comando->execute();
                $data= array();

                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['id'];
                    $estado = $row['estado'];
                    $nivel = $row['nivel'];
                    $nombre = $row['nombre'];
                    $elid = $row['elid'];
                    $data[]= $row;

                }

                if($cuenta = $comando->rowCount()>0){
                	$_SESSION['loggedin'] = true;
                    $_SESSION["estado"] = $estado;
                    $_SESSION['autentica']  = 'simon';
                    $_SESSION['nivel'] = $nivel;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['correo']=$_POST["usuario"];
                    $_SESSION['elid']=$elid;
                }


				if ($estado == '1') {//activo 

					$exito = array("1",$nombre);
					echo json_encode(array("exito" => $exito));

				}else if ($estado == '2'){//desactivado

					$exito = array("2",$nombre);
					echo json_encode(array("exito" => $exito));

				}else if($estado == '0' or $estado == ''){//no validado

					$exito = array("0",$nombre);
					echo json_encode(array("exito" => $exito));
				}


		} catch (Exception $e) {
			$exito = array("-1","error",$e);
            echo json_encode(array("exito" => $exito));
		}


        
	}


?>