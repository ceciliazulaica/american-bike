    <? include_once 'header.php'; 
    
    //Generado el dia 10/03/2015 10:53:41 a.m.
    
    $sql=" create table abike_configuracion (
        id     INTEGER primary key auto_increment
        ,estado     INTEGER
        ,alta_ip     VARCHAR(255)
        ,update_ip     VARCHAR(255)
        ,alta_fecha     DATETIME
        ,alta_usuario_id     INTEGER
        ,update_fecha     DATETIME
        ,update_usuario_id     INTEGER
        ,frase_top     VARCHAR(255)
        ,direccion     VARCHAR(255)
        ,telefono     VARCHAR(255)
        ,email     VARCHAR(255)
        ,contacto_email     VARCHAR(255)
        ,contacto_texto     LONGTEXT
    );";
        if(!$rs = $cn->query($sql)) print('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;
 
    
    $sql=" create table abike_contactos_recibidos (
        id     INTEGER primary key auto_increment
        ,estado     INTEGER
        ,alta_ip     VARCHAR(255)
        ,update_ip     VARCHAR(255)
        ,alta_fecha     DATETIME
        ,alta_usuario_id     INTEGER
        ,update_fecha     DATETIME
        ,update_usuario_id     INTEGER
        ,nombre     VARCHAR(255)
        ,email     VARCHAR(255)
        ,mensaje     LONGTEXT
    );";
        if(!$rs = $cn->query($sql)) print('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;
 
    
    $sql=" create table abike_noticias (
        id     INTEGER primary key auto_increment
        ,estado     INTEGER
        ,alta_ip     VARCHAR(255)
        ,update_ip     VARCHAR(255)
        ,alta_fecha     DATETIME
        ,alta_usuario_id     INTEGER
        ,update_fecha     DATETIME
        ,update_usuario_id     INTEGER
        ,descripcion     VARCHAR(255)
        ,bajada     VARCHAR(255)
        ,porcentaje     VARCHAR(255)
        ,cuerpo     LONGTEXT
        ,imagen     VARCHAR(255)
        ,fuente     VARCHAR(255)
    );";
        if(!$rs = $cn->query($sql)) print('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;
 
    
    $sql=" create table abike_secciones (
        id     INTEGER primary key auto_increment
        ,estado     INTEGER
        ,alta_ip     VARCHAR(255)
        ,update_ip     VARCHAR(255)
        ,alta_fecha     DATETIME
        ,alta_usuario_id     INTEGER
        ,update_fecha     DATETIME
        ,update_usuario_id     INTEGER
        ,descripcion     VARCHAR(255)
        ,bajada     LONGTEXT
        ,imagen     VARCHAR(255)
        ,orden     INTEGER
        ,link     VARCHAR(255)
    );";
        if(!$rs = $cn->query($sql)) print('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;
 
    
    $sql=" create table abike_servicios (
        id     INTEGER primary key auto_increment
        ,estado     INTEGER
        ,alta_ip     VARCHAR(255)
        ,update_ip     VARCHAR(255)
        ,alta_fecha     DATETIME
        ,alta_usuario_id     INTEGER
        ,update_fecha     DATETIME
        ,update_usuario_id     INTEGER
        ,descripcion     VARCHAR(255)
        ,detalle     LONGTEXT
        ,nro     INTEGER
    );";
        if(!$rs = $cn->query($sql)) print('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;
 
    
    $sql=" create table abike_sliders (
        id     INTEGER primary key auto_increment
        ,estado     INTEGER
        ,alta_ip     VARCHAR(255)
        ,update_ip     VARCHAR(255)
        ,alta_fecha     DATETIME
        ,alta_usuario_id     INTEGER
        ,update_fecha     DATETIME
        ,update_usuario_id     INTEGER
        ,tipo     INTEGER
        ,imagen     VARCHAR(255)
    );";
        if(!$rs = $cn->query($sql)) print('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;
 
    
    
    
    
    $sql=" create table numeracion(
        descripcion         varchar(100),   
        id                  int
    );";
        if(!$rs = $cn->query($sql)) print('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;
    
   $sql="  CREATE TABLE IF NOT EXISTS `log` (
      `fecha` datetime NOT NULL,
      `usuario_id` int(11) NOT NULL,
      `query` longtext NOT NULL,
      `operacion` varchar(255) NOT NULL,
      `parametros_ant` longtext NOT NULL,
      `url` longtext NOT NULL,
      `request_ip` varchar(50) default NULL,
      `id` int(11) NOT NULL auto_increment,
      PRIMARY KEY  (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";
        if(!$rs = $cn->query($sql)) print('ERROR [' . $cn->error . ']');  $rows_cant = $rs->num_rows;
    
    echo '<h1>La instalacion finalizo correctamente</h1>';
    ?>
