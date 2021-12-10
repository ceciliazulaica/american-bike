<?
 /* ----------------------------------------------------------
	Libreria Desarrollada por Veronica Osorio
				vosorio@gmail.com
 ---------------------------------------------------------- */

		
		// conversiÛn de carateres html
        $conv = array(
          "&nbsp;" => " ",
          "&iexcl;" => "°",
          "&cent;" => "c",
          "&pound;" => "£",
          "&curren;" => "§",
          "&yen;" => "•",
          "&brvbar;" => "¶",
          "&sect;" => "ß",
          "&uml;" => "®",
          "&copy;" => "©",
          "&ordf;" => "™",
          "&laquo;" => "´",
          "&not;" => "¨",
          "&shy;" => "",
          "&reg;" => "Æ",
          "&macr;" => "Ø",
          "&deg;" => "∞",
          "&plusmn;" => "±",
          "&sup2;" => "≤",
          "&sup3;" => "≥",
          "&acute;" => "¥",
          "&micro;" => "µ",
          "&para;" => "∂",
          "&middot;" => "∑",
          "&cedil;" => "∏",
          "&sup1;" => "π",
          "&ordm;" => "∫",
          "&raquo;" => "ª",
          "&frac14;" => "º",
          "&frac12;" => "Ω",
          "&frac34;" => "æ",
          "&iquest;" => "ø",
          "&Agrave;" => "¿",
          "&Aacute;" => "¡",
          "&Acirc;" => "¬",
          "&Atilde;" => "√",
          "&Auml;" => "ƒ",
          "&Aring;" => "≈",
          "&AElig;" => "∆",
          "&Ccedil;" => "«",
          "&Egrave;" => "»",
          "&Eacute;" => "…",
          "&Ecirc;" => " ",
          "&Euml;" => "À",
          "&Igrave;" => "Ã",
          "&Iacute;" => "Õ",
          "&Icirc;" => "Œ",
          "&Iuml;" => "œ",
          "&ETH;" => "–",
          "&Ntilde;" => "—",
          "&Ograve;" => "“",
          "&Oacute;" => "”",
          "&Ocirc;" => "‘",
          "&Otilde;" => "’",
          "&Ouml;" => "÷",
          "&times;" => "◊",
          "&Oslash;" => "ÿ",
          "&Ugrave;" => "Ÿ",
          "&Uacute;" => "⁄",
          "&Ucirc;" => "€",
          "&Uuml;" => "‹",
          "&Yacute;" => "›",
          "&THORN;" => "ﬁ",
          "&szlig;" => "ﬂ",
          "&agrave;" => "‡",
          "&aacute;" => "·",
          "&acirc;" => "‚",
          "&atilde;" => "„",
          "&auml;" => "‰",
          "&aring;" => "Â",
          "&aelig;" => "Ê",
          "&ccedil;" => "Á",
          "&egrave;" => "Ë",
          "&eacute;" => "È",
          "&ecirc;" => "Í",
          "&euml;" => "Î",
          "&igrave;" => "Ï",
          "&iacute;" => "Ì",
          "&icirc;" => "Ó",
          "&iuml;" => "Ô",
          "&eth;" => "",
          "&ntilde;" => "Ò",
          "&ograve;" => "Ú",
          "&oacute;" => "Û",
          "&ocirc;" => "Ù",
          "&otilde;" => "ı",
          "&ouml;" => "ˆ",
          "&divide;" => "˜",
          "&oslash;" => "¯",
          "&ugrave;" => "˘",
          "&uacute;" => "˙",
          "&ucirc;" => "˚",
          "&uuml;" => "¸",
          "&yacute;" => "˝",
          "&thorn;" => "˛",
          "&yuml;" => "ˇ",
          "&OElig;" => "å",
          "&oelig;" => "ú",
          "&Scaron;" => "ä",
          "&scaron;" => "ö",
          "&Yuml;" => "ü",
          "&fnof;" => "É",
          "&ndash;" => "ñ",
          "&mdash;" => "ó",
          "&lsquo;" => "ë",
          "&rsquo;" => "í",
          "&sbquo;" => "Ç",
          "&ldquo;" => "ì",
          "&rdquo;" => "î",
          "&bdquo;" => "Ñ",
          "&dagger;" => "Ü",
          "&Dagger;" => "á",
          "&bull;" => "ï",
          "&hellip;" => "Ö",
          "&permil;" => "â",
          "&euro;" => "Ä",
          "&trade;" => "ô");
    


 function fecha_menor_a_otra($fecha_1,$fecha_2){
    
    /* devuelve si fecha1 es <= $fecha2 
            se reciben en dd/mm/yyyy
    */
    
    $fecha_1 = explode("/",$fecha_1); $fecha_1=$fecha_1[2]."-".$fecha_1[1]."-".$fecha_1[0];
    $fecha_2 = explode("/",$fecha_2); $fecha_2=$fecha_2[2]."-".$fecha_2[1]."-".$fecha_2[0];
    
    if (strtotime($fecha_1) <= strtotime($fecha_2)){
        return(true);
    }else{
        return(false);
    }
    
 }
 
 function dias_diferencia($fecha_1,$fecha_2){
    
    /* devuelve la diferencia de dias entre fecha1 y $fecha2 
            se reciben en dd/mm/yyyy
    */
    
    $fecha_1 = explode("/",$fecha_1); $fecha_1=$fecha_1[2]."-".$fecha_1[1]."-".$fecha_1[0];
    $fecha_2 = explode("/",$fecha_2); $fecha_2=$fecha_2[2]."-".$fecha_2[1]."-".$fecha_2[0];
    
    return round(abs(strtotime($fecha_1) - strtotime($fecha_2))/86400);
    
    
 }
function datediff_($fecha_1,$fecha_2) {
    /**
     * $fecha_1     entra asi:  dd/mm/yyyyy
     * $fecha_2     entra asi:  dd/mm/yyyyy
     * 
     * Devuelve:
     *          La cantidad de dias de diferencia
     * */

    $fecha1_vec = explode("/",$fecha_1);
    $fecha2_vec = explode("/",$fecha_2);
    $ts2 = strtotime($fecha1_vec[2]."-".$fecha1_vec[1]."-".$fecha1_vec[0]." 00:00:00");
    $ts1 = strtotime($fecha2_vec[2]."-".$fecha2_vec[1]."-".$fecha2_vec[0]." 23:59:00");

    $seconds_diff = $ts2 - $ts1;
    return(floor($seconds_diff/3600/24));
}
function date_add_($fecha_ddmmyyyy,$dias_sumar) {

    /**
     * 
     * La fecha entra con el formato dd/mm/yyyy
     * Devuelve la fecha nueva con el formato dd/mm/yyyy
     * 
     * */

    $fecha_vec = explode("/",$fecha_ddmmyyyy);
    $fecha = date($fecha_vec[2].'-'.$fecha_vec[1].'-'.$fecha_vec[0]);
    $nuevafecha = strtotime ( '+'.$dias_sumar.' day' , strtotime ( $fecha ) ) ;
    $nuevafecha = date ( 'd/m/Y' , $nuevafecha );

    return($nuevafecha);
}

function sql_injections_prevent($texto){
    
    $texto = str_replace("UNION SELECT","",$texto);
    $texto = str_replace(" UNION ","",$texto);
    $texto = str_replace("SELECT ","",$texto);
    $texto = str_replace("AND 'l'=''","",$texto);
    $texto = str_replace("%2527","",$texto);
    $texto = str_replace("%2525","",$texto);
    $texto = str_replace("%20","",$texto);
    $texto = str_replace("DROP TABLE","",$texto);
    $texto = str_replace("alter TABLE","",$texto);
    $texto = str_replace("truncate TABLE","",$texto);
    $texto = str_replace("OR 1=1","",$texto);
    $texto = str_replace(" OR ","",$texto);
    $texto = str_replace("1=1","",$texto);
    $texto = str_replace(";ó%","",$texto);
    //$texto = str_replace(";","",$texto);
    
    return($texto );
}
function dias_semana($idioma){
    
    if ($idioma == "en") {
        
        $dias[1] = "Monday";
        $dias[2] = "Tuesday";
        $dias[3] = "Wednesday";
        $dias[4] = "Thursday";
        $dias[5] = "Friday";
        $dias[6] = "Saturday";
        $dias[0] = "Sunday";
         
    }else{
        $dias[1] = "Lunes";
        $dias[2] = "Martes";
        $dias[3] = "Miercoles";
        $dias[4] = "Jueves";
        $dias[5] = "Viernes";
        $dias[6] = "Sabado";
        $dias[0] = "Domingo";
        
    }
    
    return($dias);
    
}

function get_real_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
//-----------------FUNCIONES PARA EL TRATAMIENTO DE IMAGENES JPG-PNG-GIF----------
	function resize_imagen_cargar($Imagen){
		$Informacion = pathinfo($Imagen);
        switch($Informacion['extension']){
            case 'png':
                $ImgOriginalOriginal = imagecreatefrompng($Imagen);
            break;
            case 'gif':
                $ImgOriginalOriginal = imagecreatefromgif($Imagen);
            break;
            default:
                $ImgOriginalOriginal = imagecreatefromjpeg($Imagen);
            break;
        }
		return $ImgOriginalOriginal;
	}
	
	function resize_imagen_guardar_objeto($ImgFinal , $Imagen , $Calidad){
		$Informacion = pathinfo($Imagen);
        switch($Informacion['extension']){
            case 'png':
                imagepng($ImgFinal , $Imagen , $Calidad);
            break;
            case 'gif':
                imagegif($ImgFinal , $Imagen , $Calidad);
            break;
            default:
                imagejpeg($ImgFinal , $Imagen , $Calidad);
            break;
        }
		return true;
	}
	
	function resize_imagen_formato_color($Color){ return round(round(($Color / 0x33)) * 0x33); }
	
	function resize_imagen_colores_frecuentes($Imagen , $NumColores = 3 , $Ruido = 5) {
		$Ruido = max(1 , abs((int)$Ruido));
		$Colores = array();

		list($AnchoIMG , $AltoIMG) = getimagesize($Imagen);
		$ImgOriginal = resize_imagen_cargar($Imagen);

		for($x = 0; $x < $AnchoIMG; $x += $Ruido) {
			for($y = 0; $y < $AltoIMG; $y += $Ruido) {
			 $RGB = imagecolorsforindex($ImgOriginal , imagecolorat($ImgOriginal, $x, $y));
			 $Rojo = resize_imagen_formato_color($RGB['red']);
			 $Verde = resize_imagen_formato_color($RGB['green']);
			 $Azul = resize_imagen_formato_color($RGB['blue']);
			 $thisRGB = sprintf('%02X%02X%02X' , $Rojo , $Verde , $Azul);
			 if(array_key_exists($thisRGB , $Colores)) {
				$Colores[$thisRGB]++;
			 } else {
				$Colores[$thisRGB] = 1;
			 }
		  }
	   }
	   arsort($Colores);
	   return array_slice(array_keys($Colores) , 0 , $NumColores);
	}



	function resize_imagen_redimensionar($Imagen , $Ancho = 640 , $Alto = 480 , $Fondo = 'FFFFFF' , $MinAncho = 480 , $MinAlto = 360 ){

        /*
            Se lo llama asi:
            
				$redimencion = resize_imagen_redimensionar($_FILES['txt_archivo_ruta']['tmp_name'][$i]);
				if($redimencion != 'ok'){
					$grabacion_rta .= '<br>'.$redimencion.' ('.$_FILES['txt_archivo_ruta']['name'][$i].$_FILES['txt_archivo_ruta']['tmp_name'][$i].')';
				} else {

        */


		list($AnchoIMG , $AltoIMG) = getimagesize($Imagen);
		if(($AnchoIMG == '') or ($AltoIMG == '')){
			return 'La imagen no se pudo cargar correctamente.';
		}
		if(($AnchoIMG < $MinAncho) or ($AltoIMG < $MinAlto)){
			return 'La imagen no alcanza el tamaÒo minimo ('.$MinAncho.' x '.$MinAlto.') ('.$AnchoIMG.' x '.$AltoIMG.')';
		}

		$ImgOriginal = resize_imagen_cargar($Imagen);

		$ImgFinal=imagecreatetruecolor($Ancho , $Alto);
		
		if($Fondo == 'automatico'){
			$resize_imagen_colores_frecuentes = resize_imagen_colores_frecuentes($Imagen);
			$Fondo = $resize_imagen_colores_frecuentes[0]; 
		} 
		
		$Fondo = '0x'.$Fondo;
		imagefilledrectangle($ImgFinal , 0 , 0 , $Ancho-1 , $Alto-1 , ($Fondo*1));


		if( $AnchoIMG > $AltoIMG){
			$RelacionX = $Ancho / $AnchoIMG;
			$AnchoDestino = $Ancho;
			$AltoDestino = ceil($RelacionX * $AltoIMG);
		} else {
			$RelacionY = $Alto / $AltoIMG;
			$AnchoDestino = ceil($RelacionY * $AnchoIMG);
			$AltoDestino = $Alto;
		}

		imagecopyresampled($ImgFinal , $ImgOriginal , (($Ancho-$AnchoDestino)/2) , (($Alto-$AltoDestino)/2) , 0 , 0 , $AnchoDestino  , $AltoDestino , $AnchoIMG , $AltoIMG);
		imagedestroy($ImgOriginal);
		
		resize_imagen_guardar_objeto($ImgFinal , $Imagen , 85);
		
		return 'ok';
	}






function quitar_divs($html){
    
    $patterns = array();
    $patterns[0] = '/<div[^>]*>/';
    $patterns[1] = '/<\/div>/';
    $replacements = array();
    $replacements[2] = '';
    $replacements[1] = '';
    return( preg_replace($patterns, $replacements, $html));
    
}

function array2utf8($vector_original){

    $vector = array();
    foreach ($vector_original as $item) {
       foreach($item as  $clave => $valor ) $item[$clave]=utf8_encode($valor);
       $vector[]=$item;
    }
    
     
    return($vector);
    
    
}
function word_limpiar($Cadena) {

    return (preg_replace( "/<!--?\?\[if gte(.*?)-->/is" , '' , $Cadena));

}

function dia_de_la_semana($fecha)
    {


 /*
    Le pas·s la fecha en formato dd/mm/YYYY y te devuelve el nro de dÌa de la semana que corresponde
    a esa fecha

    Parametros que debe recibir
    ============================

        $fecha                = Lo dicho. dd/mm/YYYY


    Devuelve:
        entre 1 y 7, correspondiente a dia de la semana. 1 es lunes.

    */


    $tmp_dia = 0;
    $tmp_mes = 0;
    $tmp_anio = 0;
    $_theRest = 0;

    $result= trim($fecha);
    $result = str_replace ( "/"," ",$result );
    $result = str_replace ( "-"," ",$result );

    list($tmp_dia,$tmp_mes,$tmp_anio,$_theRest) = explode (" ", $result,4  );
    $tmp_dia=str_pad($tmp_dia,2,"0",STR_PAD_LEFT);
    $tmp_mes=str_pad($tmp_mes,2,"0",STR_PAD_LEFT);

    $tmp_time = mktime(0, 0, 0, $tmp_mes, $tmp_dia, $tmp_anio);
    return date ('N', $tmp_time);
    }



function debug($var){

	if (DEBUG_ENABLED == true) {

		$trace = debug_backtrace();
		$data = func_get_args();

		if(($_SERVER['HTTP_HOST'] == 'desarrollo.vousys.com') or ($_SERVER['HTTP_HOST'] == 'testeandoa.com.ar')){
			$return ="<pre style=\"color:#000;background:#ededed;border-radius:4px;border:solid 1px #d6d6d6f;padding:0 8px\">"
				."<h3 style=\"margin:0;padding:10px 0;border-bottom:solid 1px #c6c6c6\">[{$trace[0]['file']} :: {$trace[0]['line']}]</h3>"
				."<blockquote style=\"margin:0 0 5px;padding:0;border-top:solid 1px #FFFFFF\">".print_r($data,true)."</blockquote>"
				."</pre>";
		} else {
			$return = 'oops i did it again, I played with your heart.';
			// generar un log interno par tener un debug de todos modos
			$return=("<pre style=\"color:#000;background:#ededed;border-radius:4px;border:solid 1px #d6d6d6f;padding:0 8px\">"
				."<h3 style=\"margin:0;padding:10px 0;border-bottom:solid 1px #c6c6c6\">[{$trace[0]['file']} :: {$trace[0]['line']}]</h3>"
				."<blockquote style=\"margin:0 0 5px;padding:0;border-top:solid 1px #FFFFFF\">".print_r($data,true)."</blockquote>"
				."</pre>");
		}
	}else{
		$return="<div class='msg-error'>Se produjo un error en la base de datos, comuniqueselo al administrador</div>";
	}

     print $return;
}


function string2xls($texto){
    return( strip_tags(html_entity_decode( $texto)));
}

function manana(){

    //deveulve en formato d/m/y
    return($tomorrow = date("d/m/Y" ,mktime(0, 0, 0, date("m"), date("d")+1, date("y"))));

}

function remove_style_attr($texto){
    return($texto= preg_replace('#<(div|span|a|ul|li|h1|h2|h3|h4|h5|b|p|blockquote).*( style=".*")?(.*)>#Us', '<$1$2>',$texto));

}
function jquery2iso($in)
{
  $CONV = array();
  $CONV['c4']['85'] = 'a';
  $CONV['c4']['84'] = 'A';
  $CONV['c4']['87'] = 'c';
  $CONV['c4']['86'] = 'C';
  $CONV['c4']['99'] = 'e';
  $CONV['c4']['98'] = 'E';
  $CONV['c5']['82'] = 'l';
  $CONV['c5']['81'] = 'L';
  $CONV['c4']['84'] = 'n';
  $CONV['c4']['83'] = 'N';
  $CONV['c3']['b3'] = 'Û';
  $CONV['c3']['93'] = '”';
  $CONV['c5']['9b'] = 's';
  $CONV['c5']['9a'] = 'S';
  $CONV['c5']['ba'] = 'z';
  $CONV['c5']['b9'] = 'Z';
  $CONV['c5']['bc'] = 'z';
  $CONV['c5']['bb'] = 'Z';

  $i=0;
  $out = '';
  while($i<strlen($in))
  {
    if(array_key_exists(bin2hex($in[$i]), $CONV))
    {
      $out .= $CONV[bin2hex($in[$i])][bin2hex($in[$i+1])];
      $i += 2;
    }
    else
    {
      $out .= $in[$i];
      $i += 1;
    }
  }

  return $out;
}

function semanas_x_mes($date, $rollover="Sunday")
{
    $cut        = substr($date, 0, 8);
    $daylen     = 86400;
    $timestamp  = strtotime($date);
    $first      = strtotime($cut . "01");
    $elapsed    = (($timestamp - $first) / $daylen)+1;
    $i          = 1;
    $weeks      = 0;
    for($i==1; $i<=$elapsed; $i++)
    {
        $dayfind        = $cut . (strlen($i) < 2 ? '0' . $i : $i);
        $daytimestamp   = strtotime($dayfind);
        $day            = strtolower(date("l", $daytimestamp));
        if($day == strtolower($rollover))
        {
            $weeks++;
        }
    }
    if($weeks==0)
    {
        $weeks++;
    }
    return $weeks;
}

function google_distance_calculator($origen,$destino ) {


	$sResponse=curl_request('http://maps.googleapis.com/maps/api/distancematrix/json',
	    'origins='.urlencode($origen).'&destinations='.urlencode($destino).'&mode=driving&units=metric&sensor=false');
	$oJSON=json_decode($sResponse);
	if ($oJSON->status=='OK')
	        $fDistanceInMTS=(float)preg_replace('/[^\d\.]/','',$oJSON->rows[0]->elements[0]->distance->text);
	else
	        $fDistanceInMTS=0;


	/*
	 if ($unit == "K") {
	    return ($fDistanceInMiles * 1.609344);
	  } else if ($unit == "N") {
	      return ($fDistanceInMiles * 0.8684);
	    } else {
	        return $fDistanceInMiles;
	      }
	*/

	return $fDistanceInMTS;

}
function curl_request($sURL,$sQueryString=null)
{
        $cURL=curl_init();
        curl_setopt($cURL,CURLOPT_URL,$sURL.'?'.$sQueryString);
        curl_setopt($cURL,CURLOPT_RETURNTRANSFER, TRUE);
        $cResponse=trim(curl_exec($cURL));
        curl_close($cURL);
        return $cResponse;
}


function google_translate($texto_a_traducir,$idioma_origen,$idioma_destino){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/language/translate/v2?key=AIzaSyAZIgHtoePGO6hlvO9Ef66AMS-PQFKIx-U&q=".urlencode($texto_a_traducir)."&source=".$idioma_origen."&target=".$idioma_destino);
	curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com");
	curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	$texto_traducido= curl_exec($ch);
	curl_close($ch);

	//echo $texto_traducido;

	$json = json_decode($texto_traducido, true);
	//echo "<pre>"; print_r($json); echo "</pre>";
	//echo "Translate:". $json["data"]["translations"][0]["translatedText"];

	//devuelvo el texto traducido
	return ($json["data"]["translations"][0]["translatedText"]);


}




function dias_calcular($checkin,$checkout){

	   $checkin = left($checkin,10);
	   $checkout = left($checkout,10);

		if (strpos($checkin, "/") !== false ){
				//separo el checkin y checkout en  m/d/y
				$checkin_vec = explode("/",$checkin);
				$checkout_vec = explode("/",$checkout);


				// Calculo de dias de estadia
				$cant_dias = round((strtotime($checkout_vec[1]."/".$checkout_vec[0]."/".$checkout_vec[2])-strtotime($checkin_vec[1]."/".$checkin_vec[0]."/".$checkin_vec[2]))/86400,0); // dias de cartelera
		}else{
			$cant_dias = round((strtotime($checkout)-strtotime($checkin))/86400,0); // dias de cartelera
		}

		return($cant_dias);

}

function cache_leer_directorio_y_eliminar($filename_part,$elimina = true){

	/*
	    abre el directorio y lee todos los files que comienzan x .... y los elimina

	*/

	$len = strlen($filename_part)    ;

	$directorio=CONFIG_CACHE;
	$dhandle = opendir($directorio);



	$files = array();
	$rta=false;
	if ($dhandle) {

	     while (false !== ($fname = readdir($dhandle))) {
	      if (($fname != '.') && ($fname != '..') ) {
	         if (!is_dir( $directorio."/".$fname )){

	             if (strtolower(substr($fname,0,$len)) == strtolower($filename_part)) {
				 	if ($elimina) {
						$file2remove=str_replace("//","/",$directorio."/".$fname);
				 		@unlink($file2remove);
				 	}
	                 $rta=true;

	               // echo "<br />ARchivo eliminado:".$fname;
	             }
	         }

	      }
	   }
	   closedir($dhandle);
	}


	return($rta);
}
function cache_limpiar($path="/"){

		$directorio=$path."cache";
		$dhandle = opendir($directorio);
		// define an array to hold the files
		$files = array();

		if ($dhandle) {
		   // loop through all of the files
		   while (false !== ($fname = readdir($dhandle))) {
			  // if the file is not this file, and does not start with a '.' or '..',
			  // then store it for later display
			  if (($fname != '.') && ($fname != '..') && ($fname != basename($_SERVER['PHP_SELF']) ) ) {
				  // store the filename
				 if (!is_dir( $directorio."/".$fname )){
					unlink($directorio."/".$fname);

				 }

			  }
		   }
		   // close the directory
		   closedir($dhandle);
		}

}
function file_cache_generar($file_name,&$objeto,$campo_clave,$campo_clave_valor,$limpia_objeto=true,$pagina_actual=0,$paginador_activo=false,$paginador_cant=50) {

	if (file_exists($file_name)) {
		$objeto->limpiar();
		$objeto->resultados_vec = unserialize(file_get_contents($file_name));


	}else{
			if ($limpia_objeto) 		$objeto->limpiar();
			if (trim($campo_clave)!='')  $objeto->$campo_clave = $campo_clave_valor;

            // Controlo la paginacion
            if ($paginador_activo) {
	            $total_registros=$objeto->cant_traer();
	            $total_paginas = ceil($total_registros / $paginador_cant);
				$objeto->traer($pagina_actual,$paginador_cant);

			}else{
				$objeto->traer();
			}



			$fp=fopen($file_name,"w");
			fwrite($fp,serialize($objeto->resultados_vec));
			fclose($fp);

	}
}
 function is_datenum_between($dt_start, $dt_check, $dt_end) {

 	$rta = false;
	if (($dt_start <= $dt_check) && ($dt_check<=$dt_end)) {
 		$rta = true;
 	}else{
 		// EJ: $dt_check => 350   $dt_start =>280    $dt_end=>7
 		if (($dt_end<=$dt_start) && ($dt_check>=$dt_start)) $rta = true;
 	}

	return($rta);

	//$checkin_fecha = date("Y-m-d", strtotime("1.1.".date("Y")." + ".$daynum_checkin." days"));

 }

 function isDateBetween($dt_start, $dt_check, $dt_end,$convierte_fechas=false){
 //isDateBetween("2004-01-01", "2004-01-02", "2004-01-03")
 $dt_start = str_replace("-","/",$dt_start);
 $dt_check = str_replace("-","/",$dt_check);
 $dt_end = str_replace("-","/",$dt_end);

 if ($convierte_fechas) {
 	//las paso al formato q se necesita para calcular
 	$aux = explode("/",$dt_start);
 	$dt_start=$aux[2]."-".$aux[1]."-".$aux[0];

 	$aux = explode("/",$dt_check);
 	$dt_check=$aux[2]."-".$aux[1]."-".$aux[0];

 	$aux = explode("/",$dt_end);
 	$dt_end=$aux[2]."-".$aux[1]."-".$aux[0];

 	//echo "<br />Compara: ".$dt_check." entre ".$dt_start." y ".$dt_end;
 }


  if(strtotime($dt_check) >= strtotime($dt_start) && strtotime($dt_check) <= strtotime($dt_end)) {
    return true;
  }
  return false;
}

 function fecha_mayor_otra($dt_start, $dt_check ,$convierte_fechas=false){
 //isDateBetween("2004-01-01", "2004-01-02", "2004-01-03")
 $dt_start = str_replace("-","/",$dt_start);
 $dt_check = str_replace("-","/",$dt_check);
 $dt_end = str_replace("-","/",$dt_end);

 if ($convierte_fechas) {
 	//las paso al formato q se necesita para calcular
 	$aux = explode("/",$dt_start);
 	$dt_start=$aux[2]."-".$aux[1]."-".$aux[0];

 	$aux = explode("/",$dt_check);
 	$dt_check=$aux[2]."-".$aux[1]."-".$aux[0];

 	$aux = explode("/",$dt_end);
 	$dt_end=$aux[2]."-".$aux[1]."-".$aux[0];

 	//echo "<br />Compara: ".$dt_check." entre ".$dt_start." y ".$dt_end;
 }


  if(strtotime($dt_check) >= strtotime($dt_start) ) {
    return true;
  }
  return false;
}

function dias_diff($fecha_1,$fecha_2){

	 $fecha_1 = str_replace("-","/",$fecha_1);
	 $fecha_2 = str_replace("-","/",$fecha_2);

	// Fecha 2 es la fecha mas grande
	$fecha_1=left($fecha_1,10);
	$fecha_2=left($fecha_2,10);

	//La fecha ingresa en este formato dd/mm/yyyy
	// Me devuelve la cant de dias de diferencia
 	$fecha1_vec = explode("/",$fecha_1);
	$fecha_num=$fecha1_vec[2].$fecha1_vec[1].$fecha1_vec[0];  //20111227
	$strtotime_fecha1=strtotime(($fecha1_vec[2]."-".$fecha1_vec[1]."-".$fecha1_vec[0]." 23:59:59"));

	$fecha2_vec = explode("/",$fecha_2);
	$fecha_num=$fecha2_vec[2].$fecha2_vec[1].$fecha2_vec[0];  //20111227
	$strtotime_fecha2=strtotime(($fecha2_vec[2]."-".$fecha2_vec[1]."-".$fecha2_vec[0]." 23:59:59"));


	$dias_diff =   round(abs($strtotime_fecha2-$strtotime_fecha1)/ 86400) ;

	return($dias_diff);

}

function xml_ws_guardar($obj, $config) {
	// Guarda la info en la base, para los scripts q vienen de flash/ipad/android,etc

	//  Ej de como llamarla:
	/* Se crea el objeto
		$status_obj = new happycode_status;

		$config = array(
			'fields'=>array(
				'id','estado','alta_ip','update_ip','alta_usuario', 'update_fecha','update_usuario_id','description'=>array('type'=>'text'), 'image'
			),
			'plural'=>'statuses',
			'singular'=>'status'
		);

		generate_xml($status_obj, $config);

	*/

	$config['parsed_fields'] = array();
	//primer bucle
	foreach($config['fields'] as $keyfield => $field) {
		//ponemos valores por default y convertimos $field a una array si no lo es
		if (is_array($field)) {
			if (!isset($field['key'])) {
				$field['key'] = $keyfield;
			}
			if (!isset($field['type'])) {
				$field['type'] = 'numeric';
			}
		} else {
			//como $field est· por referencia, lo pasamos a otra variable
			//ya que al modificarlo podemos provocar inconsistencias.
			$content = (string)$field;
			$field = array('key'=>$content, 'type'=>'numeric');
		}

		//filtramos el objeto por todas las claves
		$obj->$field['key'] = $_GET[$field['key']];

		$config['parsed_fields'][] = $field;
	}


	$obj->add( );

	//se cuentan la cantidad de coincidencias
	$cant=count($obj->resultados_vec);

	//generamos el XML a partir de la configuraciÛn y los campos parseados
	$xml_line = "<{$config['plural']} xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema'>\n";

		$xml_line.="<{$config['singular']}>";
		$xml_line.="<respuesta>OK</respuesta>";
		$xml_line.="</{$config['singular']}>\n";

	$xml_line.="</{$config['plural']}>\n";

	header("Content-Type: text/xml");

	echo $xml_line;

}
//esta funci?n genera xml configurable para cualquier objeto de la base de datos.
function json_generar($obj, $config,$recibe_por_get = true) {

    //  Ej de como llamarla:
    /* Se crea el objeto
      $status_obj = new happycode_status;

      $config = array(
      'fields'=>array(
      'id','estado','alta_ip','update_ip','alta_usuario', 'update_fecha','update_usuario_id','description'=>array('type'=>'text'), 'image'
      ),
      'plural'=>'statuses',
      'singular'=>'status'
      );

      generate_xml($status_obj, $config);

     */


    $config['parsed_fields'] = array();
    //primer bucle
    foreach ($config['fields'] as $keyfield => $field) {
        //ponemos valores por default y convertimos $field a una array si no lo es
        if (is_array($field)) {
            if (!isset($field['key'])) {
                $field['key'] = $keyfield;
            }
            if (!isset($field['type'])) {
                $field['type'] = 'numeric';
            }
        } else {
            //como $field est? por referencia, lo pasamos a otra variable
            //ya que al modificarlo podemos provocar inconsistencias.
            $content = (string) $field;
            $field = array('key' => $content, 'type' => 'numeric');
        }

        //filtramos el objeto por todas las claves
        if ($recibe_por_get) {
            $obj->$field['key'] = $_GET[$field['key']];
        }else{
            $obj->$field['key'] = $_POST[$field['key']];
        }

        $config['parsed_fields'][] = $field;
    }

    //traemos los registros
    $pagina = isset($config['pagina']) ? $config['pagina'] : 0;
    $pagina_cant = isset($config['pagina_cant']) ? $config['pagina_cant'] : 999999;

    if (isset($config['order'])) {
        $obj->traer($pagina, $pagina_cant, $config['order']);
    } else {
        $obj->traer($pagina, $pagina_cant);
    }

    //se cuentan la cantidad de coincidencias
    $cant = count($obj->resultados_vec);

    //generamos el XML a partir de la configuraci?n y los campos parseados

    for ($i = 0; $i < $cant; $i++) {
        foreach ($config['parsed_fields'] as $field) {
            $key = $field['key'];
            $value = $obj->resultados_vec[$i][$key];

            switch ($field['type']) {
                case 'text':
                    $obj->resultados_vec[$i][$key] = utf8_encode($obj->resultados_vec[$i][$key]);
                    break;
            }
        }
    }

    return(json_encode($obj->resultados_vec));
}

//esta funci?n genera xml configurable para cualquier objeto de la base de datos.
function xml_generar($obj, $config) {

    //  Ej de como llamarla:
    /* Se crea el objeto
      $status_obj = new happycode_status;

      $config = array(
      'fields'=>array(
      'id','estado','alta_ip','update_ip','alta_usuario', 'update_fecha','update_usuario_id','description'=>array('type'=>'text'), 'image'
      ),
      'plural'=>'statuses',
      'singular'=>'status'
      );

      generate_xml($status_obj, $config);

     */


    $config['parsed_fields'] = array();
    //primer bucle
    foreach ($config['fields'] as $keyfield => $field) {
        //ponemos valores por default y convertimos $field a una array si no lo es
        if (is_array($field)) {
            if (!isset($field['key'])) {
                $field['key'] = $keyfield;
            }
            if (!isset($field['type'])) {
                $field['type'] = 'numeric';
            }
        } else {
            //como $field est? por referencia, lo pasamos a otra variable
            //ya que al modificarlo podemos provocar inconsistencias.
            $content = (string) $field;
            $field = array('key' => $content, 'type' => 'numeric');
        }

        //filtramos el objeto por todas las claves
        $obj->$field['key'] = $_GET[$field['key']];

        $config['parsed_fields'][] = $field;
    }

    //traemos los registros
    $pagina = isset($config['pagina']) ? $config['pagina'] : 0;
    $pagina_cant = isset($config['pagina_cant']) ? $config['pagina_cant'] : 999999;

    if (isset($config['order'])) {
        $obj->traer($pagina, $pagina_cant, $config['order']);
    } else {
        $obj->traer($pagina, $pagina_cant);
    }

    //se cuentan la cantidad de coincidencias
    $cant = count($obj->resultados_vec);

    //generamos el XML a partir de la configuraci?n y los campos parseados
    $xml_line = "<{$config['plural']} xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema'>\n";

    for ($i = 0; $i < $cant; $i++) {
        $xml_line.="<{$config['singular']}>";

        foreach ($config['parsed_fields'] as $field) {
            $key = $field['key'];

            $value = $obj->resultados_vec[$i][$key];

            switch ($field['type']) {
                case 'text':
                    $value = utf8_encode($value);
                    $xml_line.="<$key><![CDATA[$value]]></$key>";
                    break;
                case 'collection':
                    //el caso de la colecciÛn es un poco mas complicado
                    $ds = $field['datasource'];
					$ds->limpiar();
                    foreach ($field['conditions'] as $condition_key_child => $condition_key_parent) {
                        //$ds->$condition_key_child = $obj->resultados_vec[$i][$condition_key_parent];
                        $ds->$condition_key_parent = $obj->resultados_vec[$i][$condition_key_child];
                    }
                    $ds->traer();

                    $xml_line.="<$key>";

                    $cant_child = count($ds->resultados_vec);

                    for ($j = 0; $j < $cant_child; $j++) {
                        $xml_line.="<{$field['singular']}>";

                        foreach ($field['fields'] as $fieldname => $fieldconfig) {
                            $value = $ds->resultados_vec[$j][$fieldname];
                            switch ($fieldconfig['type']) {
                                case 'text':
                                    $value = utf8_encode($value);
                                    $xml_line.="<$fieldname><![CDATA[$value]]></$fieldname>";
                                    break;
                                case 'numeric':
                                    $xml_line.="<$fieldname>$value</$fieldname>";
                                    break;
                                default:
                                    $xml_line.="<$fieldname>$value</$fieldname>";
                                    break;
                            }
                        }

                        $xml_line.="</{$field['singular']}>";
                    }

                    $xml_line.="</$key>";

                    break;
                case 'numeric':
                    $xml_line.="<$key>$value</$key>";
                    break;
                default:
                    $xml_line.="<$key>$value</$key>";
                    break;
            }
        }

        $xml_line.="</{$config['singular']}>\n";
    }

    $xml_line.="</{$config['plural']}>\n";

    header("Content-Type: text/xml");

    echo $xml_line;
}



	function isMobile(){
		// Concateno las 2 variables de servidor.
		$buscar_en = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['HTTP_ACCEPT'];
		return eregi( 'android|opera mini|blackberry|.rim.|palm os|windows ce', $buscar_en);
	}



define ("TAGS_PERMITIDOS","<br>,<br />,<p>,<b>,<i>");

	    function close_open_tags ($html, $ignore=array('img', 'hr', 'br')) {
	        if (preg_match_all("#<([a-z]+)( .*)?(?!/)>#iU", $html, $opentags)) {
	            $opentags[1] = array_diff($opentags[1], $ignore);
	            $opentags[1] = array_values($opentags[1]);
	            preg_match_all("#</([a-z]+)>#iU", $html, $closetags);
	            $opened = count($opentags[1]);
	            if (count($closetags[1]) == $opened) return $html;
	            $opentags[1] = array_reverse($opentags[1]);
	            for ($i=0;$i<$opened;$i++) {
	                if (!in_array($opentags[1][$i], $closetags)) $html .= '</'.$opentags[1][$i].'>';
	                else unset($closetags[array_search($opentags[1][$i], $closetags)]);
	            }
	        }
	        return $html;
	    }



function primer_dia_de_la_semana_habil ($semana = ""){
	// Me devuelve el primer dia de la semana
	return(strtotime ( date ( 'Y' ) . 'W' .($semana != "" ?  $semana :  date("W")) . '1' ));
}

function ultimo_dia_de_la_semana_habil ($semana = ""){
	// Me devuelve el primer dia de la semana
	return(strtotime ( date ( 'Y' ) . 'W' .($semana != "" ?  $semana :  date("W")) . '5' ));
}

function fecha_mayor_a_otra($fecha_desde,$fecha_hasta) {
	/* //////////////////////////////////////
		TRUE  --> MAYOR A HOY
		FALSE --> MENOR A HOY
		fecha en formato dd/mm/aaaa
		////////////////////////////////////// */
	list($dia,$mes,$anio) = explode ("/", $fecha_desde   );
	list($dia_hasta,$mes_hasta,$anio_hasta) = explode ("/", $fecha_hasta  );


	$fecha_es_mayor=false;
	if ($anio > $anio_hasta ) {
		$fecha_es_mayor=true;
	}else{
		if ($anio == $anio_hasta ) {  //Evaluo el mes
			if ($mes > $mes_hasta) {
				$fecha_es_mayor=true;
			}else{
				if ($mes == $mes_hasta) { //Evaluo el dia
					if ($dia > $dia_hasta) {
						$fecha_es_mayor=true;
					} elseif ($dia == $dia_hasta) {
						$fecha_es_mayor=true;
					}else{
						$fecha_es_mayor=false;
					}//del dia mayou
				}//del mes igual
			}	//del mes mayor
		}else{
			$fecha_es_mayor=false;
		}//del anio igual
	}	//del anio mayor
	return($fecha_es_mayor);
}
function export_query_to_csv($query,$columnas){

	$csv_output .= "<table>";
	$values = mysql_query($query) or die($query);
	$i = 0;

		$csv_output .= "<tr>";
		while ($i < count($columnas)) {
			$csv_output .= "<td> ".$columnas[$i]."</td>";
			$i++;
		}
		$csv_output .= "</tr>";

	$csv_output .= "\n";

	while ($rowr = mysql_fetch_row($values)) {
		$csv_output .= "<tr>";
		$cols=mysql_num_fields($values);
		for ($j=0;$j<$cols;$j++) {
			$csv_output .= "<td>".$rowr[$j]."</td>";
		}
		$csv_output .= "</tr>";
	}
	$csv_output .= "</table>";


/*
$filename = $file."_".date("Y-m-d_H-i",time());
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
*/

	return($csv_output);

}
function export_table_to_csv($table){

	$csv_output .= "<table>";
	$result = mysql_query("SHOW COLUMNS FROM ".$table."");
	$i = 0;
	if (mysql_num_rows($result) > 0) {
		$csv_output .= "<tr>";
		while ($row = mysql_fetch_assoc($result)) {
			$csv_output .= "<td>".$row['Field']."</td>";
			$i++;
		}
		$csv_output .= "</tr>";
	}
	$csv_output .= "\n";

	$values = mysql_query("SELECT * FROM ".$table."");
	while ($rowr = mysql_fetch_row($values)) {
		$csv_output .= "<tr>";
		for ($j=0;$j<$i;$j++) {
			$csv_output .= "<td>".$rowr[$j]."</td>";
		}
		$csv_output .= "</tr>";
	}
	$csv_output .= "</table>";


/*
$filename = $file."_".date("Y-m-d_H-i",time());
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
*/

	return($csv_output);

}



 function texto2xls($texto) {
    $texto=str_replace(";"," ",$texto);
    $texto=str_replace(","," ",$texto);
    $texto=str_replace("\n"," ",$texto);
    $texto=str_replace("\r"," ",$texto);
    $texto=str_replace("\t"," ",$texto);
    $texto=strip_tags(($texto) );
    $texto=str_replace("&amp;"," y ",$texto);
    $texto=str_replace("&"," y ",$texto);
    $texto=str_replace("&nbsp"," ",$texto);

    return($texto);
 }



function watermark($img_original, $img_marcadeagua, $img_nueva, $calidad)
{
	// obtener datos de la fotografia
	$info_original = getimagesize($img_original);
	$anchura_original = $info_original[0];
	$altura_original = $info_original[1];

	// obtener datos de la "marca de agua"
	$info_marcadeagua = getimagesize($img_marcadeagua);
	$anchura_marcadeagua = $info_marcadeagua[0];
	$altura_marcadeagua = $info_marcadeagua[1];
	// calcular la posiciÛn donde debe copiarse la "marca de agua" en la fotografia
	//$horizmargen = ($anchura_original - $anchura_marcadeagua)/2;
	$horizmargen = 0;

	//$vertmargen = ($altura_original - $altura_marcadeagua)/2;
	$vertmargen = ($altura_original - $altura_marcadeagua);

	// crear imagen desde el original
	$original = ImageCreateFromJPEG($img_original);
	ImageAlphaBlending($original, true);
	// crear nueva imagen desde la marca de agua
	$marcadeagua = ImageCreateFromPNG($img_marcadeagua);
	// copiar la "marca de agua" en la fotografia
	ImageCopy($original, $marcadeagua, $horizmargen, $vertmargen, 0, 0, $anchura_marcadeagua, $altura_marcadeagua);
	// guardar la nueva imagen
	ImageJPEG($original, $img_nueva, $calidad);
	// cerrar las im·genes
	ImageDestroy($original);
	ImageDestroy($marcadeagua);
}


function fechas_comparar($fecha_1,$fecha_2) {

	/* //////////////////////////////////////
		compara si fecha 1 es mayor q fecha 2
		////////////////////////////////////// */

	fecha_desglozar($fecha,$mes,$dia,$anio);
	fecha_desglozar($fecha_2,$mes_hoy,$dia_hoy,$anio_hoy);
	$fecha_es_mayor=false;

	if ($anio > $anio_hoy ) {
		$fecha_es_mayor=true;
	}else{
		if ($anio == $anio_hoy ) {  //Evaluo el mes
			if ($mes > $mes_hoy) {
				$fecha_es_mayor=true;
			}else{
				if ($mes == $mes_hoy) { //Evaluo el dia
					if ($dia > $dia_hoy) {
						$fecha_es_mayor=true;
					} elseif ($dia == $dia_hoy) {
						$fecha_es_mayor=true;
					}else{
						$fecha_es_mayor=false;
					}//del dia mayou
				}//del mes igual
			}	//del mes mayor
		}//del anio igual
	}	//del anio mayor

	return($fecha_es_mayor);

}
function limpiar_texto_full($texto){
    $texto = nl2br($texto);
    $texto = strip_tags($texto,TAGS_PERMITIDOS);
    $texto = web_explicitos_reemplazar($texto);
    $texto = email_explicitos_reemplazar($texto);
	return($texto);
}

// Calcula la edad (formato: dia/mes/aÒo)
function edad($edad){
list($dia,$mes,$anio) = explode("/",$edad);
$anio_dif = date("Y") - $anio;
$mes_dif = date("m") - $mes;
$dia_dif = date("d") - $dia;
if ($dia_dif < 0 || $mes_dif < 0)
$anio_dif--;
return $anio_dif;
}


function diferencia_entre_fechas($time1,$time2){
    // Variables $time1,$time2  son time();



    //Calculate the difference in seconds

    $difference = $time2 - $time1;

    $diffSeconds = $difference;

    //Calculate how many days are within $difference

    $days = intval($difference / 86400);

    //Keep the remainder

    $difference = $difference % 86400;

    //Calculate how many hours are within $difference

    $hours = intval($difference / 3600);

    //Keep the remainder

    $difference = $difference % 3600;

    //Calculate how many minutes are within $difference

    $minutes = intval($difference / 60);

    //Keep the remainder

    $difference = $difference % 60;

    //Calculate how many seconds are within $difference

    $seconds = intval($difference);

    //Output:

/*    echo "Time1: ".strftime("Time: %H:%M:%S Date %d %B %Y", $time1);

    echo "<br><br>";

    echo "Time2: ".strftime("Time: %H:%M:%S Date %d %B %Y", $time2);

    echo "<br><br>";

    echo "Difference in seconds: ".$diffSeconds;

    echo "<br><br>";

    echo "Difference in Days: ".$days." Hours: ".$hours." Minutes: ".$minutes." Seconds: ".$seconds;
*/
    $return_vec["dias"]=$days;
    $return_vec["hora"]=$hours;
    $return_vec["minutos"]=$minutes;
    $return_vec["segundos"]=$seconds;

    return($return_vec);

}

function emails_explicitos_reemplazar($text,$replace_con){

	/*
		Reemplaza los emails que figuren con el texto que le envio en $replace_con

		ej:
			$text = "hola,  mail es eduardo@hotmail.com y esto es para probar q onda";
			$replace = "---VERO---";

			devuelve:  hola, mail es ---VERO--- y esto es para probar q onda
	*/

	$regex = '#(.*)\@(.*)\.(.*)#';
	return(implode (" ",preg_replace  ($regex,$replace_con,explode(" ",$text))));

}


function web_explicitos_reemplazar($text,$replace_con){

	/*
		Reemplaza los emails que figuren con el texto que le envio en $replace_con

		ej:
			$text = "hola,  mail es eduardo@hotmail.com y esto es para probar q onda";
			$replace = "---VERO---";

			devuelve:  hola, mail es ---VERO--- y esto es para probar q onda
	*/

	$text = strtolower($text)	;

	$regex = '#(.*)\www(.*)\.(.*)#';
	$text = implode (" ",preg_replace  ($regex,$replace_con,explode(" ",$text)));

	$text = ucfirst($text)	;
	$regex = '#(.*)\WWW(.*)\.(.*)#';
	return(implode (" ",preg_replace  ($regex,$replace_con,explode(" ",$text))));

}



 function tooltip_poner($texto){
		$texto = wordwrap($texto,30,"<br />",TRUE);

		return("<span class='tooltip'><span class='top'></span><span class='middle'>".$texto."</span><span class='bottom'></span></span>");
}

   function transforma_urls_a_links($texto){
       if (ereg("[\"|'][[:alpha:]]+://",$texto) == false){
       	 $texto = ereg_replace('([[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/])', '<a href="\\1" target="\"_new\"">\\1</a>', $texto);
       }
   	return($texto);
   }

function texto_limpio($texto){
	$texto = strip_tags($texto,TAGS_PERMITIDOS);
	$texto= stripslashes(nl2br($texto));
	return($texto);
}


 function letra_capital($texto){

    $nombre = explode (" ",strtolower($texto));
    $texto="";
    if (count($nombre)>0) {
        for ($i=0;$i<count($nombre);$i++) $texto.=ucfirst($nombre[$i])." ";
    }else{
        $texto = ucfirst($nombre[0]);
    }
    return($texto);

}


    function cuit_validar($Cuit,$resultado_="" ) {
        $sFijo ="5432765432";
         $debug=false;

        //   **** $sCuit: La funcion recibe un $Cuit con guiones, en esta variable se guarda el $Cuit sin guiones para realizar los calculus.
        //   **** $bNCuit: Almacena el n˙mero del $Cuit en la posiciÛn seleccionada en una variable Byte (entero sin signo entre 0 y 255)
        //   **** $bNfijo: Almacena el n˙mero de la posiciÛn seleccionada de la variable $sFijo inicializada con "5432765432",  (numero fijo que utiliza afip para la verif (icaciÛn), en un entero sin signo (byte).
        //   **** $sCar: Digito Verif (icador.
        //   **** Si el  tamaÒo del $Cuit recibido es distinto de 13 o si el character de la posicion 3 del $Cuit no es ì-ì entonces la function devuelve que el $Cuit es inv·lido.

        if  (strlen($Cuit) < 11)  {
            return(false);
       }// end if (


        $Cuit = str_replace ("-","",$Cuit);
        $Cuit = left($Cuit,2)."-".mid($Cuit,3,8)."-".right($Cuit,1);


        $sCuit = rellenar(left($Cuit, 2), "0",2);
        if ($debug ) echo " <br />sCuit:".$sCuit;

        for ( $x = 3;$x< 12;$x++  ){
            $sCuit = $sCuit . rellenar(mid($Cuit, $x, 1), "0",1);
        } // del for

        if ($debug ) echo " <br />sCuit:".$sCuit;
        $sCar = rellenar(right($Cuit, 1), "0",1);
        $sCuit = $sCuit . $sCar ;

        if ($debug ) echo " <br />sCuit:".$sCuit;
        $sCuit = str_replace ("-","",$sCuit);


        //   **** Loopea desde el comienzo del $Cuit hasta el ultimo numero anterior al Digito Verif (icador (no lo incluye).

        for ( $x = 1;$x< 11;$x++){

            $bNCuit = intval(mid($sCuit, $x, 1));        //   **** Guarda en una variable $bNCuit.
            $bNfijo = intval(mid($sFijo, $x, 1));          //   **** $sFijo es una variable constante previamente mencionada, esto es un numero que utiliza AFIP (es fijo).
            $lTotal = $lTotal + ($bNCuit * $bNfijo);        //   **** Almacena la sumatoria de si mismo y el producto entre el valor del numero del $Cuit en la posicion seleccionada

            if ($debug ) echo " <br />bNCuit :".$bNCuit ." bNfijo:".$bNfijo."- lTotal:".$lTotal." x:".$x;
      //   **** y el del numero fijo otorgado x afip en la posicion determinada.

        } // del for



        if ($debug ) echo " <br />lTotal:".$lTotal;
        $lTotal = $lTotal%11;     //   **** Almacena el resto de la division de la sumatoria anterior dividido 11.
        if ($debug ) echo " <br />lTotal:".$lTotal;
        $lTotal = $lTotal * 10;          //   **** Multiplica dicho resto por 10.
        if ($debug ) echo " <br />lTotal:".$lTotal;
        $lTotal = $lTotal %11;     //   **** Vuelve a almacenar el resto de la division de ese resultado por 11.
        if ($debug ) echo " <br />lTotal:".$lTotal;



        if ( intval($sCar) != $lTotal ) {   //   **** Si el digito verif (icador (previamente guardado en $sCar) es distinto del resultado de los calculus anteriores el $Cuit es inv·lido
            if ($debug ) echo "<br />".$sCar." - ".$lTotal;
            return(false);
        }else{
            return(true);
        }


}     //   **** Si el $Cuit es v·lido la funcion devuelve FALSE.







function recuadros_armar($texto)		 {
	return( '
		<div class="roundcont">
		   <div class="roundtop">
			 <img src="images/recuadros/tl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
		   </div>
		   <div class="recuadro_centro">
			'.$texto.'
			<br />
			</div>
		   <div class="roundbottom">
				 <img src="images/recuadros/bl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
		   </div>
		</div>');

}


function recuadros_blanco_armar($texto)		 {
	return( '
		<div class="roundcont">
		   <div class="roundtop">
			 <img src="images/recuadros/tl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
		   </div>
		   <div class="recuadro_centro_blanco">
			'.$texto.'
			<br />
			</div>
		   <div class="roundbottom">
				 <img src="images/recuadros/bl.gif" alt="" width="15" height="15" class="corner" style="display: none" />
		   </div>
		</div>');

}


// FunciÛn $modulo, regresa el residuo de una divisiÛn
function mod($dividendo , $divisor)
{
  $resDiv = $dividendo / $divisor ;

  $parteEnt = floor($resDiv);            // Obtiene la parte Entera de $resDiv

  $parteFrac = $resDiv - $parteEnt ;      // Obtiene la parte Fraccionaria de la divisiÛn

  $modulo = round($parteFrac * $divisor);  // Regresa la parte fraccionaria * la divisiÛn ($modulo)
  return $modulo;
} // Fin de funciÛn mod





// FunciÛn ObtenerParteEntDiv, regresa la parte entera de una divisiÛn
function ObtenerParteEntDiv($dividendo , $divisor)
{
  $resDiv = $dividendo / $divisor ;
  $parteEntDiv = floor($resDiv);
  return $parteEntDiv;
} // Fin de funciÛn ObtenerParteEntDiv





// function fraction_part, regresa la parte Fraccionaria de una cantidad
function fraction_part($dividendo , $divisor)
{
  $resDiv = $dividendo / $divisor ;
  $f_part = floor($resDiv);
  return $f_part;
} // Fin de funciÛn fraction_part


// function string_literal conversion is the core of this program
// converts $numbers to spanish strings, handling the general special
// cases in spanish language.
function string_literal_conversion($number)
{
   // first, divide your $number in hundreds, tens and units, cascadig
   // trough subsequent divisions, using the modulus of each division
   // for the next.

   $centenas = ObtenerParteEntDiv($number, 100);

   $number = $number % 100;

   $decenas = ObtenerParteEntDiv($number, 10);
   $number = $number%10;

   $unidades = ObtenerParteEntDiv($number, 1);
   $number = $number % 1;
   $string_hundreds="";
   $string_tens="";
   $string_units="";

   // cascade trough hundreds. This will convert the hundreds part to
   // their corresponding string in spanish.
   if($centenas == 1) $string_hundreds = "ciento ";
   if($centenas == 2) $string_hundreds = "doscientos ";
   if($centenas == 3) $string_hundreds = "trescientos ";
   if($centenas == 4) $string_hundreds = "cuatrocientos ";
   if($centenas == 5) $string_hundreds = "quinientos ";
   if($centenas == 6) $string_hundreds = "seiscientos ";
   if($centenas == 7) $string_hundreds = "setecientos ";
   if($centenas == 8) $string_hundreds = "ochocientos ";
   if($centenas == 9) $string_hundreds = "novecientos ";


 // end switch hundreds

   // casgade trough tens. This will convert the tens part to corresponding
   // strings in spanish. Note, however that the strings between 11 and 19
   // are all special cases. Also 21-29 is a special case in spanish.
   if($decenas == 1){
      //Special case, depends on units for each conversion
      if($unidades == 1){
         $string_tens = "once";
      }

      if($unidades == 2){
         $string_tens = "doce";
      }

      if($unidades == 3){
         $string_tens = "trece";
      }

      if($unidades == 4){
         $string_tens = "catorce";
      }

      if($unidades == 5){
         $string_tens = "quince";
      }

      if($unidades == 6){
         $string_tens = "dieciseis";
      }

      if($unidades == 7){
         $string_tens = "diecisiete";
      }

      if($unidades == 8){
         $string_tens = "dieciocho";
      }

      if($unidades == 9){
         $string_tens = "diecinueve";
      }
   }
   //alert("$string_tens ="+$string_tens);

   if($decenas == 2){
      $string_tens = "veinti";
   }
   if($decenas == 3){
      $string_tens = "treinta";
   }
   if($decenas == 4){
      $string_tens = "cuarenta";
   }
   if($decenas == 5){
      $string_tens = "cincuenta";
   }
   if($decenas == 6){
      $string_tens = "sesenta";
   }
   if($decenas == 7){
      $string_tens = "setenta";
   }
   if($decenas == 8){
      $string_tens = "ochenta";
   }
   if($decenas == 9){
      $string_tens = "noventa";
   }

    // Fin de swicth $decenas


   // cascades trough units, This will convert the units part to corresponding
   // strings in spanish. Note however that a check is being made to see wether
   // the special cases 11-19 were used. In that case, the whole conversion of
   // individual units is ignored since it was already made in the tens cascade.

   if ($decenas == 1)
   {
      $string_units="";  // empties the units check, since it has alredy been handled on the tens switch
   }
   else
   {
      if($unidades == 1){
         $string_units = "un";
      }
      if($unidades == 2){
         $string_units = "dos";
      }
      if($unidades == 3){
         $string_units = "tres";
      }
      if($unidades == 4){
         $string_units = "cuatro";
      }
      if($unidades == 5){
         $string_units = "cinco";
      }
      if($unidades == 6){
         $string_units = "seis";
      }
      if($unidades == 7){
         $string_units = "siete";
      }
      if($unidades == 8){
         $string_units = "ocho";
      }
      if($unidades == 9){
         $string_units = "nueve";
      }
       // end switch units
   } // end if-then-else


//final special cases. This conditions will handle the special cases which
//are not as general as the ones in the cascades. Basically four:

// when you've got 100, you dont' say 'ciento' you say 'cien'
// 'ciento' is used only for [101 >= $number > 199]
if ($centenas == 1 && $decenas == 0 && $unidades == 0)
{
   $string_hundreds = "cien " ;
}

// when you've got 10, you don't say any of the 11-19 special
// cases.. just say 'diez'
if ($decenas == 1 && $unidades ==0)
{
   $string_tens = "diez " ;
}

// when you've got 20, you don't say 'veinti', which is used
// only for [21 >= $number > 29]
if ($decenas == 2 && $unidades ==0)
{
  $string_tens = "veinte " ;
}

// for $numbers >= 30, you don't use a single word such as veintiuno
// (twenty one), you must add 'y' (and), and use two words. v.gr 31
// 'treinta y uno' (thirty and one)
if ($decenas >=3 && $unidades >=1)
{
   $string_tens = $string_tens." y ";
}

// this line gathers all the hundreds, tens and units into the final string
// and returns it as the function value.
$final_string = $string_hundreds.$string_tens.$string_units;


return $final_string ;

} //end of function string_literal_conversion()================================

// handle some external special cases. Specially the $millions, $thousands
// and hundreds $descriptors. Since the same rules apply to all $number triads
// descriptions are handled outside the string conversion function, so it can
// be re used for each triad.


function convertir_numeros_a_letras($number)
{

  //$number = $number_format ($number, 2);
   $number1=$number;
   //settype ($number, "integer");
   $cent = explode ('.',$number1);
   $centavos = $cent[1];
   $numerparchado=$cent[0];
   if ($centavos == 0 || $centavos == undefined){ $centavos = "00";}

   if ($number == 0 || $number == "")
   { // if amount = 0, then forget all about conversions,
      $centenas_final_string=" cero "; // amount is zero (cero). handle it externally, to
      // function breakdown
  }
   else
   {

     $millions  = ObtenerParteEntDiv($number, 1000000); // first, send the $millions to the string
      $number = mod($numerparchado, 1000000);           // conversion function

     if ($millions != 0)
      {
      // This condition handles the plural case
         if ($millions == 1)
         {              // if only 1, use 'millon' (million). if
            $descriptor= " millon ";  // > than 1, use 'millones' ($millions) as
            }
         else
         {                           // a $descriptor for this triad.
              $descriptor = " millones ";
            }
      }
      else
      {
         $descriptor = " ";                 // if 0 million then use no $descriptor.
      }

	  $millions_final_string = string_literal_conversion($millions).$descriptor;


      $thousands = ObtenerParteEntDiv($number, 1000);  // now, send the $thousands to the string
        $number = $number % 1000 ;            // conversion function.
      //print "Th:".$thousands;


     if ($thousands != 1)
      {                   // This condition eliminates the $descriptor
         $thousands_final_string =string_literal_conversion($thousands) . " mil ";
       //  $descriptor = " mil ";          // if there are no $thousands on the amount
      }
      if ($thousands == 1)
      {
         $thousands_final_string = " mil ";
     }
      if ($thousands < 1)
      {
         $thousands_final_string = " ";
      }

      // this will handle $numbers between 1 and 999 which
      // need no $descriptor whatsoever.

      $centenas  = $number;
      $centenas_final_string = string_literal_conversion($centenas) ;

   } //end if ($number ==0)


   //finally, print the output.

   /* Concatena los millones, miles y cientos*/
   $cad = $millions_final_string.$thousands_final_string.$centenas_final_string;

   /* Convierte la cadena a May˙sculas*/
   $cad = strtoupper($cad);

   if (strlen($centavos)>2)
   {
      if(substr($centavos,2,3)>= 5){
         $centavos = substr($centavos,0,1).(intval(substr($centavos,1,2))+1);
      }   else{
        $centavos = substr($centavos,0,2);
       }
   }

   /* Concatena a los $centavos la cadena "/100" */
   if (strlen($centavos)==1)
   {
      $centavos = $centavos."0";
   }
   $centavos = $centavos. "/100";


   /* Asigna el tipo de $moneda, para 1 = PESO, para distinto de 1 = PESOS*/
   if ($number == 1)
   {
      $moneda = " PESO ";
   }
   else
   {
      $moneda = " PESOS ";
   }
   /* Regresa el n˙mero en cadena entre parÈntesis y con tipo de $moneda y la fase M.N.*/
   return( $cad.$moneda.$centavos." Pesos ");
}





function yesterday(){
	return(date("d/m/Y", time()-86400));
}



function paginador_generico($url,$pagina_actual,$total_registros,$paginar_de_a = 10,$idioma="es") {

/*
		$idioma_paginador_primero="&laquo;";
		$idioma_paginador_anterior="&lt;";
		$idioma_paginador_siguiente="&gt;";
		$idioma_paginador_ultima="&raquo;";
		$cant_paginas = ceil($total_registros / $paginar_de_a);

		if (strpos($url,"{PAGINA}")!==false) {

		}else{
				if (strpos($url,"?")!==false) {
					$url.="&pagina={PAGINA}";
				}else{
					$url.="?pagina={PAGINA}";
				}
		}


		echo "<div id='paginador'>
				<div class='total-registros'>".($idioma == "es" ? "Total de registros: ":"Records found: ")."<b>".$total_registros."</b></div><!-- total registros !-->";

		echo "<div class='paginas'>
				<ul>
					<li class='titulo'><b>".($idioma == "es" ? "P·ginas":"Page").":</b> </li>";

								$desde = 0;
		if($pagina_actual >5) 	$desde = $pagina_actual-5;
								$hasta = $desde+$paginar_de_a;
		if ($hasta > $cant_paginas) $hasta = $cant_paginas;

		//Anterior y primera
		if ($pagina_actual > 0) {
			 echo "		<li class='nexts'><a href='".str_replace("{PAGINA}",0,$url)."' class='paginador_first'>".$idioma_paginador_primero."</a></li>";
			 if ($pagina_actual != 0  ) echo "<li class='nexts'><a href='".str_replace("{PAGINA}",($desde-1),$url)."' class='paginador_anterior'>".$idioma_paginador_anterior."</a></li>";
		}


		for ($k=$desde;$k <$hasta;$k++) {

			if ($k==$pagina_actual) {
				echo "		<li ><span  class='paginador_pagina_actual'>".($k+1)."</span></li>";
			}else{
				echo " 		<li><a href='".str_replace("{PAGINA}",($k),$url)."'  class='paginador_paginas'>".($k+1)."</a></li>";
			}

		}

//		echo "PA:".$pagina_actual." CP:".$cant_paginas;
		if (($pagina_actual+1 ) <= $cant_paginas) {
			echo " <li class='nexts'><a href='".str_replace("{PAGINA}",($hasta+1),$url)."'  class='paginador_siguiente'> ".$idioma_paginador_posterior."</a></li>";
			echo " <li class='nexts'><a href='".str_replace("{PAGINA}",($cant_paginas-1),$url)."'  class='paginador_ultimo'> ".$idioma_paginador_ultima." </a></li>";

		}

		echo "	</div><!-- paginas !-->";
		echo "</div><!-- paginador !-->";
        
        
*/


		$idioma_paginador_primero="&laquo;";
		$idioma_paginador_anterior="&lt;";
		$idioma_paginador_siguiente="&gt;";
		$idioma_paginador_ultima="&raquo;";
		$cant_paginas = ceil($total_registros / $paginar_de_a);

		if (strpos($url,"{PAGINA}")!==false) {

		}else{
				if (strpos($url,"?")!==false) {
					$url.="&pagina={PAGINA}";
				}else{
					$url.="?pagina={PAGINA}";
				}
		}


		echo "<p>".($idioma == "es" ? "Total de registros: ":"Records found: ")."<b>".$total_registros."</b></p><!-- total registros !-->";

		echo "<ul id='paginador'>
					<li class='paginas'>".($idioma == "es" ? "P·ginas":"Page").":</li>";

								$desde = 0;
		if($pagina_actual >5) 	$desde = $pagina_actual-5;
								$hasta = $desde+$paginar_de_a;
		if ($hasta > $cant_paginas) $hasta = $cant_paginas;

		//Anterior y primera
		if ($pagina_actual > 0) {
			 echo "		<li ><a href='".str_replace("{PAGINA}",0,$url)."' >".$idioma_paginador_primero."</a></li>";
			 if ($pagina_actual != 0  ) echo "<li ><a href='".str_replace("{PAGINA}",($desde-1),$url)."'>".$idioma_paginador_anterior."</a></li>";
		}


		for ($k=$desde;$k <$hasta;$k++) {

			if ($k==$pagina_actual) {
				echo "		<li class='activo'>".($k+1)."</li>";
			}else{
				echo " 		<li><a href='".str_replace("{PAGINA}",($k),$url)."'>".($k+1)."</a></li>";
			}

		}

//		echo "PA:".$pagina_actual." CP:".$cant_paginas;
		if (($pagina_actual+1 ) <= $cant_paginas) {
			echo " <li ><a href='".str_replace("{PAGINA}",($hasta+1),$url)."'  > ".$idioma_paginador_posterior."</a></li>";
			echo " <li ><a href='".str_replace("{PAGINA}",($cant_paginas-1),$url)."'> ".$idioma_paginador_ultima." </a></li>";

		}

		echo "	</ul><!-- paginador !-->";
        
}

function paginador_armar($pagina_actual,$cant_paginas,$idioma_paginador_primero,$idioma_paginador_anterior,$idioma_paginador_siguiente,$idioma_paginador_ultima) {



		$pagina_uri=$_SERVER["REQUEST_URI"];
		//$pagina_uri = substr($pagina_uri,0, strpos($pagina_uri,".html") ); /// Me devuelve la url sin el html
		$ultimo_guion= trim(substr($pagina_uri, strrpos($pagina_uri,"-")+1 ,strlen($pagina_uri)));
		$pagina_sin_ultimo_guion= str_replace( $ultimo_guion,"",$pagina_uri);

		if ($_GET["envia_nro_pagina"]==1) {
			$url_para_paginar=	$pagina_sin_ultimo_guion."{PAGINA}.html";
		}else{
			$url_para_paginar=	str_replace( ".html","",$_SERVER["REQUEST_URI"])."-{PAGINA}.html";
		}



		echo "<div id='paginador'>";

		//Anterior y primera
		if ($pagina_actual > 1) {
			 //echo "<a href='javascript:ir_a_pagina(1)' class='paginador_first'> ´ ".$idioma_paginador_primero."</a> &nbsp;&nbsp;";
			 //echo "<a href='javascript:ir_a_pagina(". intval($pagina_actual-1) .")' class='paginador_anterior'>< ".$idioma_paginador_anterior."</a>&nbsp;&nbsp;";

			 echo "<a href='".str_replace("{PAGINA}",1,$url_para_paginar)."' class='paginador_first'> ´ ".$idioma_paginador_primero."</a> &nbsp;&nbsp;";
			 echo "<a href='".str_replace("{PAGINA}", intval($pagina_actual-1),$url_para_paginar)."' class='paginador_anterior'>< ".$idioma_paginador_anterior."</a>&nbsp;&nbsp;";

		}


		$desde = 1;
		if($pagina_actual >5) $desde = $pagina_actual-5;

		$hasta = $desde+10;
		if ($hasta > $cant_paginas) $hasta = $cant_paginas;

		//for ($k=1;$k <= $cant_paginas;$k++) {
		for ($k=$desde;$k <= $hasta;$k++) {
			if ($k==$pagina_actual) {
				echo "<span class='paginador_pagina_actual'>".$k."</span>";
			}else{
				echo " <a href='".str_replace("{PAGINA}", intval($k),$url_para_paginar)."'  class='paginador_paginas'>".$k."</a>";
			}
			echo "&nbsp;&nbsp;";

		}

		if (($pagina_actual+1 ) <= $cant_paginas) {

			//echo " <a href='javascript:ir_a_pagina(". intval($pagina_actual+1) .")'  class='paginador_siguiente'> ".$idioma_paginador_siguiente." > </a>&nbsp;&nbsp;";
			//echo " <a href='javascript:ir_a_pagina(". intval($cant_paginas) .")'  class='paginador_ultimo'> ".$idioma_paginador_ultima." &raquo;</a>";
			echo " <a href='".str_replace("{PAGINA}", intval($pagina_actual+1),$url_para_paginar)."'  class='paginador_siguiente'> ".$idioma_paginador_siguiente." > </a>&nbsp;&nbsp;";
			echo " <a href='".str_replace("{PAGINA}", intval($cant_paginas),$url_para_paginar)."'  class='paginador_ultimo'> ".$idioma_paginador_ultima." &raquo;</a>";

		}

		echo "</div>";

}



function array_esta_vacio($array_entrada){

	// Controla que el array que ingresa no este vacio
	// sirve para saber cuando cachear
	// Se debe ingresar la primera posicion de ese array en caso que sea
	// multidimensional Ej: $array_entrada[0];

 		$pos_0 = $array_entrada;
        $valores = array_values  ($pos_0 );

		$vacios = true;
        for ($i=0;$i<count($valores);$i++){
			$valores[$i]=trim($valores[$i]);
             if (($valores[$i]==='') or ($valores[$i] === 0)) {
			 }else{
				$vacios = false;
			 }
		}

          return($vacios);


}

function fecha_desde_mssql($fecha){

	//echo $fecha;


       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:
       		Como la fecha que viene del SQL el mes figura en letras,
		lo que hace es :
			desglozar esa fecha
			Traer el nro del mes por medio del string del mismo

		Devuelve :
			fecha en formato DD/MM/YYYY

         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */

  	 if ($fecha != NULL and $fecha != "" ) {
		  $result = trim($fecha);
		  $result = str_replace( "/", " ", $result );
		  $result = str_replace( "-", " ", $result );

		  list($anio,$mes, $dia, $hora ) = explode( " ", $result, 4 );
		  $mes=rellenar($mes,"0",2);
		  $dia=rellenar($dia,"0",2);
		  $anio=fmt_yyyy($anio);

		  if (ucase(trim($hora)) != "00:00AM")  {
			  return($dia."/".$mes."/".$anio." ".$hora);
		   }else{
			  return($dia."/".$mes."/".$anio);
		   }
	}else{
		  return("");
	}


}


  function html_text_cortar($text, $length = 100, $ending = '...', $exact = true, $considerHtml = true) {
/**
* Cuts a string to the length of $length and replaces the last characters
* with the ending if the text is longer than length.
* @param string  $text String to truncate.
* @param integer $length Length of returned string, including ellipsis.
* @param string  $ending Ending to be appended to the trimmed string.
* @param boolean $exact If false, $text will not be cut mid-word
* @param boolean $considerHtml If true, HTML tags would be handled correctly
* @return string Trimmed string.

*/

      if ($considerHtml) {

          // if the plain text is shorter than the maximum length, return the whole text

          if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {

              return $text;

          }



          // splits all html-tags to scanable lines

          preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);



          $total_length = strlen($ending);

          $open_tags = array();

          $truncate = '';



          foreach ($lines as $line_matchings) {

              // if there is any html-tag in this line, handle it and add it (uncounted) to the output

              if (!empty($line_matchings[1])) {

                  // if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)

                  if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {

                      // do nothing

                  // if tag is a closing tag (f.e. </b>)

                  } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {

                      // delete tag from $open_tags list

                      $pos = array_search($tag_matchings[1], $open_tags);

                      if ($pos !== false) {

                          unset($open_tags[$pos]);

                      }

                  // if tag is an opening tag (f.e. <b>)

                  } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {

                      // add tag to the beginning of $open_tags list

                      array_unshift($open_tags, strtolower($tag_matchings[1]));

                  }

                  // add html-tag to $truncate'd text

                  $truncate .= $line_matchings[1];

              }



              // calculate the length of the plain text part of the line; handle entities as one character

              $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&[0-9]{1,7};|&x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));

              if ($total_length+$content_length> $length) {

                  // the number of characters which are left

                  $left = $length - $total_length;

                  $entities_length = 0;

                  // search for html entities

                  if (preg_match_all('/&[0-9a-z]{2,8};|&[0-9]{1,7};|&x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {

                      // calculate the real length of all entities in the legal range

                      foreach ($entities[0] as $entity) {

                          if ($entity[1]+1-$entities_length <= $left) {

                              $left--;

                              $entities_length += strlen($entity[0]);

                          } else {

                              // no more characters left

                              break;

                          }

                      }

                  }

                  $truncate .= substr($line_matchings[2], 0, $left+$entities_length);

                  // maximum lenght is reached, so get off the loop

                  break;

              } else {

                  $truncate .= $line_matchings[2];

                  $total_length += $content_length;

              }



              // if the maximum length is reached, get off the loop

              if($total_length>= $length) {

                  break;

              }

          }

      } else {

          if (strlen($text) <= $length) {

              return $text;

          } else {

              $truncate = substr($text, 0, $length - strlen($ending));

          }

      }



      // if the words shouldn't be cut in the middle...

      if (!$exact) {

          // ...search the last occurance of a space...

          $spacepos = strrpos($truncate, ' ');

          if (isset($spacepos)) {

              // ...and cut the text in this position

              $truncate = substr($truncate, 0, $spacepos);

          }

      }



      // add the defined ending to the text

      $truncate .= $ending;



      if($considerHtml) {

          // close all unclosed html-tags

          foreach ($open_tags as $tag) {

              $truncate .= '</' . $tag . '>';

          }

      }



      return $truncate;
}



function meses_vec_traer($lang = 'es'){
 $meses_vec_es = array(
	1=>"Enero"
	,2=>"Febrero"
	,3=>"Marzo"
	,4=>"Abril"
	,5=>"Mayo"
	,6=>"Junio"
	,7=>"Julio"
	,8=>"Agosto"
	,9=>"Septiembre"
	,10=>"Octubre"
	,11=>"Noviembre"
	,12=>"Diciembre"
	);

   $meses_vec_en = array(
	1=>"January"
	,2=>"February"
	,3=>"March"
	,4=>"April"
	,5=>"May"
	,6=>"June"
	,7=>"July"
	,8=>"August"
	,9=>"September"
	,10=>"October"
	,11=>"November"
	,12=>"December"
	);


   $meses_vec_fr = array(
	1=>"Janvie"
	,2=>"FÈvrier "
	,3=>"Mars "
	,4=>"Avril "
	,5=>"Mai "
	,6=>"Juin "
	,7=>"Juillet "
	,8=>"Ao˚t "
	,9=>"Septembre "
	,10=>"Octobre "
	,11=>"Novembre "
	,12=>"DÈcembre "
	);


	switch ($lang){
		case "es": return($meses_vec_es); break;
		case "en": return($meses_vec_en); break;
		case "fr": return($meses_vec_fr); break;
	}


}



function dias_vec_traer($lang = 'es'){
 $dias_vec_es = array(
	0=>"Domingo"
	,1=>"Lunes"
	,2=>"Martes"
	,3=>"Miercoles"
	,4=>"Jueves"
	,5=>"Viernes"
	,6=>"Sabado"
	);

   $dias_vec_en = array(
	0=>"Sunday"
	,1=>"Monday"
	,2=>"Tuesday"
	,3=>"Wednesday"
	,4=>"Thursday"
	,5=>"Friday"
	,6=>"Saturday"
	);


   $dias_vec_fr = array(
	0=>"Dimanche "
	,1=>"Lundi"
	,2=>"Mardi "
	,3=>"Mercredi "
	,4=>"Jeudi "
	,5=>"Vendredi "
	,6=>"Samedi "
	);

	switch ($lang){
		case "es": return($dias_vec_es); break;
		case "en": return($dias_vec_en); break;
		case "fr": return($dias_vec_fr); break;
	}


}
function dias_restantes($fecha_final) {
	$fecha_actual = date("Y-m-d");
	$s = strtotime($fecha_final)-strtotime($fecha_actual);
	$d = intval($s/86400);
	$diferencia = $d;
	return $diferencia;
}

function pdf_generar(){

  /*
//incluimos la libreria html2fpdf
include_once ('html2fpdf.php');
// Guardamos en una variable el texto que contendra el pdf
$pdf = "
<html>
<head>
<title>Titulo del archivo pdf</title>
</head>
<body>
<p>Este es el texto del archivo pdf. Podemos incluir imagenes, enlaces, etc.</p>
</body>
</html>
";
$pdf = new html2fpdf(); // Generamos un objeto nuevo html2fpdf
$pdf -> AddPage(); // AÒadimos una p·gina
$pdf -> WriteHTML($pdf); // Indicamos la variable con el contenido que queremos incluir en el pdf
$pdf -> Output('archivo_pdf.pdf', 'D'); //Generamos el archivo "archivo_pdf.pdf". Ponemos como parametro 'D' para forzar la descarga del archivo.

*/

}


#  $date=date("Y-m-d H:i:s", strtotime ("-12hours"));
#   $date2=date("Y-m-d H:i:s", strtotime ("-2days"));
#   $date3=date("Y-m-d H:i:s", strtotime ("-1years"));
#   $date4=date("Y-m-d H:i:s", strtotime ("next Thursday"));
#   $date5=date("Y-m-d H:i:s", strtotime ("last Monday"));


function leerRSS($url, $idweb = 0) {
	$content = file_get_contents($url);
	if (!$content) {
		guardarLog($idweb, LOG_ERROR_LEER, 0);
		return false;
	}

	$noticias = simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA);
	if (!$noticias) {
		guardarLog($idweb, LOG_ERROR_PARSEAR, 0);
		return false;
	}

	$noticias = $noticias->channel;
	$ret = array();
	$c = 0;
	foreach ($noticias->item as $noticia) {
		//print_r($noticia);

		$ret[$c]['titulo'] = (string)$noticia->title;
		$ret[$c]['descripcion'] = (string)$noticia->description;
		$ret[$c]['link'] = (string)$noticia->link;
		$ret[$c]['fecha'] = (string)$noticia->pubDate;

		$c++;
	}

	return $ret;
}





function combo_fecha_armar ($tipo,$nombre_del_combo,$tabindex,$campo_a_seleccionar,$anio_inicial=0){
	/*
		$tipo	== 1 	-->	Dia
				== 2	--> Mes
				== 3	--> AÒo

		$nombre_del_combo		El nombre del control
		$campo_a_seleccionar	Si se pasa, selecciona ese dato directamente
		$anio_inicial			SI es == 0 , toma el aÒo actual
	*/

	switch ($tipo) {
		case 1:
			$desde=1;
			$hasta=31;
			break;
		case 2:
			$desde=1;
			$hasta=12;
			break;
		case 3:
			if ($anio_inicial == 0) {
				$desde=year(now());
			}else{
				$desde=$anio_inicial;
			}
			$hasta=year(now())+20;
			break;
	}

	echo "<select name='$nombre_del_combo' id='$nombre_del_combo' tabindex='$tabindex'>";
	for ($i=$desde;$i<$hasta;$i++){
		$selected="";
		if ($campo_a_seleccionar == $i)  $selected=" selected ";
		echo "<option value='$i' $selected>$i</option>";
	}
	echo "</select>";


}

function fecha_mayor_a_hoy($fecha) {

	/* //////////////////////////////////////
		TRUE  --> MAYOR A HOY
		FALSE --> MENOR A HOY
		////////////////////////////////////// */

	fecha_desglozar($fecha,$mes,$dia,$anio);
	fecha_desglozar(now(),$mes_hoy,$dia_hoy,$anio_hoy);
	$fecha_es_mayor=false;

	if ($anio > $anio_hoy ) {
		$fecha_es_mayor=true;
	}else{
		if ($anio == $anio_hoy ) {  //Evaluo el mes
			if ($mes > $mes_hoy) {
				$fecha_es_mayor=true;
			}else{
				if ($mes == $mes_hoy) { //Evaluo el dia
					if ($dia > $dia_hoy) {
						$fecha_es_mayor=true;
					} elseif ($dia == $dia_hoy) {
						$fecha_es_mayor=true;
					}else{
						$fecha_es_mayor=false;
					}//del dia mayou
				}//del mes igual
			}	//del mes mayor
		}//del anio igual
	}	//del anio mayor

	return($fecha_es_mayor);

}

//	include_once "java_lib.php";
function array_value_exists($vector,$campo_clave,$valor_buscado) {
	/* _____________________________________________________________
		Recorre el vector en busca del valor indicado dentro del
		campo indicado

		$vector			Es el vector en el q hay q buscar
		$campo_clave	Es el campo que hay q comparar contra el
						valor buscado
		$valor_buscado	Es el valor a comparar contra el campo indicado
		_____________________________________________________________	*/


	$encontro=false;
	$i=0;

	while ((!$encontro) and ($i<count($vector)) ) {

		if ($vector[$i][$campo_clave] == $valor_buscado) {
			$encontro=true;
		}
		$i++;
	}

	return($encontro);

}


function month($fecha) {

       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:

       		Ingresa:
	                 la fecha
		Devuelve:
			 el mes de la misma

         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */



	fecha_desglozar($fecha,$mes,$dia,$anio);
	return ($mes);
}

function year($fecha) {

       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:

       		Ingresa:
	                 la fecha
		Devuelve:
			 el mes de la misma

         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */



	fecha_desglozar($fecha,$mes,$dia,$anio);
	return ($anio);
}


function msgbox($texto) {

	//funcion que informa tipo message box de VB con el boton OK .
	echo "<script language='javascript'>";
	echo "smoke.alert('".$texto."')";
	echo "</script>";

}

function ucase($texto) {
	$texto=strtoupper($texto);
	return($texto);
}
function lcase($texto) {
	$texto=strtolower($texto);
	return($texto);
}

function dateadd_day(&$mes,&$dia,&$anio,$dias_a_sumar) {


	if ($dias_a_sumar <0) {
		$dia_final=$dia - ($dias_a_sumar*-1);
	}else{
		$dia_final=$dia + $dias_a_sumar;
	}

	$dias_x_mes_max=dia_x_mes ($mes);




	if ($dia_final > $dias_x_mes_max) {
		//cambio de mes.....
		//cambio de mes.....
		if ($dias_a_sumar >0) {
			$mes++;
		}else{
			$mes--;
		}

		$dia_final =$dia_final - $dias_x_mes_max;

		//veo si al sumar el mes cambio de aÒo tambien....
		if ($mes > 12) {
			$mes=1;
			$anio++;
		}
		if ($mes <1) {
			$mes=12;
			$anio--;
		}
	}//del if

	$dia=$dia_final;

}//de la fcion


function dia_x_mes ($mes,$anio=0) {

       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:
                Ingresa:
			El nro del mes del cual se quere obtener la cant
			de dias que tiene
                Devuelve:
        		La cantidad de dias que tiene ese mes
         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */


	switch ($mes) {

		case 1:
			return(31);
			break;
		case 2:
			if ($anio == 0) {
				//tomo este aÒo
				$anio =date ("Y");
			}
			return(28  + ($anio % 4 == 0));
			break;
		case 3:
			return(31);
			break;
		case 4:
			return(30);
			break;
		case 5:
			return(31);
			break;
		case 6:
			return(30);
			break;
		case 7:
			return(31);
			break;
		case 8:
			return(31);
			break;
		case 9:
			return(30);
			break;
		case 10:
			return(31);
			break;
		case 11:
			return(30);
			break;
		case 12:
			return(31);
			break;
	}

}


function redondear($numero,$presicion) {

  //Control de si es 5 o 50 (los 2 ultimos nros)
  // que le sume 0.00000001
  //Porque sino no redondea como lo hace el VB
  $numero=trim($numero);

  if (intval(right($numero,1)) == 5 or intval(right($numero,2)) == 50) {
  	$numero+=0.0000001;
  }


  if ($presicion == 0) {
    return round($numero);
  } else {
		$parte_1=floor($numero * pow(10, $presicion) + 0.5);
		$parte_2=pow(10, $presicion);

		if ((right($parte_1,1) == 0) and ($parte_1 != 0)) {
				//POrque si es 0.50 no me devuelve 0.50 sino 0.5 y  no qiuero !!
				$nro=($parte_1 / $parte_2);
			    $punto_pos=strpos($nro,".");
				if ($punto_pos == false) {  //Si no tenia decimales que le ponga el punto y liego los ceros
					$nro.=".";
				}
				for ($i=1;$i < $presicion;$i++){
					$nro.="0";
				}
				return($nro);

		}else{
			   return ($parte_1 / $parte_2);
		}
  }

}


function dateadd($formato,$fecha,$nro_a_sumar) {

	$result= trim($fecha);
	$result = str_replace ( "/"," ",$result );
	$result = str_replace ( "-"," ",$result );

	list($dia,$mes,$anio,$hh,$mm,$ss) = explode (" ", $result, 6);
	$dia=str_pad($dia,2,"0",STR_PAD_LEFT);
	$mes=str_pad($mes,2,"0",STR_PAD_LEFT);
	$anio=fmt_yyyy(str_pad($anio,4,"0",STR_PAD_LEFT));

	/*	//////////////////////////////////////////////
			Formatos posibles
			------------------
			yyyy     year
			q		Quarter
			m		Month
			y		year
			d		Day
			w		Weekday
			ww      Week of year
			h		Hour
			n		Minute
			s		Second
		//////////////////////////////////////////////	*/

    switch ($formato) {
        case "yyyy":
            $anio+=$nro_a_sumar;
            break;
        case "q":
            $anio +=($nro_a_sumar*3);
            break;
        case "m":
            $mes+=$nro_a_sumar;
			if ($mes > 12){
				$mes=1;
				$anio++;
			}
            break;
        case "y":
            $anio+=$nro_a_sumar;
            break;
        case "d":
			dateadd_day($mes,$dia,$anio,$nro_a_sumar);
			break;
        case "w":
             $dia+=$nro_a_sumar;
            break;
        case "ww":
             $dia+=($nro_a_sumar*7);
            break;
    } //del select


	$dia=str_pad($dia,2,"0",STR_PAD_LEFT);
	$mes=str_pad($mes,2,"0",STR_PAD_LEFT);
	$anio=fmt_yyyy(str_pad($anio,4,"0",STR_PAD_LEFT));

  	return ($dia."/".$mes."/".$anio);

}//de la fcion

function day($fecha) {

       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:
                Ingresa:
			Una Fecha en formato DD/MM/YYYY
                Devuelve:
        		El dia de esa fecha (DD)
         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */


	if (is_date($fecha)) fecha_desglozar($fecha,$mes,$dia,$anio);
	return ($dia);
}


function now() {

	/* *******************************************************************
		DEVUELVE:
		---------
			La fecha que tiene el SQL

		****************************************************************** */

	$fecha=date("d/m/Y");
    /*
    $sql="SELECT NOW() as fecha";

	query_execute_mysql($result_1,$sql,$rows_cant_1);

	if ($rows_cant_1 != 0) {
		while ($mi_row=mysql_fetch_row($result_1)) {

				$resultado= trim($mi_row[0]);

				$resultado= str_replace( "/", " ", $resultado);
				$resultado= str_replace( "-", " ", $resultado);
				list($anio,$mes, $dia, $theRest ) = explode( " ", $resultado, 4 );
				$mes=rellenar($mes,"0",2);
				$dia=rellenar($dia,"0",2);
				$anio=fmt_yyyy($anio);
				$fecha=$dia."/".$mes."/".$anio;
		}//del while
	} //del if
    */
	return ($fecha);

} //de la funcion


function fmt_textarea($texto){


	$texto=word_limpiar ($texto);
/*
		//echo "TEXTO:".$texto;

		$texto = str_replace ("<br/>","",$texto);
		$texto = str_replace ("<br />","",$texto);
		$texto = str_replace ('<br _moz_dirty=""/>',"",$texto);

		$texto = str_replace ("<br>","",$texto);
		$texto = str_replace ("\n","",$texto);



		//echo "<br />TEXTO modificado:".$texto;

*/
		return("'".trim(($texto))."'");

//		return("'".trim(htmlspecialchars(mysql_escape_string($texto)))."'");
}
function mysql_escape_mimic($inp) {
	//realscape pero q no llama al mysql
    if(is_array($inp))
        return array_map(__METHOD__, $inp);

    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
    }

    return $inp;
}

function fmt_string_sin_null($texto) {

	$texto=trim($texto);
    $texto=sql_injections_prevent($texto);
    
	if ($texto == '')  {
		return("' '");
	}else{
	    $texto=strip_tags($texto);
	    $texto=caracteres_raros_delete($texto);
        //$texto=nl2br($texto);
		//$texto=htmlspecialchars($texto);
		$texto=mysql_escape_mimic($texto);
		$texto=addslashes($texto);
		return("'".$texto."'");
	}

}


function conectar_mysql(&$cn,$user,$pwd,$servidor,$bd_nombre,$path_full,$carpeta) {

		/*
		   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

			$user		= (string)	usuario debe incluir la "l" si es necesario
			$pswd		= (string)
			$servidor	= (string)
			$bd_nombre	= (string)	base de datos sobre la q trabajara
			$path_full	= (string)	es el path que se obtiene de la session con el
									mismo nombre.
			$carpeta	= ( string ) es la carpeta actual del site
	   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 	*/

		$error_mensaje=$error_mensaje."<strong>";
		$error_mensaje=$error_mensaje."Imposible conectar al usuario ".$user."<br>";
		$error_mensaje=$error_mensaje."Debera logearse nuevamente ";

		$cn=mysql_connect( $servidor,$user,$pwd) or die (
			"Error al conectar :".mysql_error());

		$error_mensaje=$error_mensaje."<strong>";
		$error_mensaje=$error_mensaje."Imposible seleccionar la base de datos <br>";
		$error_mensaje=$error_mensaje."Debera logearse nuevamente ";
		$error=$error_mensaje;

		//selecciono la base de datos
		mysql_select_db($bd_nombre ,$cn ) or die (
			"Error al seleccionar la Base de datos :".mysql_error());

		//Si llego aca es porq no tubo errores
		$error="";

	} //de la funcion





	function query_execute_mysql(&$result,$sql,&$rows_cant) {

	  //ejecuto el query y devuelvo el resultado
		  $result=mysql_query( $sql) or die ("Error al Ejecutar la siguiente consulta  : ".$sql."  --> comuniqueselo a su administrador ".mysql_error());

			if ($result != 1 ) {
				  //traigo la cantidad de filas que tengo de resultado
				  $rows_cant = mysql_num_rows($result) ;
			} //del if

		return(0);
	}




function fmt_num_sin_null($texto) {
	$texto=trim($texto);
       /* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:
                Ingresa:
			$texto			=	texto a formatear
                Devuelve:
			formatea el texto a    -->   'texto' o si es vacio devuelve 'null'
         +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        */
	$texto=caracteres_raros_delete($texto);

	if ($texto == NULL) {
		return(0);
	}
	else
	{
		if (is_numeric(trim($texto)))  {
			return ($texto);
		}else{
			return(0);
		}

	}//de si no es null


} // DE LA FUNCITINO




function pagina_redireccionar($pagina) {

	//le manda al header del browser la nueva direccion de la pagina redireccionandola

    //header("Location:".$path_full."/".$pagina);   ---> NO HABILITAN LOS HOSTINGS

	echo "<form name='frm_redireccionar' method='post' action='".$pagina."'>

		  </form>";
		  echo "<script>
		  			document.frm_redireccionar.submit();
		  		</script>";



} //de la funcion

function caracteres_raros_delete($texto) {
global $cn;
/*
	if(get_magic_quotes_gpc())  // prevents duplicate backslashes
	  {
		$texto = stripslashes($texto);
	  }
	  if (phpversion() >= '5.0')
	  {
		$texto = $cn->real_escape_string($texto);
	  }else if (phpversion() >= '4.3.0')
	  {
		$texto = mysql_real_escape_string($texto);
	  } else
	  {
		$texto = mysql_escape_string($texto);
	  }


*/
	$texto=str_replace("\ "," ",$texto);
	$texto=trim($texto);
	//$texto=str_replace("'", " ",$texto);
	//$texto=trim($texto);
	//$texto=str_replace('"', " ",$texto);
	//$texto=trim($texto);
	$texto=str_replace("\\"," ",$texto);
	$texto=trim($texto);
	$texto=str_replace("\n", " ",$texto);
	$texto=trim($texto);
	$texto=str_replace("\r", " ",$texto);
	$texto=trim($texto);
	$texto=str_replace("\t", " ",$texto);
	$texto=trim($texto);
	//$texto=str_replace(">", " ",$texto);
	$texto=trim($texto);
	$texto=str_replace(chr(13), " ",$texto);
	$texto=trim($texto);
	$texto=str_replace("--", " ",$texto);
	$texto=trim($texto);
	$texto=str_replace(chr(10), " ",$texto);
	$ultimo_caract=right($texto,1);
	if (chr($ultimo_caract) == 13 or chr($ultimo_caract) == 10) {
		$texto=str_replace(mid($texto,1,len($text) - 1), " ",$texto);
	}

	if (is_numeric($texto)) {
		$texto=str_replace(",", ".",$texto);
	}


	//$texto=str_replace("&", "&amp;",$texto);

//	$texto=acentos_quitar($texto);
	$texto=trim($texto);

	return($texto);

}

function acentos_quitar($texto){

	/*
	$texto=str_replace("·", "a",$texto);
	$texto=trim($texto);
	$texto=str_replace("È", "e",$texto);
	$texto=trim($texto);
	$texto=str_replace("Ì", "i",$texto);
	$texto=trim($texto);
	$texto=str_replace("Û", "o",$texto);
	$texto=trim($texto);
	$texto=str_replace("˙", "u",$texto);
	$texto=trim($texto);
	$texto=str_replace("¡", "A",$texto);
	$texto=trim($texto);
	$texto=str_replace("…", "E",$texto);
	$texto=trim($texto);
	$texto=str_replace("Õ", "I",$texto);
	$texto=trim($texto);
	$texto=str_replace("”", "O",$texto);
	$texto=trim($texto);
	$texto=str_replace("⁄", "U",$texto);
	*/
	$texto=trim($texto);


	return($texto);
}

function right($texto,$cant_posiciones) {

       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:
                Ingresa:
			El string entero
                Devuelve:
        		El pedazo de string que corresponde a X posciciones
			desde la derecha
         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */


    return(substr($texto,strlen($texto)-$cant_posiciones,strlen($texto)));
}



/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */




function left($texto,$cant_posiciones) {

       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:
                Ingresa:
			El texto entero
                Devuelve:
        		El pedazo de string que corresponde a XX posiuciones
			a partir de la izquierda
         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */

    return(substr($texto,0,$cant_posiciones));
    }



/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */



function mid($texto,$desde,$hasta) {


       /* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:
		Ingresa:
			El texto entero, y las posiciones desde cuando hasta
			cuando
                Devuelve:
        		El pedazo de string q se encuentra entre esas posiciones

         +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			OOOOOO JJJJJJJJ OOOOOOOOOO !!!!
		++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

			 PHP --> posicion inicial es CERO , no UNO como en VB , asi que
				por eso le resto una posicion ( para q no nos confundamos )

		++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

	    return(substr($texto,$desde -1 ,$hasta));

    }



function fecha_desde_sql($fecha){


       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:
       		Como la fecha que viene del SQL el mes figura en letras,
		lo que hace es :
			desglozar esa fecha
			Traer el nro del mes por medio del string del mismo

		Devuelve :
			fecha en formato DD/MM/YYYY

         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */

  	 if ($fecha != NULL and $fecha != "" ) {
		  $result = trim($fecha);
		  $result = str_replace( "/", " ", $result );
		  $result = str_replace( "-", " ", $result );

		  list($anio,$mes, $dia, $hora ) = explode( " ", $result, 4 );
		  $mes=rellenar($mes,"0",2);
		  $dia=rellenar($dia,"0",2);
		  $anio=fmt_yyyy($anio);

		  if (ucase(trim($hora)) != "00:00AM")  {
			  return($dia."/".$mes."/".$anio." ".$hora);
		   }else{
			  return($dia."/".$mes."/".$anio);
		   }
	}else{
		  return("");
	}


}


/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */


function hora_desde_sql($fecha){

       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
					Devuelve :
						Hora en hh:mm:ss
         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */

	  $resultado = trim( $fecha);

	/*  ------------------------------------
		ASI VIENE DEL SQL
		------------------------------------
		May 20 2003 12:00AM
		Jan 1 1900  9:00PM
	   -------------------------------------- */

	  $la_hora_completa=right($resultado,7);

	  return ($la_hora_completa);

}




function hora_hacia_sql($hora){

       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
					Devuelve :
						Hora en hh:mm:ss o NULL
         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++      */

	  $hora= trim($hora);


	  if ( $hora != NULL ) {

		  $hora_vec=explode(":",$hora);
		  $la_hora=rellenar($hora_vec[0],0,2);
		  $los_minutos=rellenar($hora_vec[1],0,2);

		  //Le pongo el PM u AM
		 $hora=$la_hora.":".$los_minutos;

		  if($la_hora > 12 ) {
			$hora=$hora." PM";
		  }else{
			$hora=$hora." AM";
		  }

		  return ("'".$hora."'");
	  }else{
	  	  return ('NULL');
	  }



}

/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */



function fmt_fecha(&$fecha,$muestra_hora=true){

       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:

                Se le ingresa la fecha  en formato DD/MM/YYYY
               y devuelve la fecha para insertar en el SQL

		Devuelve :
			en formato MM/DD/YYYY  00:00

         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */


	  if (($fecha == NULL) or ($fecha == "")) {
	  		return("NULL");
	  }else{
		  $result = trim( $fecha);
		  $result = str_replace( "/", " ", $result );
		  $result = str_replace( "-", " ", $result );

		  list($dia,$mes, $anio, $theRest ) = explode( " ", $result, 4 );
		  $mes=rellenar($mes,0,2);
		  $dia=rellenar($dia,0,2);
		  $anio=fmt_yyyy($anio);
		  //return("'".$mes."-".$dia."-".$anio." 00:00AM'"); // MSSQL
		  if ($muestra_hora) {
		  		if (trim($theRest)!= '') {
					  return("'".$anio."-".$mes."-".$dia." ".$theRest."'");
				}else{
					  return("'".$anio."-".$mes."-".$dia." 00:00AM'");
				}
		  }else{
		  	  return("'".$anio."-".$mes."-".$dia."'");
		  }
	}
}

function fmt_yyyy($anio) {

	$anio_aux=$anio;

       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:
                Se le ingresa el aÒo y lo formatea a AAAA
         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++       */

	if (strlen($anio_aux) ==1) {
		$anio_aux="0".$anio_aux;
	}

	$anio_aux=right($anio_aux,2);

	if ($anio_aux >= 30) {
		$anio_aux=(mid(date(Y),1,2)-1).$anio_aux;
		//para el anio 2000 en adelante seria el 1900
	}
	else{
		$anio_aux=(mid(date(Y),1,2)).$anio_aux;
	}

	return($anio_aux);


}


function rellenar($texto,$caracter_de_relleno,$cant_caracteres_relleno) {

       /* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:
                Ingresa:
				$texto				=	texto a formatear
				$caracter_de_relleno		= 	Caracter con que se va a rellenar
				$cant_caracteres_relleno	=	Cantidad de caracteres q voy a agregar
								para formatear
                Devuelve:
			el texto formateado ....
         +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        */

	return(str_pad($texto,$cant_caracteres_relleno,$caracter_de_relleno,STR_PAD_LEFT));
}


function is_date($fecha) {


       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:

                Se le ingresa la fecha  en formato DD/MM/YYYY
		y devuelve
			TRUE --> si el formato y la fecha son correctos
			FALSE --> hay error

         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */

	fecha_desglozar($fecha,$mes,$dia,$anio);


    if (is_numeric($mes) && is_numeric($dia) && is_numeric($anio)) {
    	if (checkdate ($mes,$dia,$anio)==1) {
    		return(true);
    		}
    	else {
    		return(false);
    		}
        
    } else{
    		return(false);
    }
    

}

function fecha_desglozar($fecha,&$mes,&$dia,&$anio){


       /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
           EXPLICACION:

                Se le ingresa la fecha, la cual separa en formato DD/MM/YYYY

         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      */




	$result= trim($fecha);
	$result = str_replace ( "/"," ",$result );
	$result = str_replace ( "-"," ",$result );
  
  if ($result!='') {
  	list($dia,$mes,$anio,$theRest) = explode (" ", $result,4  );
  	$dia=str_pad($dia,2,"0",STR_PAD_LEFT);
  	$mes=str_pad($mes,2,"0",STR_PAD_LEFT);
  	$anio=fmt_yyyy(str_pad($anio,4,"0",STR_PAD_LEFT));
  }
  else {
    $dia='00';
    $mes='00';
    $anio='0000';
  }
	return(0);
}


   function upload_files($carpeta_destino,$txt_archivo,$archivo_new_name,&$archivo_ruta_new_name,$ftp_address,$ftp_user,$ftp_pwd){


       // establecer una conexion basica
       $servidor_ftp=$ftp_address;
       $nombre_usuario_ftp=$ftp_user;

       $id_con = ftp_connect($servidor_ftp);

       // inicio de sesion con nombre de usuario y contrasenya
       $resultado_login = ftp_login($id_con,$nombre_usuario_ftp, $ftp_pwd);

       //Extencion
       $archivo_extencion=strtolower(right($_FILES[$txt_archivo]['name'],3));
       $archivo_ruta_new_name =$carpeta_destino."/".$archivo_new_name.".".$archivo_extencion;

	   $upload = ftp_put($id_con,  "/".UPLOAD_PATH_ROOT."/".$archivo_ruta_new_name,$_FILES[$txt_archivo]['tmp_name'], FTP_BINARY);// upload the file

		 if (!$upload) {// check upload status
			   echo "FTP upload of $archivo_ruta_new_name has failed!";
		   } else {
			   //echo "Uploaded $file to $conn_id as $destination_file";
		   }

       // cierra la secuencia FTP
       ftp_close($id_con);

		return($archivo_ruta_new_name);

}


function fotos_table_show($name_beggin,$max_cant,$directorio,$titulo,$celda_width)	{
	/*	----------------------------------------------------------------------------
		Funcion
		--------
			Muestra todas las fotos que haya dentro del directorio en una tabla
			y las ordena en las celdas
			El nombre de la foto debe ser algo_1.jpg , algo_2.jpg ,etc

		Parametros:
		------------
		$name_beggin		Si el nombre de esas fotos es "nombre_foto_1.jpg" se debe pasar "nombre_foto" solamente
		$max_cant			La cantidad max de fotos q hay con ese nombre
		$directorio			El directorio donde se encuentran las fotos
		$titulo				El titulo que encabeza la tabla
		$celda_width		El ancho de las fotos
		-------------------------------------------------------------------------- 	*/
	$imagenes_cant=0;
	for ($i=1;$i<($max_cant + 1);$i++) {
		$imagenes_vec[$i]="<td width='".$celda_width."'><img src='".$directorio."/".$name_beggin."_".$i.".jpg' border='0' alt='".$name_beggin."'  width='".$celda_width."'  height='".$celda_width."'></td>";
	}


	//... Home ......
	echo " <tr>
				<td colspan='2' class='letra_titulo' align='left'>".$titulo."</td>
		  </tr>";


	echo "<tr>";
	for ($i=1;$i<($max_cant + 1);$i++) {
		echo $imagenes_vec[$i];
		$imagenes_cant++;
		if ($imagenes_cant == 2) {
			echo "</tr>
			<tr>";
			$imagenes_cant=0;
		}
	}


	if (($max_cant/2) != 0){
		echo "<td>&nbsp;</td>";
	}
	echo"</tr>";

}



function phpmailer_enviar($remitente_mail,$remitente_nombre,$destinatario_mail,$destinatario_nombre,$asunto,$mensaje ,$prepara_y_envia=true,$adjunto_url=""){
    require_once('Vendors/PHPMailer/class.phpmailer.php');

    $mail             = new PHPMailer(); // defaults to using php "mail()"
    $body             = $mensaje;
    $body             = str_replace("{SISTEMA_URL}",SISTEMA_URL,$body);
    $body             = eregi_replace("[\]",'',$body);
    
    $mensaje = str_replace("{SISTEMA_URL}",SISTEMA_URL,$mensaje);
    

    $mail->AddReplyTo( $remitente_mail,$remitente_nombre);
    $mail->SetFrom( $remitente_mail,$remitente_nombre);
    $mail->AddAddress($destinatario_mail, $destinatario_nombre);
    $mail->Subject    = $asunto;
    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    $mail->MsgHTML($body);

    if ($adjunto_url != '') $mail->AddAttachment($adjunto_url);      // attachment
    //$mail->AddAttachment("images/phpmailer.gif");      // attachment
    //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

    if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
     // echo "Message sent!";
    }
}

function mail_enviar_simple($remitente_mail,$remitente_nombre,$destinatario_mail,$asunto,$mensaje,&$rta,$formateo_asunto=true) {
	//Limpio la info de origen
	$remitente_nombre=caracteres_raros_delete($remitente_nombre);
	$remitente_nombre=caracteres_raros_delete($remitente_nombre);
	if ($formateo_asunto) $asunto=caracteres_raros_delete($asunto);
	$headers = "MIME-Version:1.0\n" ;
	$headers .= "From: ".$remitente_nombre."<".$remitente_mail.">\n";
	$headers .= "Reply-To: ".$remitente_nombre."<".$remitente_mail.">\n";
	$headers .= "Return-Path: ".$remitente_nombre."<".$remitente_mail.">\n";
	$headers .= "X-Sender: ".$remitente_nombre."<".$remitente_mail.">\n";
	$headers .= "X-Mailer: MyMailer v1.1\n";
	$headers .= "X-Priority: 3\n";
	$headers .= "Content-Type: text/html;charset=iso-8859-1\n";
	//echo "Para:".$destinatario_mail." <br>AS:".$asunto." <br>Mens:".$mensaje. " <br>Head:".$headers;
	if (! mail($destinatario_mail,$asunto,$mensaje,$headers)) {
		$rta="Error al enviar el e-mail<br>";
		return(false);
	}else{
		$rta="Se envio correctamente el e-mail<br>";
		return(true);
	}


}



function email_validar ($email) {

	/* *****************************

		Devuelve la respuesta en el str

	   ***************************** */

	$grabacion_rta="";

	if (trim($email) == '') {
		$grabacion_rta.="De completar la direccion de email --";
	}else{
			if ( strpos(trim($email),"@") == 0) {
				$grabacion_rta.="Email Invalido, falta @ --";
			}else{
				if ( strpos(trim($email),".") == 0) {
					$grabacion_rta.="Email Invalido, falta . --";
				}

			}
	} // del If

	return($grabacion_rta);
}


function xml_parsear($texto){
	/*
	//
	$texto=iconv("iso-8859", "UTF-8", $texto);


	*/
	$texto=acentos_quitar($texto);
	$texto=str_replace( "Ò",  "n", $texto);
	$texto=str_replace( "—",  "N", $texto);

	$texto=iconv("CP850", "UTF-8", $texto);
	$texto=str_replace( " & ",  " and ", $texto);
	$texto=str_replace( " / ",  " ", $texto);

	if (trim($texto)==''){
		return("  ");
	}else{
		return($texto);
	}

	return($texto);
}

function acentos_reemplazar($cadena){
    $tofind = "¿¡¬√ƒ≈‡·‚„‰Â“”‘’÷ÿÚÛÙıˆ¯»… ÀËÈÍÎ«ÁÃÕŒœÏÌÓÔŸ⁄€‹˘˙˚¸ˇ—Ò";
    $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
    return(strtr($cadena,$tofind,$replac));
}

function urls_formatear($texto,$pone_guiones = true){


	//$texto=acentos_quitar($texto);

	$texto=str_replace("·", "a",$texto);
	$texto=trim($texto);
	$texto=str_replace("È", "e",$texto);
	$texto=trim($texto);
	$texto=str_replace("Ì", "i",$texto);
	$texto=trim($texto);
	$texto=str_replace("Û", "o",$texto);
	$texto=trim($texto);
	$texto=str_replace("˙", "u",$texto);
	$texto=trim($texto);
	$texto=str_replace("¡", "A",$texto);
	$texto=trim($texto);
	$texto=str_replace("…", "E",$texto);
	$texto=trim($texto);
	$texto=str_replace("Õ", "I",$texto);
	$texto=trim($texto);
	$texto=str_replace("”", "O",$texto);
	$texto=trim($texto);
	$texto=str_replace("⁄", "U",$texto);

	$texto=str_replace( "Ò",  "n", $texto);
	$texto=str_replace( "—",  "N", $texto);
	$texto=iconv("CP850", "UTF-8", $texto);
	$texto=str_replace( " & ",  " and ", $texto);
	$texto=str_replace( " / ",  " ", $texto);

	$texto=caracteres_raros_delete($texto);

	if ($pone_guiones) {
		$texto = str_replace(' ', '-', $texto);
		$validas = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-";
		$cadena = '';

		for($i = 0; $i<strlen($texto); $i++) {
			if (strpos($validas, substr($texto,$i,1)) !== false) {
				$cadena .= substr($texto,$i,1);
			}
		}
	}else{
		$cadena= $texto;
	}

	return strtolower(trim($cadena));

}



function imagenes_obtener_from_texto($condicion_busqueda,$texto){

			/*
				Me devuelve un array con todas las "imagnes" que haya encontrado, por ej
				Si condicion de busqueda = "http://"

				Me devuelve un array similar a :

				Array ( [0] => imagenes.chollonet.com/banners/instalable/300x250-3.gif [1] => http://vousys.com/images/vousys_logo.jpg )


			*/

		$aux = explode('src="'.$condicion_busqueda,$texto);

		//Armo la lista de extensiones a controlar
		$extenciones = array("gif","jpg","png","bmp");

		//Inicializo un array parea cargar las imagenes q alla encontrado
		$imagenes_vec=array();
		$imagenes_cant=0;

		foreach($aux as  $val) {

			$pos=strpos($val,$glue1);
			$pos=strpos($val,'src="http://fotos.trucoteca.com/fotos-guias/');
			$key=substr($val,0,$pos);
			$array3[$key] =substr($val,$pos,strlen($val));
			// echo $array3[$key]."--- glue: $glue1<br /><br /><br /><br />";


			for ($i=0;$i<count($extenciones);$i++) {

				// echo "<br />entro con cada imagen <br /><br /><br />";
				//La extension asi como se cargo
				$tmp=array();
				$tmp=explode(".".$extenciones[$i],$array3[$key]);
				if ($tmp[0] != $array3[$key]) {
					$imagenes_vec[$imagenes_cant]=$tmp[0].".".$extenciones[$i];
					$imagenes_cant++;
				}


				//Los q tengan La extension en mayuscula, x las dudas
				$tmp=array();
				$tmp=explode(".".strtoupper($extenciones[$i]),$array3[$key]);
				if ($tmp[0] != $array3[$key]) {
					$imagenes_vec[$imagenes_cant]=$tmp[0].".".strtoupper($extenciones[$i]);
					$imagenes_cant++;
				}

				//Los q tengan La extension con la 1er letra en mayuscula, x las dudas
				$tmp=array();
				$tmp=explode(".".ucfirst($extenciones[$i]),$array3[$key]);
				if ($tmp[0] != $array3[$key]) {
					$imagenes_vec[$imagenes_cant]=$tmp[0].".".ucfirst($extenciones[$i]);
					$imagenes_cant++;
				}


			}//de las extensiones
	  }	//del explode

	  return($imagenes_vec);
}








function imagenes_externas_copiar_a_fotos($directorio_destino,$texto){

	/*
	Toma un texto y controla si hay imagenes externas a trucoteca
	las copia al server de fotos, en el directorio indicado
	y devuelve el texto modificado con las urls apuntando a trucoteca



	Parametros que debe recibir
	============================

		$directorio_destino = "noticias";	// Donde las voy a copiar
		$texto				= El texto a controlar


	Devuelve:
		el texto modificado ya con las urls correctas.

	*/



	$condicion_busqueda = "http://";
	$imagenes_vec 		= imagenes_obtener_from_texto($condicion_busqueda,$texto);
	$trucoteca_paths	= array("trucoteca.com"); //paths a controlar



	// Controlo que imagenes no son de trucoteca, para copiarlas
	for ($i=0; $i < count($imagenes_vec) ; $i++) {

		// Por cada imagen que recorro , veo si pertenece a algun path de los de trucoteca
		$imagen_pertenece_path = true;

		for ($m=0;$m< count($trucoteca_paths);$m++) {

			//Encontro una imagen que no es de los paths de trucoteca, la tengo que copiar
			if (strpos($imagenes_vec[$i],$trucoteca_paths[$m])  == "")  $imagen_pertenece_path = false;

		}



		if (!$imagen_pertenece_path){

			//echo "<br />Imagen a copiar: ".$imagenes_vec[$i];

			$to = $directorio_destino.'/';
			$clave = md5('infinit' . date('z'));
			$c = file_get_contents('http://fotos.trucoteca.com/copiar.php?to=' . urlencode($to) . '&file=' . urlencode('http://' . $imagenes_vec[$i]) . '&clave=' . $clave);
			if ($c != 'OK') echo "error subiendo la imagen: ".$imagenes_vec[$i];

			// Guardo en el array de las imagenes_reemplazadas
			$imagen_nombre = trim(substr($imagenes_vec[$i],strrpos($imagenes_vec[$i],"/")+1,strlen($imagenes_vec[$i])));
			$texto = str_replace($condicion_busqueda.$imagenes_vec[$i],"http://fotos.trucoteca.com/".$directorio_destino."/".$imagen_nombre,$texto);




		}else{
		//	echo "<br />Imagen de trucoteca: ".$imagenes_vec[$i];
		}


		return($texto);

	}//for


}


?>
