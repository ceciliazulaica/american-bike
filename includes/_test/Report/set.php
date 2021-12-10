<?php
	/**
	 * Ejemplo de seteo para el reporte
	 */
	include_once '../../config.php';

	show_source(__FILE__);

	$reporte = array(
		'titulo' => 'Reporte de prueba',
		'file_name' => 'reporter de prueba.xls',
		'dataset' => array(
			array(
				'id' 		=> 1,
				'Nombre'	=> 'Cosme',
				'Apellido'	=> 'Fulanito',
				'DNI'		=> 16152321,
				'Ciudad'	=> 'NN'		
			),
			array(
				'id' 		=> 1,
				'Nombre'	=> 'Cosme',
				'Apellido'	=> 'Fulanito',
				'DNI'		=> 16152321,
				'Ciudad'	=> 'NN'		
			),
			array(
				'id' 		=> 1,
				'Nombre'	=> 'Cosme',
				'Apellido'	=> 'Fulanito',
				'DNI'		=> 16152321,
				'Ciudad'	=> 'NN'		
			),
			array(
				'id' 		=> 1,
				'Nombre'	=> 'Cosme',
				'Apellido'	=> 'Fulanito',
				'DNI'		=> 16152321,
				'Ciudad'	=> 'NN'		
			),
			array(
				'id' 		=> 1,
				'Nombre'	=> 'Cosme',
				'Apellido'	=> 'Fulanito',
				'DNI'		=> 16152321,
				'Ciudad'	=> 'NN'		
			),
			array(
				'id' 		=> 1,
				'Nombre'	=> 'Cosme',
				'Apellido'	=> 'Fulanito',
				'DNI'		=> 16152321,
				'Ciudad'	=> 'NN'		
			)
		)
	);


	// Almaceno en sesion la configuración, ya que la llamada al 
	// reporte se va a hacer en otro request
	Config::set('reporte',$reporte,'persistent');
?>
	<a href='get.php'>ver reporte</a>	