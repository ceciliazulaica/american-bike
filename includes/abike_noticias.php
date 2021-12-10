<?
    
    /* --------------------------------------------------
          Libreria Desarrollada por Veronica Osorio para Vousys Consulting - www.vousys.com
                    info@vousys.com
       -------------------------------------------------- */
    
    
    
    
class abike_noticias{
    
        //defino las variables de la clase 
          var $id;
          var $estado;
          var $alta_ip;
          var $update_ip;
          var $alta_fecha;
          var $alta_usuario_id;
          var $update_fecha;
          var $update_usuario_id;
          var $descripcion;
          var $bajada;
          var $porcentaje;
          var $cuerpo;
          var $imagen;
          var $fuente;
          var $icono;
         var $resultados_vec;
    
    function _construct() {
            $this->limpiar();
    }
    
    function limpiar() {
    
    // Inicializo las variables (se ejecuta solo cuando se instancia el objeto)
          $this->id='';
          $this->estado='';
          $this->alta_ip='';
          $this->update_ip='';
          $this->alta_fecha='';
          $this->alta_usuario_id='';
          $this->update_fecha='';
          $this->update_usuario_id='';
          $this->descripcion='';
          $this->bajada='';
          $this->porcentaje='';
          $this->cuerpo='';
          $this->imagen='';
          $this->fuente='';
          $this->icono='';
             $this->resultados_vec = array();
    
    }
    
    
function combo_armar($combo_nombre , $combo_id, $selected='',$muestra_todos=false) {
    /* me arma el combo en pantalla */
    $this->traer();
     
    $rta = "<select name='$combo_nombre' id='$combo_id' >";
    if ($muestra_todos) $rta.="<option value='0'>Seleccione</option>";
    $cant = count($this->resultados_vec);
    for ($i=0;$i<$cant;$i++) {
            $rta.="<option value='".$this->resultados_vec[$i]['id']."' ".($this->resultados_vec[$i]['id'] == $selected ? "selected='true'":'').">".$this->resultados_vec[$i]['descripcion']."</option>";
    }
    $rta.='</select>';
   return ($rta);
} //fcion
function imagenes_subir($campo_form,$id){
    
   //Sube la imagen 
    
    if (trim($_FILES[$campo_form]['name']) != '') {
        $archivo_id=numeracion_traer('abike_noticias_img'); //Creo el nuevo nombre de la foto;
        if (is_uploaded_file($_FILES[$campo_form]['tmp_name'])) {
                $ext = pathinfo($_FILES[$campo_form]['name'], PATHINFO_EXTENSION);
                $name = strtolower( urls_formatear(str_replace('.'.$ext,'',$_FILES[$campo_form]['name'])));
                $file_nuevo ='images/_noticias/'.$id.rand().'_'.$archivo_id.'_'. $name.'.'. $ext;
                if  (!move_uploaded_file( $_FILES[$campo_form]['tmp_name'], '../'.$file_nuevo) )  echo 'errros subiendo el archvo:'.$file_nuevo;
        }else{
                echo 'Archivo temporal '.$_FILES[$campo_form]['tmp_name'].'  NO existente';
        }
    }
    return($file_nuevo);
} // subir imagen
function add() {
            
           global $cn; 
    //_________ Traigo el Id correspondiente ________
    //$this->id=numeracion_traer("abike_noticias");
    
    //_________ Inserto ________
    
    $sql="insert into abike_noticias( 
             estado
             ,alta_ip
             ,alta_fecha
             ,alta_usuario_id
             ,descripcion
             ,bajada
             ,porcentaje
             ,cuerpo
             ,imagen
             ,fuente
             ,icono
            )
            
            VALUES ( 
              ".ESTADO_ACTIVO."
             , ".fmt_string_sin_null($_SERVER['REMOTE_ADDR'])."
             , NOW() 
             , ".intval($_SESSION['sess_usuario_id'])."
             ,  ".fmt_string_sin_null(($this->descripcion))."
             ,  ".fmt_string_sin_null(($this->bajada))."
             ,  ".fmt_string_sin_null(($this->porcentaje))."
             ,  ".fmt_textarea($this->cuerpo)."
             ,  ".fmt_string_sin_null(($this->imagen))."
             ,  ".fmt_string_sin_null(($this->fuente))."
             ,  ".fmt_string_sin_null(($this->icono))."
        )";
    
    //_________ Ejecuto el Query ________
    
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;
    
    
    $this->id=$cn->insert_id;
    
            $log_obj= new log; $log_obj->add($sql,'abike_noticias-ADD','ID:'.$this->id);

        return($this->id);
} //de la fcion

    
function campo_update($campo,$valor) {
    
           global $cn; 
    
    // actualiza un solo campo
    $sql="UPDATE abike_noticias SET update_fecha=NOW(),update_ip = ".fmt_string_sin_null($_SERVER['REMOTE_ADDR']).",update_usuario_id = ".fmt_num_sin_null($_SESSION['sess_usuario_id']).",".$campo. "=".(is_null($valor) ? 'null' : fmt_string_sin_null($valor))." where id = ".$this->id;
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;
    
}
    
    
function update() {
           global $cn; 
            
    //_________ Actualizo los Datos en la Tabla segun el ID ________
    
    
    $sql="UPDATE abike_noticias SET 
             id =  ".fmt_num_sin_null($this->id)."
             , update_ip = ".fmt_string_sin_null($_SERVER['REMOTE_ADDR'])."
             ,update_fecha =NOW() 
             , update_usuario_id = ".intval($_SESSION['sess_usuario_id'])."
             ,descripcion =  ".fmt_string_sin_null(($this->descripcion))."
             ,bajada =  ".fmt_string_sin_null(($this->bajada))."
             ,porcentaje =  ".fmt_string_sin_null(($this->porcentaje))."
             ,cuerpo =  ".fmt_textarea(($this->cuerpo))."
             ,fuente =  ".fmt_string_sin_null(($this->fuente))."
            WHERE id = ".fmt_num_sin_null($this->id);

    //_________ Ejecuto el Query ________
    
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;
            $log_obj= new log; $log_obj->add($sql,'abike_noticias-UPDATE','ID:'.$this->id);

} //de la fcion

function remove_imagen() {
           global $cn; 
            
    //_________ Actualizo los Datos en la Tabla segun el ID ________    
    
    $sql="UPDATE abike_noticias SET 
               update_ip = ".fmt_string_sin_null($_SERVER['REMOTE_ADDR'])."
             , update_fecha =NOW() 
             , update_usuario_id = ".intval($_SESSION['sess_usuario_id']);
    $sql.=   $this->imagen?", imagen = ''":"";
    $sql.=   $this->icono?", icono = ''":"";
    $sql.=   " WHERE id = ".fmt_num_sin_null($this->id);

    //_________ Ejecuto el Query ________
    
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;
            $log_obj= new log; $log_obj->add($sql,'abike_noticias-UPDATE','ID:'.$this->id);

} //de la fcion

function delete() {
           global $cn; 
    
    
    $sql="update abike_noticias set update_fecha=NOW(),update_ip= ".fmt_string_sin_null($_SERVER['REMOTE_ADDR']).",update_usuario_id= ".intval($_SESSION['sess_usuario_id']).",estado=2 Where id= ".fmt_string_sin_null($this->id);

        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;

            $log_obj= new log; $log_obj->add($sql,'abike_noticias-DELETE','ID:'.$this->id);

} //de la fcion

function cant_traer() {
           global $cn; 
          $sql= "SELECT COUNT(*) as cantidad_total 
          FROM abike_noticias
          WHERE  estado=1 and abike_noticias.id > 0 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and abike_noticias.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and abike_noticias.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and abike_noticias.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and abike_noticias.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and abike_noticias.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and abike_noticias.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and abike_noticias.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and abike_noticias.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->descripcion)!= '') {$sql.=" and abike_noticias.descripcion like " .fmt_string_sin_null("%".($this->descripcion)."%"); }
          if (trim($this->bajada)!= '') {$sql.=" and abike_noticias.bajada like " .fmt_string_sin_null("%".($this->bajada)."%"); }
          if (trim($this->porcentaje)!= '') {$sql.=" and abike_noticias.porcentaje like " .fmt_string_sin_null("%".($this->porcentaje)."%"); }
          if (trim($this->cuerpo)!= '') {$sql.=" and abike_noticias.cuerpo like '" .trim("%".($this->cuerpo)."%")."'"; }
          if (trim($this->imagen)!= '') {$sql.=" and abike_noticias.imagen like " .fmt_string_sin_null("%".($this->imagen)."%"); }
          if (trim($this->fuente)!= '') {$sql.=" and abike_noticias.fuente like " .fmt_string_sin_null("%".($this->fuente)."%"); }
          if (trim($this->icono)!= '') {$sql.=" and abike_noticias.icono like " .fmt_string_sin_null("%".($this->icono)."%"); }

        //Ejecuto la consulta 
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;

        if ($rows_cant != 0) {        
        $vec=$rs->fetch_assoc();
            $cant=$vec['cantidad_total']; 
        }else{ 
            $cant=0; 
       }
         @mysqli_free_result($rs); @mysqli_next_result($cn) ; // rs->free();
    return( $cant); 
}            

function existe() {
           global $cn; 
            
          $sql= "SELECT   abike_noticias.id
          FROM abike_noticias
          WHERE  abike_noticias.estado=1 and abike_noticias.id > 0 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and abike_noticias.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and abike_noticias.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and abike_noticias.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and abike_noticias.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and abike_noticias.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and abike_noticias.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and abike_noticias.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and abike_noticias.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->descripcion)!= '') {$sql.=" and abike_noticias.descripcion like " .fmt_string_sin_null("%".($this->descripcion)."%"); }
          if (trim($this->bajada)!= '') {$sql.=" and abike_noticias.bajada like " .fmt_string_sin_null("%".($this->bajada)."%"); }
          if (trim($this->porcentaje)!= '') {$sql.=" and abike_noticias.porcentaje like " .fmt_string_sin_null("%".($this->porcentaje)."%"); }
          if (trim($this->cuerpo)!= '') {$sql.=" and abike_noticias.cuerpo like '" .trim("%".($this->cuerpo)."%")."'"; }
          if (trim($this->imagen)!= '') {$sql.=" and abike_noticias.imagen like " .fmt_string_sin_null("%".($this->imagen)."%"); }
          if (trim($this->fuente)!= '') {$sql.=" and abike_noticias.fuente like " .fmt_string_sin_null("%".($this->fuente)."%"); }
          if (trim($this->icono)!= '') {$sql.=" and abike_noticias.icono like " .fmt_string_sin_null("%".($this->icono)."%"); }

        //Ejecuto la consulta 
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;

        if ($rows_cant != 0) {        
        $vec=$rs->fetch_assoc();
            $rta=$vec['id']; 
        }else{ 
            $rta=0; 
       }
         @mysqli_free_result($rs); @mysqli_next_result($cn) ; // rs->free();
    return( $rta); 
}            

function descripcion_traer() {
           global $cn; 
          $sql= "SELECT  abike_noticias.descripcion
          FROM abike_noticias
          WHERE  estado=1 and abike_noticias.id > 0 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and abike_noticias.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and abike_noticias.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and abike_noticias.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and abike_noticias.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and abike_noticias.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and abike_noticias.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and abike_noticias.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and abike_noticias.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->descripcion)!= '') {$sql.=" and abike_noticias.descripcion like " .fmt_string_sin_null("%".($this->descripcion)."%"); }
          if (trim($this->bajada)!= '') {$sql.=" and abike_noticias.bajada like " .fmt_string_sin_null("%".($this->bajada)."%"); }
          if (trim($this->porcentaje)!= '') {$sql.=" and abike_noticias.porcentaje like " .fmt_string_sin_null("%".($this->porcentaje)."%"); }
          if (trim($this->cuerpo)!= '') {$sql.=" and abike_noticias.cuerpo like '" .trim("%".($this->cuerpo)."%")."'"; }
          if (trim($this->imagen)!= '') {$sql.=" and abike_noticias.imagen like " .fmt_string_sin_null("%".($this->imagen)."%"); }
          if (trim($this->fuente)!= '') {$sql.=" and abike_noticias.fuente like " .fmt_string_sin_null("%".($this->fuente)."%"); }
          if (trim($this->icono)!= '') {$sql.=" and abike_noticias.icono like " .fmt_string_sin_null("%".($this->icono)."%"); }

        //Ejecuto la consulta 
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;

        if ($rows_cant != 0) {        
        $vec=$rs->fetch_assoc();
            $rta=$vec['descripcion']; 
        }else{ 
            $rta=''; 
       }
         @mysqli_free_result($rs); @mysqli_next_result($cn) ; // rs->free();
    return( $rta); 
}            

    
function traer($pagina=0,$pagina_cant=999999) {
           global $cn; 
            
            $pagina_cant = intval($pagina_cant);
            $pagina = intval($pagina);
            
    //_________ Traigo los datos segun los parámetros ingresados ________
    
    $sql="SELECT 
             abike_noticias.id
             ,abike_noticias.estado
             ,abike_noticias.alta_ip
             ,abike_noticias.update_ip
             ,abike_noticias.alta_fecha
             ,abike_noticias.alta_usuario_id
             ,abike_noticias.update_fecha
             ,abike_noticias.update_usuario_id
             ,abike_noticias.descripcion
             ,abike_noticias.bajada
             ,abike_noticias.porcentaje
             ,abike_noticias.cuerpo
             ,abike_noticias.imagen
             ,abike_noticias.fuente
             ,abike_noticias.icono
          FROM abike_noticias
          WHERE abike_noticias.id > 0  and  abike_noticias.estado=1 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and abike_noticias.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and abike_noticias.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and abike_noticias.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and abike_noticias.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and abike_noticias.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and abike_noticias.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and abike_noticias.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and abike_noticias.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->descripcion)!= '') {$sql.=" and abike_noticias.descripcion like " .fmt_string_sin_null("%".($this->descripcion)."%"); }
          if (trim($this->bajada)!= '') {$sql.=" and abike_noticias.bajada like " .fmt_string_sin_null("%".($this->bajada)."%"); }
          if (trim($this->porcentaje)!= '') {$sql.=" and abike_noticias.porcentaje like " .fmt_string_sin_null("%".($this->porcentaje)."%"); }
          if (trim($this->cuerpo)!= '') {$sql.=" and abike_noticias.cuerpo like '" .trim("%".($this->cuerpo)."%")."'"; }
          if (trim($this->imagen)!= '') {$sql.=" and abike_noticias.imagen like " .fmt_string_sin_null("%".($this->imagen)."%"); }
          if (trim($this->fuente)!= '') {$sql.=" and abike_noticias.fuente like " .fmt_string_sin_null("%".($this->fuente)."%"); }
          if (trim($this->icono)!= '') {$sql.=" and abike_noticias.icono like " .fmt_string_sin_null("%".($this->icono)."%"); }

      $sql.=' order by descripcion'; 
      if (($pagina_cant != 0) && ($pagina_cant != 999999)) $sql.=" LIMIT ".($pagina*$pagina_cant).",".$pagina_cant; 

        //Ejecuto la consulta 
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;

        $this->resultados_vec=array();

        //Recorro los campos
        $i = 0;
        if ($rows_cant != 0) {        
        while ($row=$rs->fetch_row()) {
               $this->resultados_vec[$i]['id'] = intval($row [0]);
               $this->resultados_vec[$i]['estado'] = intval($row [1]);
               $this->resultados_vec[$i]['alta_ip'] = htmlspecialchars_decode( stripslashes($row [2]));
               $this->resultados_vec[$i]['update_ip'] = htmlspecialchars_decode( stripslashes($row [3]));
                    $this->resultados_vec[$i]['alta_fecha'] = left(fecha_desde_sql($row [4]),10);
               $this->resultados_vec[$i]['alta_usuario_id'] = intval($row [5]);
                    $this->resultados_vec[$i]['update_fecha'] = left(fecha_desde_sql($row [6]),10);
               $this->resultados_vec[$i]['update_usuario_id'] = intval($row [7]);
               $this->resultados_vec[$i]['descripcion'] = htmlspecialchars_decode( stripslashes($row [8]));
               $this->resultados_vec[$i]['bajada'] = htmlspecialchars_decode( stripslashes($row [9]));
               $this->resultados_vec[$i]['porcentaje'] = htmlspecialchars_decode( stripslashes($row [10]));
               $this->resultados_vec[$i]['cuerpo'] = stripslashes((trim($row [11])));
               $this->resultados_vec[$i]['imagen'] = htmlspecialchars_decode( stripslashes($row [12]));
               $this->resultados_vec[$i]['fuente'] = htmlspecialchars_decode( stripslashes($row [13]));
               $this->resultados_vec[$i]['icono'] = htmlspecialchars_decode( stripslashes($row [14]));
               $i++;
            } //del while de si trajo registros


          // Asigno a las variables el primer resultado
          $this->id = $this->resultados_vec[0]['id'];
          $this->estado = $this->resultados_vec[0]['estado'];
          $this->alta_ip = $this->resultados_vec[0]['alta_ip'];
          $this->update_ip = $this->resultados_vec[0]['update_ip'];
          $this->alta_fecha = $this->resultados_vec[0]['alta_fecha'];
          $this->alta_usuario_id = $this->resultados_vec[0]['alta_usuario_id'];
          $this->update_fecha = $this->resultados_vec[0]['update_fecha'];
          $this->update_usuario_id = $this->resultados_vec[0]['update_usuario_id'];
          $this->descripcion = $this->resultados_vec[0]['descripcion'];
          $this->bajada = $this->resultados_vec[0]['bajada'];
          $this->porcentaje = $this->resultados_vec[0]['porcentaje'];
          $this->cuerpo = $this->resultados_vec[0]['cuerpo'];
          $this->imagen = $this->resultados_vec[0]['imagen'];
          $this->fuente = $this->resultados_vec[0]['fuente'];
          $this->icono = $this->resultados_vec[0]['icono'];
        } //del If de si trajo registros

         @mysqli_free_result($rs); @mysqli_next_result($cn) ; // rs->free();
} //de la fcion
 
} //de la clase
 
?>
