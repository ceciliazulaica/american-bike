<?
    
    /* --------------------------------------------------
          Libreria Desarrollada por Veronica Osorio para Vousys Consulting - www.vousys.com
                    info@vousys.com
       -------------------------------------------------- */
    
    
    
    
class usuarios{
    
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
          var $legajo;
          var $email;
          var $pwd;
          var $perfil_id;
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
          $this->legajo='';
          $this->email='';
          $this->pwd='';
          $this->perfil_id='';
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
   return ($rta);
} //fcion
function imagenes_subir($campo_form,$id){
    
   //Sube la imagen 
    
    if (trim($_FILES[$campo_form]['name']) != '') {
        $archivo_id=numeracion_traer('usuarios_img'); //Creo el nuevo nombre de la foto;
        if (is_uploaded_file($_FILES[$campo_form]['tmp_name'])) {
                $file_nuevo ='images/_usuarios/'.$id.rand().'_'.$archivo_id.'_'. strtolower( urls_formatear(left($_FILES[$campo_form]['name'],strlen($_FILES[$campo_form]['name'])-4)). right($_FILES[$campo_form]['name'],4));
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
    //$this->id=numeracion_traer("usuarios");
    
    if (intval($this->perfil_id)==0) $this->perfil_id = 1;
    
    //_________ Inserto ________
    
    $sql="insert into usuarios( 
             estado
             ,alta_ip
             ,alta_fecha
             ,alta_usuario_id
             ,descripcion
             ,legajo
             ,email
             ,pwd
             ,perfil_id
            )
            
            VALUES ( 
              ".ESTADO_ACTIVO."
             , ".fmt_string_sin_null($_SERVER['REMOTE_ADDR'])."
             , NOW() 
             , ".intval($_SESSION['sess_usuario_id'])."
             ,  ".fmt_string_sin_null(($this->descripcion))."
             ,  ".fmt_string_sin_null(($this->legajo))."
             ,  ".fmt_string_sin_null(($this->email))."
             ,  ".fmt_string_sin_null(md5($this->pwd))."
             ,  ".fmt_string_sin_null(($this->perfil_id))."
        )";
    
    //_________ Ejecuto el Query ________
    
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;
    
    
    $this->id=$cn->insert_id;
    
            $log_obj= new log; $log_obj->add($sql,'usuarios-ADD','ID:'.$this->id);

        return($this->id);
} //de la fcion

    
function campo_update($campo,$valor) {
    
           global $cn; 
    
    // actualiza un solo campo
    $sql="UPDATE usuarios SET update_fecha=NOW(),update_ip = ".fmt_string_sin_null($_SERVER['REMOTE_ADDR']).",update_usuario_id = ".fmt_num_sin_null($_SESSION['sess_usuario_id']).",".$campo. "=".fmt_string_sin_null($valor)." where id = ".$this->id;
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;
    
}
    
    
function update() {
           global $cn; 
            
    //_________ Actualizo los Datos en la Tabla segun el ID ________
    
    
    $sql="UPDATE usuarios SET 
             id =  ".fmt_num_sin_null($this->id)."
             , update_ip = ".fmt_string_sin_null($_SERVER['REMOTE_ADDR'])."
             ,update_fecha =NOW() 
             , update_usuario_id = ".intval($_SESSION['sess_usuario_id'])."
             ,descripcion =  ".fmt_string_sin_null(($this->descripcion))."
             ,legajo =  ".fmt_string_sin_null(($this->legajo))."
             ,email =  ".fmt_string_sin_null(($this->email))."
             ,perfil_id =  ".fmt_string_sin_null(($this->perfil_id));
             if (trim($this->pwd) != '') { // el dato de contraseña se actualiza solo si se ingresó el dato
                $sql.=",pwd =  ".fmt_string_sin_null(md5($this->pwd));
             }
    $sql.="  WHERE id = ".fmt_num_sin_null($this->id);

    //_________ Ejecuto el Query ________
    
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;
            $log_obj= new log; $log_obj->add($sql,'usuarios-UPDATE','ID:'.$this->id);

} //de la fcion


function updatePassword() {
           global $cn; 
            
    //_________ Actualizo los Datos de la Pwden la Tabla segun el ID ________
    
    
    $sql="UPDATE usuarios SET 
             id =  ".fmt_num_sin_null($this->id)."
             , update_ip = ".fmt_string_sin_null($_SERVER['REMOTE_ADDR'])."
             ,update_fecha =NOW() 
             , update_usuario_id = ".intval($_SESSION['sess_usuario_id'])."
             ,pwd =  ".fmt_string_sin_null(md5($this->pwd))."
             WHERE id = ".fmt_num_sin_null($this->id);

    //_________ Ejecuto el Query ________
    
        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;
            $log_obj= new log; $log_obj->add($sql,'usuarios-UPDATE','ID:'.$this->id);

} //de la fcion

function delete() {
           global $cn; 
    
    
    $sql="update usuarios set update_fecha=NOW(),update_ip= ".fmt_string_sin_null($_SERVER['REMOTE_ADDR']).",update_usuario_id= ".intval($_SESSION['sess_usuario_id']).",estado=2 Where id= ".fmt_string_sin_null($this->id);

        if(!$rs = $cn->query($sql)) die(debug(  $cn->error , $sql, $this));  $rows_cant = $rs->num_rows;

            $log_obj= new log; $log_obj->add($sql,'usuarios-DELETE','ID:'.$this->id);

} //de la fcion

function cant_traer() {
           global $cn; 
          $sql= "SELECT COUNT(*) as cantidad_total 
          FROM usuarios
          WHERE  estado=1 and usuarios.id > 0 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and usuarios.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and usuarios.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and usuarios.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and usuarios.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and usuarios.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and usuarios.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and usuarios.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and usuarios.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->descripcion)!= '') {$sql.=" and usuarios.descripcion like " .fmt_string_sin_null("%".($this->descripcion)."%"); }
          if (trim($this->legajo)!= '') {$sql.=" and usuarios.legajo like " .fmt_string_sin_null("%".($this->legajo)."%"); }
          if (trim($this->email)!= '') {$sql.=" and usuarios.email = " .fmt_string_sin_null( ($this->email) ); }
          if (trim($this->pwd)!= '') {$sql.=" and usuarios.pwd = " .fmt_string_sin_null( ($this->pwd) ); }
          if (trim($this->perfil_id)!= '') {$sql.=" and usuarios.perfil_id like " .fmt_string_sin_null("%".($this->perfil_id)."%"); }

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
            
          $sql= "SELECT   usuarios.id
          FROM usuarios
          WHERE  usuarios.estado=1 and usuarios.id > 0 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and usuarios.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and usuarios.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and usuarios.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and usuarios.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and usuarios.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and usuarios.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and usuarios.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and usuarios.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->descripcion)!= '') {$sql.=" and usuarios.descripcion like " .fmt_string_sin_null("%".($this->descripcion)."%"); }
          if (trim($this->legajo)!= '') {$sql.=" and usuarios.legajo like " .fmt_string_sin_null("%".($this->legajo)."%"); }
          if (trim($this->email)!= '') {$sql.=" and usuarios.email = " .fmt_string_sin_null( ($this->email) ); }
          if (trim($this->pwd)!= '') {$sql.=" and usuarios.pwd = " .fmt_string_sin_null( ($this->pwd) ); }
          if (trim($this->perfil_id)!= '') {$sql.=" and usuarios.perfil_id like " .fmt_string_sin_null("%".($this->perfil_id)."%"); }

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
          $sql= "SELECT  usuarios.descripcion
          FROM usuarios
          WHERE  estado=1 and usuarios.id > 0 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and usuarios.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and usuarios.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and usuarios.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and usuarios.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and usuarios.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and usuarios.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and usuarios.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and usuarios.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->descripcion)!= '') {$sql.=" and usuarios.descripcion like " .fmt_string_sin_null("%".($this->descripcion)."%"); }
          if (trim($this->legajo)!= '') {$sql.=" and usuarios.legajo like " .fmt_string_sin_null("%".($this->legajo)."%"); }
          if (trim($this->email)!= '') {$sql.=" and usuarios.email = " .fmt_string_sin_null( ($this->email) ); }
          if (trim($this->pwd)!= '') {$sql.=" and usuarios.pwd = " .fmt_string_sin_null( ($this->pwd) ); }
          if (trim($this->perfil_id)!= '') {$sql.=" and usuarios.perfil_id like " .fmt_string_sin_null("%".($this->perfil_id)."%"); }

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
             usuarios.id
             ,usuarios.estado
             ,usuarios.alta_ip
             ,usuarios.update_ip
             ,usuarios.alta_fecha
             ,usuarios.alta_usuario_id
             ,usuarios.update_fecha
             ,usuarios.update_usuario_id
             ,usuarios.descripcion
             ,usuarios.legajo
             ,usuarios.email
             ,usuarios.pwd
             ,usuarios.perfil_id
          FROM usuarios
          WHERE usuarios.id > 0  and  usuarios.estado=1 
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and usuarios.id = " .fmt_num_sin_null($this->id); }
          if (intval(trim($this->estado))!= 0) {$sql.=" and usuarios.estado = " .fmt_num_sin_null($this->estado); }
          if (trim($this->alta_ip)!= '') {$sql.=" and usuarios.alta_ip like " .fmt_string_sin_null("%".($this->alta_ip)."%"); }
          if (trim($this->update_ip)!= '') {$sql.=" and usuarios.update_ip like " .fmt_string_sin_null("%".($this->update_ip)."%"); }
          if (is_date($this->alta_fecha)) {$sql.=" and usuarios.alta_fecha = " .fmt_fecha($this->alta_fecha); }
          if (intval(trim($this->alta_usuario_id))!= 0) {$sql.=" and usuarios.alta_usuario_id = " .fmt_num_sin_null($this->alta_usuario_id); }
          if (is_date($this->update_fecha)) {$sql.=" and usuarios.update_fecha = " .fmt_fecha($this->update_fecha); }
          if (intval(trim($this->update_usuario_id))!= 0) {$sql.=" and usuarios.update_usuario_id = " .fmt_num_sin_null($this->update_usuario_id); }
          if (trim($this->descripcion)!= '') {$sql.=" and usuarios.descripcion like " .fmt_string_sin_null("%".($this->descripcion)."%"); }
          if (trim($this->legajo)!= '') {$sql.=" and usuarios.legajo like " .fmt_string_sin_null("%".($this->legajo)."%"); }
          if (trim($this->email)!= '') {$sql.=" and usuarios.email = " .fmt_string_sin_null( ($this->email) ); }
          if (trim($this->pwd)!= '') {$sql.=" and usuarios.pwd = " .fmt_string_sin_null( ($this->pwd) ); }
          if (trim($this->perfil_id)!= '') {$sql.=" and usuarios.perfil_id like " .fmt_string_sin_null("%".($this->perfil_id)."%"); }

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
               $this->resultados_vec[$i]['alta_ip'] = htmlspecialchars_decode( trim($row [2]));
               $this->resultados_vec[$i]['update_ip'] = htmlspecialchars_decode( trim($row [3]));
                    $this->resultados_vec[$i]['alta_fecha'] = left(fecha_desde_sql($row [4]),10);
               $this->resultados_vec[$i]['alta_usuario_id'] = intval($row [5]);
                    $this->resultados_vec[$i]['update_fecha'] = left(fecha_desde_sql($row [6]),10);
               $this->resultados_vec[$i]['update_usuario_id'] = intval($row [7]);
               $this->resultados_vec[$i]['descripcion'] = htmlspecialchars_decode( trim($row [8]));
               $this->resultados_vec[$i]['legajo'] = htmlspecialchars_decode( trim($row [9]));
               $this->resultados_vec[$i]['email'] = htmlspecialchars_decode( trim($row [10]));
               $this->resultados_vec[$i]['pwd'] = htmlspecialchars_decode( trim($row [11]));
               $this->resultados_vec[$i]['perfil_id'] = htmlspecialchars_decode( trim($row [12]));
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
          $this->legajo = $this->resultados_vec[0]['legajo'];
          $this->email = $this->resultados_vec[0]['email'];
          $this->pwd = $this->resultados_vec[0]['pwd'];
          $this->perfil_id = $this->resultados_vec[0]['perfil_id'];
        } //del If de si trajo registros

         @mysqli_free_result($rs); @mysqli_next_result($cn) ; // rs->free();
} //de la fcion
} //de la clase
 
?>
