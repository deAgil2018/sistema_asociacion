<?php 

@session_start(); 

/****mensajes principales****/

/***contantes para mensajes en ventanas***/
define("GUARDAR", "Guardar Datos");
define("CANCELAR", "cancelar");
define("ACTUALIZAR", "Actualizar Datos");
define("CERRAR_MODAL", "Cerrar");
define("BASE_URL", "https://192.168.1.253:8081/desarrollo/sistema_asociacion/");
define("EXITO","Excelente");
define("EXITO_MENSAJE","Datos almacenados correctamente");
define("EXITO_ACTUALIZAR","Datos Actualizados");
define("ERROR","Error");
define("ERROR_MENSAJE","Hubo un problema al procesar la solicitud, intentelo nuevamente");
define("ERROR_CORREO","Al parecer el correo ingresado ya existe");
define("ELIMINAR","Eliminado");
define("ELIMINAR_MENSAJE","La información han sido borrada de la base de datos");


/***MENSAJES SWEET ALERT***/
define("ELIMINAR_ALERT","Eliminar");
define("CANCELAR_ALERT","Cancelar");
define("CONFIRMAR_ELIMINAR","Si, eliminarlo");
define("MENSAJE_ELIMINAR_ALERT","¿Desea eliminar el dato seleccionado?");
define("MENSAJE_ELIMINAR_CONFIRMAR","¿Realmente desea eliminarlo?");

define("MENSAJE_SALIR","¿Desea salir del sistema?");


?>