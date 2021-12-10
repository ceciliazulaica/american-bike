<? /*session_set_cookie_params (0, realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session')  ); */ @session_start($PHPSESSID); //ob_start("ob_gzhandler"); // Comienza Gzip
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if ($es_login != 1) {

    if (($_SESSION['sess_name']) != "appname" ) header("Location: ".$header_path_adicional."login.php");
	if(!$_SESSION['sess_usuario_logueado']) header ('Location: login.php');
	if ($_SESSION['sess_usuario_logueado'] !== true) header('Location: login.php');
}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="es" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="es" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="es" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="es" class="no-js ie9"> <![endif]-->
<html class="no-js">
	<head>
	 	<?   include_once '../includes/config.php'; ?>

		<!-- basicos !-->
		<title><? echo (isset($header["title"]) ? $header["title"]:SISTEMA_NOMBRE) ; ?></title>
		<meta name="abstract" 		content='<? echo (isset($header["description"]) ? $header["description"] : SISTEMA_NOMBRE);?>  '/>
		<meta name='description' 	content='<? echo (isset($header["description"]) ? $header["description"]  : SISTEMA_NOMBRE);?>  '/>
		<meta name='keywords' 		content='<? echo $header["keywords"]. $lang_vousys["keywords"];?> '/>
		<meta charset="iso-8859-1" />
		<meta name='robots' 		content='ALL'/>
		<meta name='revisit-after' 	content='1 Days'/>
		<meta name='author' 		content='Veronica Osorio Para www.vousys.com'/>

		<!-- Mobile !-->
		<meta http-equiv="X-UA-Compatible" 	content="IE=edge,chrome=1"/>
		<meta name="viewport" 				content="width=device-width, initial-scale=1.0"/>
		<!-- Mobile !-->

	 	<meta property="og:title" 		content="<? echo (isset($header["title"]) ? $header["title"]:SISTEMA_NOMBRE) ; ?>" />
		<meta property="og:description" content="<? echo (isset($header["description"]) ? ($header["description"])  : SISTEMA_NOMBRE);?>" />
		<meta property="og:image" 		content="<? echo (isset($header["image"]) ? SISTEMA_URL.$header["image"]  : "");?>" />


		<!-- Identification !-->
		<link rel="alternate" 		type="application/rss+xml" href="rss.xml"  title="<?=SISTEMA_NOMBRE?>" />
		<link rel="image_src" 		href="<? echo (isset($header["image"]) ? SISTEMA_URL.$header["image"]  : "");?>" />
		<link rel="shortcut icon" 	href="images/favicon.ico"/>
		<link rel="apple-touch-icon" href="images/favicon.gif" />
		<!-- Identification !-->


		<!-- Styles !-->

			<!-- fonts!-->
			<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Open+Sans:300italic,400,300,700' rel='stylesheet' type='text/css'>

			<!-- Basico !-->
	        <link href='../css/backend.css'                                                                rel='stylesheet' type='text/css' media="screen"/>
	        <link href='../css/print.css'                                                                  rel='stylesheet' type='text/css' media="print"/>


			<link href="../frameworks/jquery-ui-1.10.2.custom/css/redmond/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />


			<!-- POPups !-->
	        <?if ( $_GET["popup"] == 1) { ?> <link href='../css/front-popup.css'  							rel='stylesheet' type='text/css'/> <? } ?>
			<?if ( $_GET["popup"] != 1) { ?> <link rel='stylesheet' type='text/css' href='../css/colorbox.css' media='screen' /> <?} ?>

			<!-- Tips !-->
			<link rel="stylesheet" href="../frameworks/poshytip-1.1/src/tip-yellowsimple/tip-yellowsimple.css" type="text/css" />

			<!-- Alertas !-->
	        <link rel='stylesheet' 	href='../frameworks/smoke-alerts/smoke.css' type='text/css'   />

			<!-- Ordenar tabla !-->
			<link href="../frameworks/table_sorting/table.css" 												rel="stylesheet" type="text/css" />

			<!-- Menu !-->
			<link rel="stylesheet" type="text/css" href="../frameworks/TooltipMenu/css/component.css" />

			<!-- <link rel='stylesheet' 	href='../frameworks/jQuery-File-Upload-master/css/jquery.fileupload-ui.css' type='text/css'   /> !-->

		<!-- Styles !-->




		<!-- Frameworks !-->

			<!-- alabada seas Jquery !-->
			<!--
			<script type="text/javascript"    src="../frameworks/jquery-1.11.1.min.js"></script>
			<script type="text/javascript"    src="../frameworks/jquery-1.11.1.min.map"></script>
!-->
			<script type="text/javascript"    src="../frameworks/jquery-1.9.1.min.js"></script>
			<script type='text/javascript'     src='../frameworks/jquery-migrate-1.2.1.min.js'></script> 
			<script type="text/javascript"	src="../frameworks/modernizr.2.5.3.js" ></script>

			<!-- Jquery UI calendar !-->
			<script type="text/javascript"    src="../frameworks/jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js"></script>

			<!-- alerts !-->
			<script type='text/javascript'	src='../frameworks/smoke-alerts/smoke.min.js' ></script>

			<!-- POPups!-->
			<?if ( $_GET["popup"] != 1) { ?> <script type='text/javascript' 	src='../frameworks/colorbox/jquery.colorbox.js'></script> <?} ?>

			<!-- Jquery Tooltips!-->
			<script type='text/javascript' 	src='../frameworks/poshytip-1.1/src/jquery.poshytip.min.js'></script>

			<!-- Jquery Validate !-->
			<script type='text/javascript' 	src='../frameworks/jquery.validate.js'></script>
            <!-- agregarla solo donde se use porq dejan de andar los ckeditor <script type='text/javascript'     src='../frameworks/jquery.validate.password.js'></script> !-->

			<!-- Rich text box!-->
	        <script type='text/javascript'  src='../ckeditor/ckeditor.js'></script>
	        <script type='text/javascript'  src='../ckeditor/adapters/jquery.js'></script>

			<!-- Menu!-->
			<script src="../frameworks/TooltipMenu/js/cbpTooltipMenu.min.js"></script>

			<!-- Sort tables !-->
		    <script type="text/javascript"	src="../frameworks/table_sorting/table.js"></script>

	        <!--<script type='text/javascript'     src='../frameworks/jQuery-File-Upload-master/js/jquery.fileupload.js'></script>!-->

		<!-- Frameworks !-->



		<!-- Scripts !-->
		 <script type='text/JavaScript'>
		 	var mobile_es = "<?= ($mobile_es ? 1 :0); ?>";
            var popup_es = "<?=intval($_GET["popup"]);?>";
		 </script>

        <script type="text/javascript"	src="../js/backend.js"></script>
        <script type="text/javascript"	src="../js/lib_utiles.js"></script>

		<!-- Scripts !-->

	    <? include_once '../includes/lib_utiles.php'; ?>
	 	<?  $_SESSION['sess_reporte_vec']=array(); ?>


	</head>
 <body>



	<? if ($es_login != 1) {
		if ($_GET["popup"]!=1) { ?>
			 <div id='main'> <!-- inicio del contenido !-->
			    <header id="header">
				        <div id="logo"><a href="index.php"><img src='../images/logo.png' alt="<?=EMPRESA_NOMBRE?>" title="<?=EMPRESA_NOMBRE?>" /></a></div>
						<div id='datos-usuario'><span class='nombre'> Bienvenido/a <b><?=$_SESSION['sess_usuario_nombre'] ?></b> </span>
												<span class='logout'><a href='logout.php'><img src='../css/images/btn-logout.png' /> Salir</a></span>
						</div><!-- end of user !-->
				        <? include_once 'menu.php' ?>
			      </header>
			<? } ?>
	<? } ?>

     <div id='page_content' class="<?=($_GET["popup"]==1 ? "popup": "") ?>">
