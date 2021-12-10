<? include_once 'config-sys.php';
        
        // Constantes
		define(BD_NAME,"l9000369_ma1n");
        define(BD_SERVER,"localhost");
        define(BD_USUARIO,"l9000369_ma1n");
        define(BD_PWD,"0rn37A1ndAc0");
        
        define(SISTEMA_URL,"http://www.americanbike.com.ar");
        define(SISTEMA_NOMBRE,"americanbike.com.ar");
        define(SISTEMA_EMAIL,"info@americanbike.com.ar");
        
        define(ESTADO_ACTIVO,"1");
        define(ESTADO_INACTIVO,"2");
        define(OP_ALTA,"85");
        define(OP_UPDATE,"86");
        define(OP_CONSULTA,"87");
        
        //___________ Inclusion de Librerias _____________
        include_once 'lib_numeracion.php';
        define(DEBUG_ENABLED,true);
        define(UPLOAD_PATH_ROOT,"");
        
        //Campos a no incluir en la exportaciona  a excel
        $tablas_campos_seguridad=array('alta_fecha','alta_ip','alta_usuario_id','update_fecha','update_ip','update_usuario_id','id');
    
    
        $cn=new mysqli (BD_SERVER, BD_USUARIO, BD_PWD,BD_NAME) ;
         if ($cn->connect_errno >0) echo 'error al conectar:'.$cn->connect_error;
include_once 'log.php';
?>
