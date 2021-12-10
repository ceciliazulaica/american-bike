<?php

/**
 * @author Veronica Osorio para www.vousys.com
 */
 
 print_r($_POST);
 
 print_r($HTTP_POST_FILES);
 
 if (($_GET["envia"] == 1)) {
	 $file_nuevo="../images/".$_POST["carpeta"]."/".$HTTP_POST_FILES["txt_videos_ruta"]['name'];
	
	if (is_uploaded_file($HTTP_POST_FILES["txt_videos_ruta"]['tmp_name'])) {
		if  (!move_uploaded_file( $HTTP_POST_FILES["txt_videos_ruta"]['tmp_name'], $file_nuevo) ) {
			echo "NO pudo subir el archivo";
		}else{
			echo "<br /><br /><br />subio el archivo a ".$file_nuevo;

			if (file_exists($file_nuevo)) {
				echo "<br /> el archivo subido existe fisicamente";
				echo "<img src='$file_nuevo'>";
				echo "<a href='$file_nuevo'>Descargar</a>";
			}else{
				echo "<br /> el archivo subido NO existe fisicamente";
				
			}

		}
	}else{
			echo "no existe el file temporal";
	}

}
?>
<form method="post" ENCTYPE='multipart/form-data' action="test_uploads.php?envia=1">
	<input type="file" name="txt_videos_ruta">
	<select name="carpeta">
		<option value="photographers">images/photographers</option>
		<option value="videos">images/videos</option>
	</select>
	<input  type="submit" />
</form>