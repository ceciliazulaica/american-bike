<? session_start($PHPSESSID); // la session debe ser la primera linea (Presupone q se creo en el login)
error_reporting(E_ERROR | E_WARNING | E_PARSE);
  require_once('Vendors/Excel/excel_viejo/Worksheet.php');
  require_once('Vendors/Excel/excel_viejo/Workbook.php');
  require_once('config.php');
  require_once('lib_utiles.php');



/*
	$reporte_vec[WORKSHEET_NUM]["nombre"] 		== Nombre de la Hoja
	$reporte_vec[WORKSHEET_NUM]["contenido"] 	== ARRAY 
														[FILA_NUM]["contenido"] 		= Columnas separadas por ;
														[FILA_NUM]["formato_color"] 	= Color


    Hay que guardar de antemano el objeto con los parametros q recibe
    dentro de $_SESSION["sess_reporte_vec"]["objeto"]
             $_SESSION["sess_reporte_vec"]["objeto_name"]



*/	            
  include_once $_SESSION["sess_reporte_vec"]["objeto_name"].".php";


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
  
  
  
/*  echo "<pre>";print_r(unserialize($_SESSION["sess_reporte_vec"]["objeto"])); echo "</pre>"; */
  
  
  $objeto = unserialize($_SESSION["sess_reporte_vec"]["objeto"]);

  if(isset($_SESSION["sess_reporte_vec"]["campo_especial"])){
    /* agragado para exportar solo los elementos seleccionados en rrhh_adm */
    if (isset($_SESSION['sess_reporte_vec']['items_id'])) {
      $objeto->ids_in = $_SESSION['sess_reporte_vec']['items_id'];
    }
    $objeto->traerCamposExcel();  
  }
  else {    
    $objeto->traer();
  } 
  
  

  $reporte_vec = $_SESSION["sess_reporte_vec"]["reporte"];
  
  for ($i=0;$i<count($reporte_vec);$i++) {
		  
		  // Creating the first worksheet
		  $worksheet[$i] =& $workbook->add_worksheet($reporte_vec[$i]["nombre"]);

        $fila    = 1;




          /**
           * 
           *    Titulos de las columnas
           *  
           * */  
    	  $formatot =& $workbook->add_format();
    	  $formatot->set_align($filas_vec[$fila]["formato_align"] != '' ?  $filas_vec[$fila]["formato_align"]:  'center');
    	  $formatot->set_color('white');
    	  $formatot->set_pattern();
    	  $formatot->set_fg_color('blue');
          if ($_GET["primer_columna"] != '') {
            $columna =$_GET["primer_columna"]-1;
          }else{
            $columna =2;  
          }
          

        foreach ($objeto->resultados_vec[0] as $campo_nombre => $valor) {
              //if (!in_array($campo_nombre ,$tablas_campos_seguridad)) 
              $campo_nombre =str_replace('_',' ',$campo_nombre) ;
        
              //Pongo el texto  
      			  if (is_numeric($campo_nombre)){
      				  $worksheet[$i]->write_number($fila + 1, $columna + 1, $campo_nombre,$formatot);
      			  }else{	
      				  $worksheet[$i]->write_string($fila + 1, $columna + 1, $campo_nombre,$formatot);
      			  }

              $columna++;
        }
      $fila++;




          /**
           * 
           *    Contenido del archivo
           *  
           * */  
    	  $formatot =& $workbook->add_format();
    	  $formatot->set_align($filas_vec[$fila]["formato_align"] != '' ?  $filas_vec[$fila]["formato_align"]:  'center');
    	  $formatot->set_color('white');
    	  $formatot->set_pattern();
    	  $formatot->set_fg_color('blue');
          


          for ($k=0;$k<count($objeto->resultados_vec);$k++) {
            
              if ($_GET["primer_columna"] != '') {
                $columna =$_GET["primer_columna"]-1;
              }else{
                $columna =2;  
              }
            
              foreach ($objeto->resultados_vec[$k] as $campo_nombre => $valor) {
                    //if (!in_array($campo_nombre ,$tablas_campos_seguridad)) 
                      
                    //Pongo el texto  
            			  if (is_numeric($valor)){
            				  $worksheet[$i]->write_number($fila + 1, $columna + 1, $valor);
            			  }else{	
            				  if(strtr(strip_tags($valor), $conv)!=strip_tags($valor))
                          $worksheet[$i]->write_string($fila + 1, $columna + 1,(strtr(strip_tags($valor), $conv)));
                      else
                        $worksheet[$i]->write_string($fila + 1, $columna + 1,strip_tags($valor));
                    }
            			  
                          
                          $columna++;
                    }
                    $fila++;
            
         }
                
}


//***********************************
/*		
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
*/
  $workbook->close();
?>
