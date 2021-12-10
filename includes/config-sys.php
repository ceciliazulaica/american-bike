<?php
	@session_start($PHPSESSID);
	/**
	 * Este archivo de configuracion debe ser requerido por toda la aplicacion
	 * ya que sera el punto de conexión de distintas aréas, o modúlos de cualquier
	 * aplicación.
	 *
	 * Objetivos
	 * ============================================================================
	 * 	- 	Definicion de las constantes para el manejo de directorios
	 * 	  	Multiplataforma
	 * 	- 	Incluir las clases necesarias para el funcionamiento correcto de la 
	 * 		aplicación
	 */
	
	// Abreviacion de DIRECTORY_SEPARATOR
	if(!defined('DS')){
		define('DS',DIRECTORY_SEPARATOR); 
	}
	// Directorio principal donde se encuentra la aplicacion
	if(!defined('ROOT')){
		define('ROOT', dirname(dirname(__FILE__)));
	}
	// Directorio donde se encunetran las librerias
	if(!defined('LIBS')){
		define('LIBS', dirname(__FILE__));
	}

	// Constantes para el manejo de errores y logs
	// Debug
	if(!defined('L_DEBUG')){
		define('L_DEBUG', 1);
	}
	// Info
	if(!defined('L_INFO')){
		define('L_INFO', 2);
	}
	// Notice
	if(!defined('L_NOTICE')){
		define('L_NOTICE', 4);
	}		
	// Warning
	if(!defined('L_WARNING')){
		define('L_WARNING', 8);
	}	
	// Error
	if(!defined('L_ERROR')){
		define('L_ERROR', 16);
	}
	// Critical
	if(!defined('L_CRITICAL')){
		define('L_CRITICAL', 32);
	}
	// Alert
	if(!defined('L_ALERT')){
		define('L_ALERT', 32);
	}
	// Emergency
	if(!defined('L_EMERGENCY')){
		define('L_EMERGENCY', 128);
	}

	// Todos los tipos de mensajes
	if(!defined('L_ALL')){
		define('L_ALL', 1 | 2 | 4 | 8 | 16 | 32 | 64 | 128);
	}



	// Incluyo la clase encargada de resolver los directorios
	// en resumen el objetivo de esta clase es implementar una
	// convencion que permita la identificacion de los archivos
	// desde el momento que se solicita

	include_once 'System/App.php';
	
	// Importe el Objeto a utilizar
	// Esta clase de configuracion permite invocar una única instancia
	// en tiempo de ejecucion, lo que permite transportar datos desde
	// un punto de partida a un punto de destino, siempre y cuando 
	// punto de partida este en la misma linea de ejecución de punto de destino
	// También permite la posibilidad de indicar si el valor de la configuración
	// va a ser persistente, esto permite setear una configuración en un momento
	// dado de la ejecucion y ser obtenido en otra ejecución, que puede ser 
	// combinado con la utilización de ajax para el transporte de datos asincronicos
	// o delegar el uso de sessiones y relacionarlas con una instancia de la configuracion
	App::import('System','Config.php');



