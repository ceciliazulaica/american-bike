<?php
	/**
	 * Muestra el reporte, buscara los datos asignados desde el seteo
	 */
	
	// Traigo la configuracion requerida
	include_once '../../config.php';

	if($reporte = Config::get('reporte')){
		// Quito el reporte de la sesion
		Config::clear('reporte');

		// Traigo la clase Helper, que a su ve carga PHPExcel
		App::import('Helpers','ExcelHelper.php');
		
		// Crear el reporte
		$excel = ExcelHelper::getInstance();
		$excel->set('titulo',$reporte['titulo']);
		$excel->set('filename',$reporte['file_name']);
		$excel->basicTemplate($reporte['dataset']);

	} else {
		show_source(__FILE__);
		die ('no hay ningun reporte para mostrar');
	}