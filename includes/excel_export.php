<? session_start($PHPSESSID); // la session debe ser la primera linea (Presupone q se creo en el login)
  include_once('Vendors/Excel/excel_viejo/Worksheet.php');
  include_once('Vendors/Excel/excel_viejo/Workbook.php');



/*
	$reporte_vec[WORKSHEET_NUM]["nombre"] 		== Nombre de la Hoja
	$reporte_vec[WORKSHEET_NUM]["contenido"] 	== ARRAY 
														[FILA_NUM]["contenido"] 		= Columnas separadas por ;
														[FILA_NUM]["formato_color"] 	= Color
*/	

  $reporte_vec = $_SESSION["sess_reporte_vec"]["reporte"];


if ($_GET["html_dump"]!=1) {
  function HeaderingExcel($filename) {
      header("Content-type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=$filename" );
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
      header("Pragma: public");
      }
  // HTTP headers
  HeaderingExcel($_SESSION["sess_reporte_vec"]["file_name"]);

  // Creating a workbook
  $workbook = new Workbook("-");
  
  
  for ($i=0;$i<count($reporte_vec);$i++) {
		  
		  // Creating the first worksheet
		  $worksheet[$i] =& $workbook->add_worksheet($reporte_vec[$i]["nombre"]);

		
		  $filas_vec = $reporte_vec[$i]["contenido"];
		  for ($fila=0;$fila<( count($filas_vec) + 1);$fila++) {
		  		
				$columnas_vec=explode(";",$filas_vec[$fila]["contenido"]);

				if (trim($filas_vec[$fila]["formato_color"]) != '') {
					  $formatot =& $workbook->add_format();
					  $formatot->set_align($filas_vec[$fila]["formato_align"] != '' ?  $filas_vec[$fila]["formato_align"]:  'center');
					  $formatot->set_color('white');
					  $formatot->set_pattern();
					  $formatot->set_fg_color($filas_vec[$fila]["formato_color"]);
				}

				
				//Escribo las columnas de esa fila
			  	for ($columna=0;$columna<count($columnas_vec);$columna++) {
						if (trim($columnas_vec[$columna]) != '') {
								if (trim($filas_vec[$fila]["formato_color"]) != '') {

									  if (is_numeric($columnas_vec[$columna])){
										  $worksheet[$i]->write_number($fila + 1, $columna + 1, $columnas_vec[$columna],$formatot);
									  }else{	
										  $worksheet[$i]->write_string($fila + 1, $columna + 1, $columnas_vec[$columna],$formatot);
									  }
								}else{

									  if (is_numeric($columnas_vec[$columna])){
										  $worksheet[$i]->write_number($fila + 1, $columna + 1, $columnas_vec[$columna]);
									  }else{	
										  $worksheet[$i]->write_string($fila + 1, $columna + 1, $columnas_vec[$columna]);
									  }
								}
						}
						
				}
				
		  }
  }

  $workbook->close();

}else{
    
    $titulo_del_documento = $_SESSION["sess_reporte_vec"]["file_name"];
    $reporte_vec[0]["html"]= strip_tags( $reporte_vec[0]["html"],"<tr>,<table>,<th>,<br>,<br />,<img>,<ul>,<li>,<td>,<p>,<h1>,<h2>,<h3>,<b>");

	header('Content-type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=$titulo_del_documento");
	header("Pragma: no-cache");
	header("Expires: 0");	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title> ' .$reporte_vec[0]["nombre"] . '</title>
			</head>
			<body>';
	echo utf8_encode(htmlspecialchars_decode($reporte_vec[0]["html"]));
	echo '  </body>
			</html>';
}


?>
