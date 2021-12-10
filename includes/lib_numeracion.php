<?
/* ----------------------------------------------------------
	Libreria Desarrollada por Veronica Osorio
				vosorio@gmail.com
 ---------------------------------------------------------- */

function numeracion_traer($tabla) {
global $cn;

	$sql="SELECT id from numeracion";
	$sql.=" WHERE descripcion = ". fmt_string_sin_null($tabla);


	if(!$rs = $cn->query($sql)) die('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;

	$encontro=false;
	$id=0;
	if ($rows_cant != 0) {
		while ($row=$rs->fetch_row()) {
			$id=intval($row[0]);
			$id++;
		}
	}


	if ($id == 0) { //No existia el reg en la tabla numeracion ..... se agrega
		$sql="insert into numeracion (descripcion ,id)";
		$sql.=" VALUES ( ".fmt_string_sin_null($tabla).",1)";
		$id=1;
		if(!$rs = $cn->query($sql)) die('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;
	}else{
		$sql="update numeracion ";
		$sql.=" SET id = id + 1 ";
		$sql.=" where descripcion = ".fmt_string_sin_null($tabla);
		if(!$rs = $cn->query($sql)) die('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;
	}

	return($id);

}


/* evaluar en multitrans seguidas */
function numeracion_traer2($tabla)
{
    mysql_query('INSERT INTO `numeracion` (descripcion,id)
            VALUES ("' . mysql_real_escape_string($tabla) . '","1")
            ON DUPLICATE KEY UPDATE id = id + 1');
    $r = mysql_query('SELECT id FROM `numeracion` WHERE descripcion = "' . $tabla . '" LIMIT 1') OR debug(mysql_error());
    return mysql_fetch_object($r)->id;
}

?>