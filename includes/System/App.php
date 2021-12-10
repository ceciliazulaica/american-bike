<?php
	/**
	 * Esta clase esta desarrollada con el objetivo de facilitar el manejo de 
	 * importacion de clases del sistema, y el manejo de rutas, pero puede 
	 * extenderse su uso para utilizacion de metods estaticos comunes en la aplicacion
	 *
	 * Estructura requerida
	 * ========================================================================
	 * [LIBS] <-- carpeta root de las librerias a instancias en la ejecución
	 * 	  | 
	 * 	  [TIPO DE LIBRERIA] 				<-- 	definición de la categoría de la clase, esto
	 * 	  		|				 					permite identificar de forma intuitiva el 
	 * 	  		|				 					destino y objetivos de los archivos que incluyen
	 * 	  		| 				 					por ejemplo Helpers, System, Vendors, Modelos, etc
	 * 	  		|
	 * 	  		- NombreDelArchivo.ext      <--		para facilitar el uso y la identificacion de los 
	 * 	  											archivos, no solo para el desarrollador, sino también
	 * 	  											para el sistema, las clases deben definirse con el mismo
	 * 	  											nombre que el archivo, lo ideal seria implementar un
	 * 	  											patron estilo PSR-0 con autoload, pero esta idea esta
	 * 	  											basada siguiendo ese "estandar"
	 *
	 * @package  System
	 * @subpackage System.App
	 */

	Class App 
	{

		/**
		 * Incluye la clase que ser requiera utilizar en la aplicacion basado
		 * en la estructura requerida, esto permite, crear una validación antes
		 * de incluir un archivo, corroborando si existe una instancia de la clase
		 * o si el archivo existe y se tienen permisos de lectura para poder utilizarlo
		 *
		 * 		
		 * @param  string $path       	direccion relativa donde se encuentra el archivo a importar
		 *                            	ejemplo: System | Vendors/Excel
		 * @param  string $file_name  	Nombre de archivo a importar
		 * @param  string $class_name 	Opcional: en algunos casos el nombre de la clase puede ser diferente
		 *                            	al del nombre del archivo, cuando se de ese caso se utilizara este
		 *                            	parametro
		 *                            	
		 * @return boolean             	true 	{ si la clase ya esta ha sido definida o si se ha posido incluir } 
		 *                              false 	{ si el archivo no existe o si no tiene permisos para leerlo }
		 */
		static function import($path = 'System', $file_name , $class_name = null)
		{
		
			$file_search = LIBS . DS . str_replace('/',DS,$path) . DS . $file_name;

			
			$className = (!$class_name) ? str_replace('.' . array_pop(explode('.',$file_name)), '', $file_name) : $class_name;

			if(!class_exists($className)){
				if(file_exists($file_search) && is_readable($file_search)){
					include_once $file_search;
					return true;
				} else {
					// warning no se encuentra el archivo
				}	
			}else{
				return true;
			}

		}

	}