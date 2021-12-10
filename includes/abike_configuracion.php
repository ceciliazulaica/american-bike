<?
    
    /* --------------------------------------------------
          Libreria Desarrollada por Veronica Osorio para Vousys Consulting - www.vousys.com
                    info@vousys.com
       -------------------------------------------------- */
    
    
    
    
class abike_configuracion{
    
        //defino las variables de la clase 
          var $id;
          var $estado;
          var $alta_ip;
          var $update_ip;
          var $alta_fecha;
          var $alta_usuario_id;
          var $update_fecha;
          var $update_usuario_id;
          var $frase_top;
          var $direccion;
          var $telefono;
          var $email;
          var $contacto_email;
          var $contacto_texto;
          var $frase_slide_1_1;
          var $frase_slide_1_2;
          var $frase_slide_2_1;
          var $frase_slide_2_2;
          var $frase_slide_3_1;
          var $frase_slide_3_2;
          var $frase_slide_3_3;
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
          $this->frase_top='';
          $this->direccion='';
          $this->telefono='';
          $this->email='';
          $this->contacto_email='';
          $this->contacto_texto='';
          $this->frase_slide_1_1='';
          $this->frase_slide_1_2='';
          $this->frase_slide_2_1='';
          $this->frase_slide_2_2='';
          $this->frase_slide_3_1='';
          $this->frase_slide_3_2='';
          $this->frase_slide_3_3='';
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
        $archivo_id=numeracion_traer('abike_configuracion_img'); //Creo el nuevo nombre de la foto;
        if (is_uploaded_file($_FILES[$campo_form]['tmp_name'])) {
                $ext = pathinfo($_FILES[$campo_form]['name'], PATHINFO_EXTENSION);
                $name = strtolower( urls_formatear(str_replace('.'.$ext,'',$_FILES[$campo_form]['name'])));
                $file_nuevo ='images/_configuracion/'.$id.rand().'_'.$archivo_id.'_'. $name.'.'. $ext;
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
    //$this->id=numeracion_traer("abike_configuracion");
    
    //_________ Inserto ________
    
    $sql="insert into abike_configuracion( 
             estado
             ,alta_ip
             ,alta_fecha
             ,alta_usuario_id
             ,frase_top
             ,direccion
             ,telefono
             ,email
             ,contacto_email
             ,contacto_texto
             ,frase_slide_1_1
             ,frase_slide_1_2
             ,frase_slide_2_1
             ,frase_slide_2_2
             ,frase_slide_3_1
             ,frase_slide_3_2
             ,frase_slide_3_3
            )
            
            VALUES ( 
              ".ESTADO_ACTIVO."
             , ".fmt_string_sin_null($_SERVER['REMOTE_ADDR'])."
             , NOW() 
             , ".intval($_SESSION['sess_usuario_id'])."
             ,  ".fmt_string_sin_null(($this->frase_top))."
             ,  ".fmt_string_sin_null(($this->direccion))."
             ,  ".fmt_string_sin_null(($this->telefono))."
             ,  ".fmt_string_sin_null(($this->email))."
             ,  ".fmt_string_sin_null(($this->contacto_email))."
             ,  ".fmt_textarea($this->contacto_texto)."
             ,  ".fmt_string_sin_null($this->frase_slide_1_1)."
             ,  ".fmt_string_sin_null($this->frase_slide_1_2)."
             ,  ".fmt_string_sin_null($this->frase_slide_2_1)."
             ,  ".fmt_string_sin_null($this->frase_slide_2_2)."
             ,  ".fmt_string_sin_null($this->frase_slide_3_1)."
             ,  ".fmt_string_sin_null($this->frase_slide_3_2)."
             ,  ".fmt_string_sin_null($this->frase_slide_3_3)."
        )";
    
    //_________ Ejecuto el Query ________
    
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;
    
    
    $this->id=$cn->insert_id;
    
            $log_obj= new log; $log_obj->add($sql,'abike_configuracion-ADD','ID:'.$this->id);

        return($this->id);
} //de la fcion

    
function campo_update($campo,$valor) {
    
           global $cn; 
    
    // actualiza un solo campo
    $sql="UPDATE abike_configuracion SET update_fecha=NOW(),update_ip = ".fmt_string_sin_null($_SERVER['REMOTE_ADDR']).",update_usuario_id = ".fmt_num_sin_null($_SESSION['sess_usuario_id']).",".$campo. "=".(is_null($valor) ? 'null' : fmt_string_sin_null($valor))." where id = ".$this->id;
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;
    
}
    
    
function update() {
           global $cn; 
            
    //_________ Actualizo los Datos en la Tabla segun el ID ________
    
    
    $sql="UPDATE abike_configuracion SET 
             id =  ".fmt_num_sin_null($this->id)."
             , update_ip = ".fmt_string_sin_null($_SERVER['REMOTE_ADDR'])."
             ,update_fecha =NOW() 
             , update_usuario_id = ".intval($_SESSION['sess_usuario_id'])."
             ,frase_top =  ".fmt_string_sin_null(($this->frase_top))."
             ,direccion =  ".fmt_string_sin_null(($this->direccion))."
             ,telefono =  ".fmt_string_sin_null(($this->telefono))."
             ,email =  ".fmt_string_sin_null(($this->email))."
             ,contacto_email =  ".fmt_string_sin_null(($this->contacto_email))."
             ,contacto_texto =  ".fmt_textarea(($this->contacto_texto))."
             ,frase_slide_1_1 = ".fmt_string_sin_null($this->frase_slide_1_1)."
             ,frase_slide_1_2 = ".fmt_string_sin_null($this->frase_slide_1_2)."
             ,frase_slide_2_1 = ".fmt_string_sin_null($this->frase_slide_2_1)."
             ,frase_slide_2_2 = ".fmt_string_sin_null($this->frase_slide_2_2)."
             ,frase_slide_3_1 = ".fmt_string_sin_null($this->frase_slide_3_1)."
             ,frase_slide_3_2 = ".fmt_string_sin_null($this->frase_slide_3_2)."
             ,frase_slide_3_3 = ".fmt_string_sin_null($this->frase_slide_3_3)."
             WHERE id = ".fmt_num_sin_null($this->id);

    //_________ Ejecuto el Query ________
    
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;
            $log_obj= new log; $log_obj->add($sql,'abike_configuracion-UPDATE','ID:'.$this->id);

} //de la fcion

    
function delete() {
           global $cn; 
    
    
    $sql="update abike_configuracion set update_fecha=NOW(),update_ip= ".fmt_string_sin_null($_SERVER['REMOTE_ADDR']).",update_usuario_id= ".intval($_SESSION['sess_usuario_id']).",estado=2 Where id= ".fmt_string_sin_null($this->id);

        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;

            $log_obj= new log; $log_obj->add($sql,'abike_configuracion-DELETE','ID:'.$this->id);

} //de la fcion

function cant_traer() {
           global $cn; 
          $sql= "SELECT COUNT(*) as cantidad_total 
          FROM abike_configuracion
          WHERE  estado=1 and abike_configuracion.id > 0 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and abike_configuracion.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and abike_configuracion.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and abike_configuracion.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and abike_configuracion.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and abike_configuracion.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and abike_configuracion.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and abike_configuracion.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and abike_configuracion.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->frase_top)!= '') {$sql.=" and abike_configuracion.frase_top like " .fmt_string_sin_null("%".($this->frase_top)."%"); }
          if (trim($this->direccion)!= '') {$sql.=" and abike_configuracion.direccion like " .fmt_string_sin_null("%".($this->direccion)."%"); }
          if (trim($this->telefono)!= '') {$sql.=" and abike_configuracion.telefono like " .fmt_string_sin_null("%".($this->telefono)."%"); }
          if (trim($this->email)!= '') {$sql.=" and abike_configuracion.email like " .fmt_string_sin_null("%".($this->email)."%"); }
          if (trim($this->contacto_email)!= '') {$sql.=" and abike_configuracion.contacto_email like " .fmt_string_sin_null("%".($this->contacto_email)."%"); }
          if (trim($this->contacto_texto)!= '') {$sql.=" and abike_configuracion.contacto_texto like '" .trim("%".($this->contacto_texto)."%")."'"; }
          if (trim($this->frase_slide_1_1)!= '') {$sql.=" and abike_configuracion.frase_slide_1_1 like " .fmt_string_sin_null("%".($this->frase_slide_1_1)."%"); }
          if (trim($this->frase_slide_1_2)!= '') {$sql.=" and abike_configuracion.frase_slide_1_2 like " .fmt_string_sin_null("%".($this->frase_slide_1_2)."%"); }
          if (trim($this->frase_slide_2_1)!= '') {$sql.=" and abike_configuracion.frase_slide_2_1 like " .fmt_string_sin_null("%".($this->frase_slide_2_1)."%"); }
          if (trim($this->frase_slide_2_2)!= '') {$sql.=" and abike_configuracion.frase_slide_2_2 like " .fmt_string_sin_null("%".($this->frase_slide_2_2)."%"); }
          if (trim($this->frase_slide_3_1)!= '') {$sql.=" and abike_configuracion.frase_slide_3_1 like " .fmt_string_sin_null("%".($this->frase_slide_3_1)."%"); }
          if (trim($this->frase_slide_3_2)!= '') {$sql.=" and abike_configuracion.frase_slide_3_2 like " .fmt_string_sin_null("%".($this->frase_slide_3_2)."%"); }
          if (trim($this->frase_slide_3_3)!= '') {$sql.=" and abike_configuracion.frase_slide_3_3 like " .fmt_string_sin_null("%".($this->frase_slide_3_3)."%"); }

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
            
          $sql= "SELECT   abike_configuracion.id
          FROM abike_configuracion
          WHERE  abike_configuracion.estado=1 and abike_configuracion.id > 0 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and abike_configuracion.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and abike_configuracion.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and abike_configuracion.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and abike_configuracion.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and abike_configuracion.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and abike_configuracion.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and abike_configuracion.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and abike_configuracion.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->frase_top)!= '') {$sql.=" and abike_configuracion.frase_top like " .fmt_string_sin_null("%".($this->frase_top)."%"); }
          if (trim($this->direccion)!= '') {$sql.=" and abike_configuracion.direccion like " .fmt_string_sin_null("%".($this->direccion)."%"); }
          if (trim($this->telefono)!= '') {$sql.=" and abike_configuracion.telefono like " .fmt_string_sin_null("%".($this->telefono)."%"); }
          if (trim($this->email)!= '') {$sql.=" and abike_configuracion.email like " .fmt_string_sin_null("%".($this->email)."%"); }
          if (trim($this->contacto_email)!= '') {$sql.=" and abike_configuracion.contacto_email like " .fmt_string_sin_null("%".($this->contacto_email)."%"); }
          if (trim($this->contacto_texto)!= '') {$sql.=" and abike_configuracion.contacto_texto like '" .trim("%".($this->contacto_texto)."%")."'"; }
          if (trim($this->frase_slide_1_1)!= '') {$sql.=" and abike_configuracion.frase_slide_1_1 like " .fmt_string_sin_null("%".($this->frase_slide_1_1)."%"); }
          if (trim($this->frase_slide_1_2)!= '') {$sql.=" and abike_configuracion.frase_slide_1_2 like " .fmt_string_sin_null("%".($this->frase_slide_1_2)."%"); }
          if (trim($this->frase_slide_2_1)!= '') {$sql.=" and abike_configuracion.frase_slide_2_1 like " .fmt_string_sin_null("%".($this->frase_slide_2_1)."%"); }
          if (trim($this->frase_slide_2_2)!= '') {$sql.=" and abike_configuracion.frase_slide_2_2 like " .fmt_string_sin_null("%".($this->frase_slide_2_2)."%"); }
          if (trim($this->frase_slide_3_1)!= '') {$sql.=" and abike_configuracion.frase_slide_3_1 like " .fmt_string_sin_null("%".($this->frase_slide_3_1)."%"); }
          if (trim($this->frase_slide_3_2)!= '') {$sql.=" and abike_configuracion.frase_slide_3_2 like " .fmt_string_sin_null("%".($this->frase_slide_3_2)."%"); }
          if (trim($this->frase_slide_3_3)!= '') {$sql.=" and abike_configuracion.frase_slide_3_3 like " .fmt_string_sin_null("%".($this->frase_slide_3_3)."%"); }

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
          $sql= "SELECT  abike_configuracion.descripcion
          FROM abike_configuracion
          WHERE  estado=1 and abike_configuracion.id > 0 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and abike_configuracion.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and abike_configuracion.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and abike_configuracion.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and abike_configuracion.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and abike_configuracion.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and abike_configuracion.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and abike_configuracion.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and abike_configuracion.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->frase_top)!= '') {$sql.=" and abike_configuracion.frase_top like " .fmt_string_sin_null("%".($this->frase_top)."%"); }
          if (trim($this->direccion)!= '') {$sql.=" and abike_configuracion.direccion like " .fmt_string_sin_null("%".($this->direccion)."%"); }
          if (trim($this->telefono)!= '') {$sql.=" and abike_configuracion.telefono like " .fmt_string_sin_null("%".($this->telefono)."%"); }
          if (trim($this->email)!= '') {$sql.=" and abike_configuracion.email like " .fmt_string_sin_null("%".($this->email)."%"); }
          if (trim($this->contacto_email)!= '') {$sql.=" and abike_configuracion.contacto_email like " .fmt_string_sin_null("%".($this->contacto_email)."%"); }
          if (trim($this->contacto_texto)!= '') {$sql.=" and abike_configuracion.contacto_texto like '" .trim("%".($this->contacto_texto)."%")."'"; }
          if (trim($this->frase_slide_1_1)!= '') {$sql.=" and abike_configuracion.frase_slide_1_1 like " .fmt_string_sin_null("%".($this->frase_slide_1_1)."%"); }
          if (trim($this->frase_slide_1_2)!= '') {$sql.=" and abike_configuracion.frase_slide_1_2 like " .fmt_string_sin_null("%".($this->frase_slide_1_2)."%"); }
          if (trim($this->frase_slide_2_1)!= '') {$sql.=" and abike_configuracion.frase_slide_2_1 like " .fmt_string_sin_null("%".($this->frase_slide_2_1)."%"); }
          if (trim($this->frase_slide_2_2)!= '') {$sql.=" and abike_configuracion.frase_slide_2_2 like " .fmt_string_sin_null("%".($this->frase_slide_2_2)."%"); }
          if (trim($this->frase_slide_3_1)!= '') {$sql.=" and abike_configuracion.frase_slide_3_1 like " .fmt_string_sin_null("%".($this->frase_slide_3_1)."%"); }
          if (trim($this->frase_slide_3_2)!= '') {$sql.=" and abike_configuracion.frase_slide_3_2 like " .fmt_string_sin_null("%".($this->frase_slide_3_2)."%"); }
          if (trim($this->frase_slide_3_3)!= '') {$sql.=" and abike_configuracion.frase_slide_3_3 like " .fmt_string_sin_null("%".($this->frase_slide_3_3)."%"); }

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
             abike_configuracion.id
             ,abike_configuracion.estado
             ,abike_configuracion.alta_ip
             ,abike_configuracion.update_ip
             ,abike_configuracion.alta_fecha
             ,abike_configuracion.alta_usuario_id
             ,abike_configuracion.update_fecha
             ,abike_configuracion.update_usuario_id
             ,abike_configuracion.frase_top
             ,abike_configuracion.direccion
             ,abike_configuracion.telefono
             ,abike_configuracion.email
             ,abike_configuracion.contacto_email
             ,abike_configuracion.contacto_texto
             ,abike_configuracion.frase_slide_1_1
             ,abike_configuracion.frase_slide_1_2
             ,abike_configuracion.frase_slide_2_1
             ,abike_configuracion.frase_slide_2_2
             ,abike_configuracion.frase_slide_3_1
             ,abike_configuracion.frase_slide_3_2
             ,abike_configuracion.frase_slide_3_3
          FROM abike_configuracion
          WHERE abike_configuracion.id > 0  and  abike_configuracion.estado=1 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and abike_configuracion.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and abike_configuracion.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and abike_configuracion.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and abike_configuracion.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and abike_configuracion.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and abike_configuracion.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and abike_configuracion.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and abike_configuracion.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->frase_top)!= '') {$sql.=" and abike_configuracion.frase_top like " .fmt_string_sin_null("%".($this->frase_top)."%"); }
          if (trim($this->direccion)!= '') {$sql.=" and abike_configuracion.direccion like " .fmt_string_sin_null("%".($this->direccion)."%"); }
          if (trim($this->telefono)!= '') {$sql.=" and abike_configuracion.telefono like " .fmt_string_sin_null("%".($this->telefono)."%"); }
          if (trim($this->email)!= '') {$sql.=" and abike_configuracion.email like " .fmt_string_sin_null("%".($this->email)."%"); }
          if (trim($this->contacto_email)!= '') {$sql.=" and abike_configuracion.contacto_email like " .fmt_string_sin_null("%".($this->contacto_email)."%"); }
          if (trim($this->contacto_texto)!= '') {$sql.=" and abike_configuracion.contacto_texto like '" .trim("%".($this->contacto_texto)."%")."'"; }
          if (trim($this->frase_slide_1_1)!= '') {$sql.=" and abike_configuracion.frase_slide_1_1 like " .fmt_string_sin_null("%".($this->frase_slide_1_1)."%"); }
          if (trim($this->frase_slide_1_2)!= '') {$sql.=" and abike_configuracion.frase_slide_1_2 like " .fmt_string_sin_null("%".($this->frase_slide_1_2)."%"); }
          if (trim($this->frase_slide_2_1)!= '') {$sql.=" and abike_configuracion.frase_slide_2_1 like " .fmt_string_sin_null("%".($this->frase_slide_2_1)."%"); }
          if (trim($this->frase_slide_2_2)!= '') {$sql.=" and abike_configuracion.frase_slide_2_2 like " .fmt_string_sin_null("%".($this->frase_slide_2_2)."%"); }
          if (trim($this->frase_slide_3_1)!= '') {$sql.=" and abike_configuracion.frase_slide_3_1 like " .fmt_string_sin_null("%".($this->frase_slide_3_1)."%"); }
          if (trim($this->frase_slide_3_2)!= '') {$sql.=" and abike_configuracion.frase_slide_3_2 like " .fmt_string_sin_null("%".($this->frase_slide_3_2)."%"); }
          if (trim($this->frase_slide_3_3)!= '') {$sql.=" and abike_configuracion.frase_slide_3_3 like " .fmt_string_sin_null("%".($this->frase_slide_3_3)."%"); }
 
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
               $this->resultados_vec[$i]['frase_top'] = htmlspecialchars_decode( stripslashes($row [8]));
               $this->resultados_vec[$i]['direccion'] = htmlspecialchars_decode( stripslashes($row [9]));
               $this->resultados_vec[$i]['telefono'] = htmlspecialchars_decode( stripslashes($row [10]));
               $this->resultados_vec[$i]['email'] = htmlspecialchars_decode( stripslashes($row [11]));
               $this->resultados_vec[$i]['contacto_email'] = htmlspecialchars_decode( stripslashes($row [12]));
               $this->resultados_vec[$i]['contacto_texto'] = stripslashes((trim($row [13])));
               $this->resultados_vec[$i]['frase_slide_1_1'] = htmlspecialchars_decode(stripslashes($row[14]));
               $this->resultados_vec[$i]['frase_slide_1_2'] = htmlspecialchars_decode(stripslashes($row[15]));
               $this->resultados_vec[$i]['frase_slide_2_1'] = htmlspecialchars_decode(stripslashes($row[16]));
               $this->resultados_vec[$i]['frase_slide_2_2'] = htmlspecialchars_decode(stripslashes($row[17]));
               $this->resultados_vec[$i]['frase_slide_3_1'] = htmlspecialchars_decode(stripslashes($row[18]));
               $this->resultados_vec[$i]['frase_slide_3_2'] = htmlspecialchars_decode(stripslashes($row[19]));
               $this->resultados_vec[$i]['frase_slide_3_3'] = htmlspecialchars_decode(stripslashes($row[20]));
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
          $this->frase_top = $this->resultados_vec[0]['frase_top'];
          $this->direccion = $this->resultados_vec[0]['direccion'];
          $this->telefono = $this->resultados_vec[0]['telefono'];
          $this->email = $this->resultados_vec[0]['email'];
          $this->contacto_email = $this->resultados_vec[0]['contacto_email'];
          $this->contacto_texto = $this->resultados_vec[0]['contacto_texto'];
          $this->frase_slide_1_1 = $this->resultados_vec[0]['frase_slide_1_1'];
          $this->frase_slide_1_2 = $this->resultados_vec[0]['frase_slide_1_2'];
          $this->frase_slide_2_1 = $this->resultados_vec[0]['frase_slide_2_1'];
          $this->frase_slide_2_2 = $this->resultados_vec[0]['frase_slide_2_2'];
          $this->frase_slide_3_1 = $this->resultados_vec[0]['frase_slide_3_1'];
          $this->frase_slide_3_2 = $this->resultados_vec[0]['frase_slide_3_2'];
          $this->frase_slide_3_3 = $this->resultados_vec[0]['frase_slide_3_3'];
        } //del If de si trajo registros

         @mysqli_free_result($rs); @mysqli_next_result($cn) ; // rs->free();
} //de la fcion
 
} //de la clase
 
?>
