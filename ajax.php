<?php 
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    include_once 'includes/config.php';
	include_once 'includes/lib_utiles.php';
       
switch ($_GET["action"]) {
    
    case 1: //enviar mensaje    
            include_once 'includes/abike_contactos_recibidos.php';
            include_once 'includes/abike_configuracion.php';

            $nombre = $_POST['txt_nombre'];
            $email = $_POST['txt_email'];
            $mensaje = $_POST['txt_mensaje'];

            $abike_contactos_recibidos_obj = new abike_contactos_recibidos;
            $abike_contactos_recibidos_obj->nombre= $nombre;
            $abike_contactos_recibidos_obj->email = $email;
            $abike_contactos_recibidos_obj->mensaje = $mensaje;
            $abike_contactos_recibidos_obj->id = $abike_contactos_recibidos_obj->add();
            
            $mensaje_template = file_get_contents('templates/mensaje.htm');
            $mensaje_template = str_replace('{SISTEMA_URL}', SISTEMA_URL, $mensaje_template);
            $mensaje_template = str_replace('{NOMBRE}', $nombre, $mensaje_template);
            $mensaje_template = str_replace('{EMAIL}', $email, $mensaje_template);
            $mensaje_template = str_replace('{MENSAJE}', $mensaje, $mensaje_template);
            
            $abike_configuracion_obj = new abike_configuracion;
            $abike_configuracion_obj->traer();
            phpmailer_enviar($email,  $nombre, $abike_configuracion_obj->contacto_email, 'American Bikes', 'Contacto desde el sitio web', utf8_decode($mensaje_template), true);
                
			die('OK');
            
            break;                                 
}
    

 
    
?>