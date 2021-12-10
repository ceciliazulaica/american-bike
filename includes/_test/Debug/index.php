<?php
	
	require_once '../../config.php';
	show_source(__FILE__);
	
	// Testeo de log por niveles
	// de esta forma se permite setear el nivel
	// de debug segun como en el momento se lo requiera
	// por ejemplo se podria utilizar con una condicion
	// del ambiente de desarroollo, si es produccion,
	// si es desarrillo, etc, o setear una configuracion
	// persistente segun el usuario
	Config::set('debug_level',L_ALL);

	App::import('System','Debug.php');

	echo "<h1>Todos los errores disponible Config::set('debug_level',L_ALL);</h1>";
	echo Debug::log(L_DEBUG,L_ALL, array(
		'asd' => 5
	));
	echo Debug::log(L_INFO,'Hola Mundo', array(
		'asd' => 5
	));
	echo Debug::log(L_NOTICE,'Hola Mundo', array(
		'asd' => 5
	));
	echo Debug::log(L_WARNING,'Hola Mundo', array(
		'asd' => 5
	));
	echo Debug::log(L_ERROR,'Hola Mundo', array(
		'asd' => 5
	));
	echo Debug::log(L_CRITICAL,'Hola Mundo', array(
		'asd' => 5
	));

	Config::set('debug_level',L_DEBUG | L_NOTICE);
	echo "<h1>Debug y Notices Config::set('debug_level',L_DEBUG | L_NOTICE);</h1>";
	echo Debug::log(L_DEBUG,L_ALL, array(
		'asd' => 5
	));
	echo Debug::log(L_INFO,'Hola Mundo', array(
		'asd' => 5
	));
	echo Debug::log(L_NOTICE,'Hola Mundo', array(
		'asd' => 5
	));
	echo Debug::log(L_WARNING,'Hola Mundo', array(
		'asd' => 5
	));
	echo Debug::log(L_ERROR,'Hola Mundo', array(
		'asd' => 5
	));
	echo Debug::log(L_CRITICAL,'Hola Mundo', array(
		'asd' => 5
	));