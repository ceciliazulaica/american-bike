<?

    /* --------------------------------------------------
          Libreria Desarrollada por Veronica Osorio para Vousys Consulting - www.vousys.com
                    info@vousys.com
       -------------------------------------------------- */

class log{

        //defino las variables de la clase
          var $id;
          var $fecha;
          var $fecha_desde;
          var $fecha_hasta;
          var $usuario_id;
          var $query;
          var $operacion;
          var $parametros_ant;
          var $url;
         var $resultados_vec;

    function _construct() {

    // Inicializo las variables (se ejecuta solo cuando se instancia el objeto)

          $this->id='';
          $this->fecha='';
          $this->fecha_desde='';
          $this->fecha_hasta='';
          $this->query=$query;
          $this->operacion=$operacion;
          $this->parametros_ant="";
          $this->url="";
         $this->resultados_vec= array();



    }
function add($query,$operacion,$parametros_ant="") {

global $cn;

          $this->query=$query;
          $this->operacion=$operacion;

		  //echo "V";print_r($parametros_ant);echo "V";


		$parametros_ant_str="";
		if (is_array($parametros_ant)){
			// print_r($parametros_ant);
			 foreach($parametros_ant as $key => $value)  $parametros_ant_str.=$key."".$value."-";
		}else{
			$parametros_ant_str=$parametros_ant;
		}

		$this->parametros_ant=$parametros_ant_str;



    //_________ Inserto ________

    $sql="INSERT INTO `log` (
		`fecha` ,
		`usuario_id` ,
		`query` ,
		`operacion` ,
		`parametros_ant` ,
		`url`,
		request_ip
		)
		VALUES (
            	 NOW()
             , ".fmt_num_sin_null($_SESSION['sess_usuario_id'])."
             ,  '".(addslashes($this->query))."'
             ,  ".fmt_string_sin_null(($this->operacion))."
             ,  '".(addslashes($this->parametros_ant))."'
             ,  '".(addslashes($_SERVER['REQUEST_URI'] ."".$_SERVER["QUERY_STRING"]))."'
             ,  '".(addslashes($_SERVER['REMOTE_ADDR'] ))."'
        )";

    //_________ Ejecuto el Query ________

        if(!$rs = $cn->query($sql)) die('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;



} //de la fcion

function log_cant_traer() {

global $cn;
          $sql= "SELECT COUNT(*)
          FROM log
              ,usuarios
          WHERE log.id > 0
            AND log.usuario_id = usuarios.id
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and log.id = " .fmt_num_sin_null($this->id); }
          if (is_date($this->fecha)) {$sql.=" and log.fecha = " .fmt_fecha($this->fecha); }
          if (intval(trim($this->usuario_id))!= 0) {$sql.=" and log.usuario_id = " .fmt_num_sin_null($this->usuario_id); }
          if (trim($this->query)!= '') {$sql.=" and log.query like '" .trim("%".($this->query)."%")."'"; }
          if (trim($this->operacion)!= '') {$sql.=" and log.operacion like " .fmt_string_sin_null("%".($this->operacion)."%"); }


        //Ejecuto la consulta
        if(!$rs = $cn->query($sql)) die('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;

        if ($rows_cant != 0) {
        $vec=$rs->fetch_assoc();
            $rta=$vec['id'];
        }else{
            $rta=0;
       }
         $rs->free();
    return( $rta);
}


function traer($pagina=0,$pagina_cant=999999) {
global $cn;

            $pagina_cant = intval($pagina_cant);
            $pagina = intval($pagina);

    //_________ Traigo los datos segun los parámetros ingresados ________

    $sql="SELECT
             log.id
             ,log.fecha
             ,log.usuario_id
             ,log.query
             ,log.operacion
             ,usuarios.nombre
             ,url
             ,parametros_ant

          FROM log
              ,usuarios
          WHERE log.id > 0
            AND log.usuario_id = usuarios.id
         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and log.id = " .fmt_num_sin_null($this->id); }
          if (is_date($this->fecha)) {$sql.=" and log.fecha = " .fmt_fecha($this->fecha); }
          if (is_date($this->fecha_desde)) {$sql.=" and log.fecha >= " .fmt_fecha($this->fecha_desde); }
          if (is_date($this->fecha_hasta)) {$this->fecha_hasta.=" 23:59"; $sql.=" and log.fecha <= " .fmt_fecha($this->fecha_hasta); }
          if (intval(trim($this->usuario_id))!= 0) {$sql.=" and log.usuario_id = " .fmt_string_sin_null($this->usuario_id); }
          if (trim($this->query)!= '') {$sql.=" and log.query like '" .trim("%".($this->query)."%")."'"; }
          if (trim($this->operacion)!= '') {$sql.=" and log.operacion like " .fmt_string_sin_null("%".($this->operacion)."%"); }



    $sql.=" union SELECT
             log.id
             ,log.fecha
             ,log.usuario_id
             ,log.query
             ,log.operacion
             ,'No especifica'
             ,url
             ,parametros_ant

          FROM log
          WHERE log.id > 0

         ";


          if (intval(trim($this->id))!= 0) {$sql.=" and log.id = " .fmt_num_sin_null($this->id); }
          if (is_date($this->fecha)) {$sql.=" and log.fecha = " .fmt_fecha($this->fecha); }
          if (is_date($this->fecha_desde)) {$sql.=" and log.fecha >= " .fmt_fecha($this->fecha_desde); }
          if (is_date($this->fecha_hasta)) {$this->fecha_hasta.=" 23:59"; $sql.=" and log.fecha <= " .fmt_fecha($this->fecha_hasta); }
          if (intval(trim($this->usuario_id))!= 0) {$sql.=" and log.usuario_id = " .fmt_string_sin_null($this->usuario_id); }
          if (trim($this->query)!= '') {$sql.=" and log.query like '" .trim("%".($this->query)."%")."'"; }
          if (trim($this->operacion)!= '') {$sql.=" and log.operacion like " .fmt_string_sin_null("%".($this->operacion)."%"); }

      $sql.=' order by fecha DESC';
      if (($pagina_cant != 0) && ($pagina_cant != 999999)) $sql.=" LIMIT ".$pagina .",".$pagina_cant;

//echo $sql;




        //Ejecuto la consulta
        if(!$rs = $cn->query($sql)) die('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;

        $this->resultados_vec=array();

        //Recorro los campos
        $i = 0;
        if ($rows_cant != 0) {
        while ($row=$rs->fetch_assoc()) {


               $this->resultados_vec[$i]['id'] = intval($row [0]);
               $this->resultados_vec[$i]['fecha'] = fecha_desde_sql($row [1]);
               $this->resultados_vec[$i]['usuario_id'] = trim($row [2]);
               $this->resultados_vec[$i]['query'] = stripslashes((trim($row [3])));
               $this->resultados_vec[$i]['operacion'] = htmlspecialchars_decode( trim($row [4]));
               $this->resultados_vec[$i]['usuarios_desc'] = trim($row[5]);
               $this->resultados_vec[$i]['url'] = stripslashes((trim($row [6])));
               $this->resultados_vec[$i]['parametros_ant'] = stripslashes((trim($row [7])));
               $i++;
            } //del while de si trajo registros

        } //del If de si trajo registros

} //de la fcion

} //de la clase

?>
