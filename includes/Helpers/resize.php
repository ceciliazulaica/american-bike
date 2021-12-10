<?

function resize2($path_y_archivo_original,$ancho,$alto,$path_y_archivo_destino){
	
	/*
		Ejemplo para usarla
		
		   // ____________ Foto  ________________
		   $archivo_id=0;
		   $archivo_upload=false;
		   if (trim($HTTP_POST_FILES['txt_archivo_ruta']['name']) != '') {
				$archivo_ruta_new_name='';
				$archivo_id=numeracion_traer('utopia_settings_fotos'); //Creo el nuevo nombre de la foto;
				$utopia_settings_fotos_vec[0]['id']=intval($archivo_id);
				$utopia_settings_fotos_vec[0]['utopia_settings_id']=$utopia_settings_vec[0]['id'];
				$path="images/about_us/";
				$file_nuevo="../".$path."tmp_".strtolower($HTTP_POST_FILES["txt_archivo_ruta"]['name']);
				$utopia_settings_fotos_vec[0]['archivo_ruta']=$path.strtolower($HTTP_POST_FILES["txt_archivo_ruta"]['name']);

				if (is_uploaded_file($HTTP_POST_FILES["txt_archivo_ruta"]['tmp_name'])) {
						if  (!move_uploaded_file( $HTTP_POST_FILES["txt_archivo_ruta"]['tmp_name'], $file_nuevo) ) {
							echo "errror subiendo el archvo:".$file_nuevo;
						 }else{
							//limpio las fotos
							mysql_query("delete from utopia_settings_fotos");
						 }
				}else{
						echo "Archivo temporal ".$HTTP_POST_FILES["txt_archivo_ruta"]['tmp_name']."  NO existente";
				}	

				//Creo la imagen resized
				require_once('resize.php'); 
				$utopia_settings_fotos_vec[0]['archivo_ruta']=$path.resize2($file_nuevo,740,280,"../".$path);
				unlink($file_nuevo);
				utopia_settings_fotos_add($utopia_settings_fotos_vec);
		  }
	
	*/
	
	
	$info = getimagesize($path_y_archivo_original);
	
	switch ($info[2]){
		case 1: $im = $filename = time().'.gif'; break;
		case 2: $im = $filename = time().'.jpg'; break;
		case 3: $im = $filename = time().'.png'; break;
	}
	
	
	$imagen_nueva = $path_y_archivo_destino.$filename;
	if (!file_exists($path_y_archivo_destino.'thumbs/')) mkdir ($path_y_archivo_destino.'thumbs/',0777) ;
	$imagen_thum = $path_y_archivo_destino.'thumbs/'.$filename;
	
	if (file_exists($imagen_nueva)) unlink($imagen_nueva);
	
//	move_uploaded_file($file, $imagen_nueva);
		
	copy($path_y_archivo_original,$imagen_nueva);

	
	switch ($info[2]){
		case 1: $im = imagecreatefromgif($imagen_nueva); break;
		case 2: $im = ImageCreateFromJPEG($imagen_nueva); break;
		case 3: $im = imagecreatefrompng($imagen_nueva); break;
	}
	
	$width = $info[0];
	$height = $info[1];
	
	if($width > $height)
		$rel_asp = $width/$height;
	else
		$rel_asp = $height/$width;
	
	
	if(($width/$ancho) < ($height/$alto)){
		
		$newimage = imagecreatetruecolor($ancho,($ancho*$rel_asp));
		
		imageCopyResized($newimage,$im,0,0,0,0,$ancho,($ancho*$rel_asp),$width,$height);
		imageantialias($newimage,true);
		
	}else{
		
		$newimage = imagecreatetruecolor(($alto*$rel_asp),$alto);
		
		imageCopyResized($newimage,$im,0,0,0,0,($alto*$rel_asp),$alto,$width,$height);
		imageantialias($newimage,true);
		
	}
	
	switch ($info[2]){
		case 1: imagegif($newimage,$imagen_nueva); break;
		case 2: ImageJpeg($newimage,$imagen_nueva,90); break;
		case 3: imagepng($newimage,$imagen_nueva); break;
	}
	
	chmod($imagen_nueva,0777);
	return $filename;
}



##############################################
# Shiege Iseng Resize Class
# 11 March 2003
# shiegege@yahoo.com
# http://kentung.f2o.org/scripts/thumbnail/
################
# Thanks to :
# Dian Suryandari <dianhau@yahoo.com>
/*############################################
Sample :
$thumb=new thumbnail("./shiegege.jpg");			// generate image_file, set filename to resize
$thumb->size_width(100);				// set width for thumbnail, or
$thumb->size_height(300);				// set height for thumbnail, or
$thumb->size_auto(200);					// set the biggest width or height for thumbnail
$thumb->jpeg_quality(75);				// [OPTIONAL] set quality for jpeg only (0 - 100) (worst - best), default = 75
$thumb->show();						// show your thumbnail
$thumb->save("./huhu.jpg");				// save your thumbnail to file
----------------------------------------------
Note :
- GD must Enabled
- Autodetect file extension (.jpg/jpeg, .png, .gif, .wbmp)
  but some server can't generate .gif / .wbmp file types
- If your GD not support 'ImageCreateTrueColor' function,
  change one line from 'ImageCreateTrueColor' to 'ImageCreate'
  (the position in 'show' and 'save' function)
*/############################################


class thumbnail
{
	var $img;

	function thumbnail($imgfile)
	{
		//detect image format
		$this->img["format"]=ereg_replace(".*\.(.*)$","\\1",$imgfile);
		$this->img["format"]=strtoupper($this->img["format"]);
		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG"  || $this->img["format"]=="JPG") {
			//JPEG
			$this->img["format"]="JPEG";
			$this->img["src"] = ImageCreateFromJPEG ($imgfile);
		} elseif ($this->img["format"]=="PNG") {
			//PNG
			$this->img["format"]="PNG";
			$this->img["src"] = ImageCreateFromPNG ($imgfile);
		} elseif ($this->img["format"]=="GIF") {
			//GIF
			$this->img["format"]="GIF";
			$this->img["src"] = ImageCreateFromGIF ($imgfile);
		} elseif ($this->img["format"]=="WBMP") {
			//WBMP
			$this->img["format"]="WBMP";
			$this->img["src"] = ImageCreateFromWBMP ($imgfile);
		} else {
			//DEFAULT
			echo "Not Supported File";
			exit();
		}
		@$this->img["lebar"] = imagesx($this->img["src"]);
		@$this->img["tinggi"] = imagesy($this->img["src"]);
		//default quality jpeg
		$this->img["quality"]=75;
	}

	function size_height($size=100)
	{
		//height
    	$this->img["tinggi_thumb"]=$size;
    	@$this->img["lebar_thumb"] = ($this->img["tinggi_thumb"]/$this->img["tinggi"])*$this->img["lebar"];
	}

	function size_width($size=100)
	{
		//width
		$this->img["lebar_thumb"]=$size;
    	@$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"]/$this->img["lebar"])*$this->img["tinggi"];
	}

	function size_auto($size=100)
	{
		//size
		if ($this->img["lebar"]>=$this->img["tinggi"]) {
    		$this->img["lebar_thumb"]=$size;
    		@$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"]/$this->img["lebar"])*$this->img["tinggi"];
		} else {
	    	$this->img["tinggi_thumb"]=$size;
    		@$this->img["lebar_thumb"] = ($this->img["tinggi_thumb"]/$this->img["tinggi"])*$this->img["lebar"];
 		}
	}

	function jpeg_quality($quality=75)
	{
		//jpeg quality
		$this->img["quality"]=$quality;
	}

	function show()
	{
		//show thumb
		@Header("Content-Type: image/".$this->img["format"]);

		/* change ImageCreateTrueColor to ImageCreate if your GD not supported ImageCreateTrueColor function*/
		$this->img["des"] = ImageCreateTrueColor($this->img["lebar_thumb"],$this->img["tinggi_thumb"]);
    		@imagecopyresized ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["lebar_thumb"], $this->img["tinggi_thumb"], $this->img["lebar"], $this->img["tinggi"]);

		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
			//JPEG
			imageJPEG($this->img["des"],"",$this->img["quality"]);
		} elseif ($this->img["format"]=="PNG") {
			//PNG
			imagePNG($this->img["des"]);
		} elseif ($this->img["format"]=="GIF") {
			//GIF
			imageGIF($this->img["des"]);
		} elseif ($this->img["format"]=="WBMP") {
			//WBMP
			imageWBMP($this->img["des"]);
		}
	}

	function save($save="")
	{
		//save thumb
		if (empty($save)) $save=strtolower("./thumb.".$this->img["format"]);
		/* change ImageCreateTrueColor to ImageCreate if your GD not supported ImageCreateTrueColor function*/
		$this->img["des"] = ImageCreateTrueColor($this->img["lebar_thumb"],$this->img["tinggi_thumb"]);
    		@imagecopyresized ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["lebar_thumb"], $this->img["tinggi_thumb"], $this->img["lebar"], $this->img["tinggi"]);

		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
			//JPEG
			ini_set(safe_mode,Off);
			touch($save);
			imageJPEG($this->img["des"],"$save",$this->img["quality"]);
			ini_set(safe_mode,On);
		} elseif ($this->img["format"]=="PNG") {
			//PNG
			ini_set(safe_mode,Off);
			touch($save);
			imagePNG($this->img["des"],"$save");
			ini_set(safe_mode,On);
		} elseif ($this->img["format"]=="GIF") {
			//GIF
			ini_set(safe_mode,Off);
			touch($save);
			imageGIF($this->img["des"],"$save");
			ini_set(safe_mode,On);
		} elseif ($this->img["format"]=="WBMP") {
			//WBMP
			ini_set(safe_mode,Off);
			touch($save);
			imageWBMP($this->img["des"],"$save");
			ini_set(safe_mode,On);
		}

	}
}
?>