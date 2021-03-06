<?  error_reporting(E_ERROR | E_WARNING | E_PARSE);
	include_once 'includes/config.php';
	include_once 'includes/lib_utiles.php';

	include_once 'includes/abike_sliders.php'; 
	include_once 'includes/abike_configuracion.php';
	include_once 'includes/abike_secciones.php';
	include_once 'includes/abike_servicios.php';
	include_once 'includes/abike_noticias.php';
?>
<head>

	<meta charset="utf-8">

	<title>American Bike</title>
	<meta name='description' content='En la zona de Palermo nos dedicamos a la fabricación y venta de bicicletas, mountain bike,  fixie, hibridas, paseo, ruta, plegables, inglesa y  bicicletas infantiles. También comercializamos  accesorios para el ciclista y su bicicleta,  infladores, luces, candados, cascos,  ciclocomputadoras, guantes, canastos, alforjas,  asientos. Nos especializamos en el servicio técnico de  todos los modelos de bicicletas y repuestos  nacionales e importados.'/>
	<meta name='keywords' content='Bicicletas, bicicleterias, pedales, manubrios, infladores, cascos, guantes, caramañolas,   velocímetro, Shimano, triplex, jamis, cannondale,  schwinn, aurora, mongoose, sbk, american bike,  venzo, slime, prowell, velo, onguard, kriptonyte,  giyo, maxxis, michelin,  wellgo,  peugeot'/>

	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; user-scalable=no">

	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic">

	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/responsive.css" media="all">

	<meta name='revisit-after' content='1 Days'/>
	<meta name='author' content='VOUSYS.com'/>



	<!-- Mobile !-->
	<meta http-equiv="X-UA-Compatible" 	content="IE=edge,chrome=1">
	<meta name="viewport" 				content="width=device-width, initial-scale=1.0"/>
	<!-- Mobile !-->

	<!-- fcbk !-->
	 <meta property="og:site_name" 	content="Americanbike.com"/>
	<meta property="og:url" 		content="http://www.americanbike.com<?=$_SERVER["REQUEST_URI"];?>" />  
 	<meta property="og:title" 		content="American Bike" /> 
	<meta property="og:description" content="En la zona de Palermo nos dedicamos a la fabricación y venta de bicicletas, mountain bike,  fixie, hibridas, paseo, ruta, plegables, inglesa y  bicicletas infantiles. También comercializamos  accesorios para el ciclista y su bicicleta,  infladores, luces, candados, cascos,  ciclocomputadoras, guantes, canastos, alforjas,  asientos. Nos especializamos en el servicio técnico de  todos los modelos de bicicletas y repuestos  nacionales e importados." />
	<meta property="og:image" 		content="http://www.americanbike.com/img/logo.png" />
	<?= $header["image-tags"] ?>
	<!-- fcbk !-->
	
	<?= $header["head_adicional_tags"]; ?>
	
	<!-- Identification !-->
	<link rel="image_src" 		href="http://www.americanbike.com/img/logo.png" />
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" type="image/gif" href="animated_favicon1.gif">
	<link rel="apple-touch-icon" href="animated_favicon1.gif" />
	<!-- Identification !-->

<script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>

	<header id="header">

		<h1 id="logo">
			<a href="index.php">American Bike</a>
		</h1>

		<p id="carrito">
			<a href="http://americanbike.mitiendanube.com/" target="_blank">Carrito de compras</a>
		</p>

		<?
			$abike_configuracion_obj = new abike_configuracion;
			$abike_configuracion_obj->traer();
		?>		

		<div id="contacto-info-header">
			<p><? print utf8_encode($abike_configuracion_obj->direccion); ?></p>
			<p>TEL: <? print utf8_encode($abike_configuracion_obj->telefono); ?></p>
			<p><? print $abike_configuracion_obj->email; ?></p>
		</div>


	</header>

	<section id="slider">

		<div class="slides">
			<? 
				$abike_sliders_obj = new abike_sliders;
				$abike_sliders_obj->tipo = 1;
				$abike_sliders_obj->traer();

				foreach ($abike_sliders_obj->resultados_vec as $slide) { ?>
					<div class="slide">
					<figure><img src="<? print $slide['imagen']; ?>" alt=""></figure>
				</div>
			<?
				}
			?>			
		</div>

		<nav class="pager">
			<a href="#" class="prev">Anterior</a>
			<a href="#" class="next">Siguiente</a>
		</nav>

	</section>

	<section id="content">

		<section id="secciones">

			
				<?
 			      /* if ($abike_configuracion_obj->frase_top != '') {?><blockquote><p><? print utf8_encode($abike_configuracion_obj->frase_top); ?></p></blockquote><? } */ ?> 
			

			<div>
				<?
					$abike_secciones_obj = new abike_secciones;
					$abike_secciones_obj->traer();

					foreach ($abike_secciones_obj->resultados_vec as $seccion) { 
					   if ( $seccion['link'] == "tienda") {
					       $seccion['link']="http://americanbike.mitiendanube.com/"; 
                            
					   } else{
					       $seccion['link']="#".$seccion['link'];
					   }
                       ?>
						<article>
							<a href="<?= $seccion['link']; ?>" <?=($seccion['link']=="http://americanbike.mitiendanube.com/" ? "target='_blank'":"") ;?>>
								<figure><img src="<? print $seccion['imagen']; ?>" alt=""></figure>
								<h2><? print utf8_encode($seccion['descripcion']); ?></h2>
								<? print utf8_encode($seccion['bajada']); ?>
							</a>
						</article>
				<?		
					}
				?>				
			</div>

		</section>


<?
				$abike_sliders_obj = new abike_sliders;
				$abike_sliders_obj->tipo = 2;
				$abike_sliders_obj->traer();
?>

		<section class="separador" id="separador-1" style="background-image:url(<?=$abike_sliders_obj->imagen; ?>);">


          <?  if (strlen($abike_configuracion_obj->frase_slide_1_1)>4) {?><blockquote>
                <p><? print utf8_encode($abike_configuracion_obj->frase_slide_1_1); ?></p>
				<p><? print utf8_encode($abike_configuracion_obj->frase_slide_1_2); ?></p>          
           </blockquote><? } ?> 


			<a href="#" class="subir">Subir</a>

		</section>

		<section id="servicios">
			<?
				$abike_servicios_obj = new abike_servicios;
				$abike_servicios_obj->traer();

				foreach ($abike_servicios_obj->resultados_vec as $servicio) { ?>
					<article>
						<h2><? print utf8_encode($servicio['descripcion']); ?></h2>
						<? print utf8_encode($servicio['detalle']); ?>
					</article>
			<?		
				}
			?>
		</section>

<?
				$abike_sliders_obj = new abike_sliders;
				$abike_sliders_obj->tipo = 3;
				$abike_sliders_obj->traer();
?>
		<section class="separador" id="separador-2" style="background-image:url(<?=$abike_sliders_obj->imagen; ?>);">

          <?  if (strlen($abike_configuracion_obj->frase_slide_2_1)>4) {?>
        <blockquote> 
                <p><? print utf8_encode($abike_configuracion_obj->frase_slide_2_1); ?></p>
				<p><? print utf8_encode($abike_configuracion_obj->frase_slide_2_2); ?></p>          
           </blockquote><? }  ?> 


			<a href="#" class="subir">Subir</a>

		</section>

		<section id="noticias">

			<h2>News</h2>

			<div class="slider">

				<div class="slides">
					<?
						$abike_noticias_obj = new abike_noticias;
						$abike_noticias_obj->traer();

						foreach ($abike_noticias_obj->resultados_vec as $noticia) { ?>
							<div class="slide">
								<article>
									<h3>
										<? if (trim($noticia['icono']) != '') { ?>
											<img src="<? print $noticia['icono']; ?>" alt="">
										<? } ?>
										<? print utf8_encode($noticia['descripcion']); ?>
									</h3>
									<h4>
										<span><? print $noticia['porcentaje']; ?></span>
										<? print utf8_encode($noticia['bajada']); ?>
									</h4>
									<div>
										<? print utf8_encode($noticia['cuerpo']); ?>
									</div>
									<h6>Fuente: <a href="<? print utf8_encode($noticia['fuente']); ?>" target="_blank"><? print utf8_encode($noticia['fuente']); ?></a></h6>
								</article>

								<? if (trim($noticia['imagen']) != '') { ?>
									<aside>
										<figure><img src="<? print $noticia['imagen']; ?>" alt=""></figure>
									</aside>
								<? } ?>
							</div>
					<?
						}
					?>						
				</div>

				<nav class="pager">
					<a href="#" class="prev">Anterior</a>
					<a href="#" class="next">Siguiente</a>
				</nav>

			</div>

		</section>

<?
				$abike_sliders_obj = new abike_sliders;
				$abike_sliders_obj->tipo = 4;
				$abike_sliders_obj->traer();
?>

		<section class="separador" id="separador-3" style="background-image:url(<?=$abike_sliders_obj->imagen; ?>);">

          <?  if (strlen($abike_configuracion_obj->frase_slide_3_1)>4) { /*?>
          
			<h4>
				<span><? print utf8_encode($abike_configuracion_obj->frase_slide_3_1); ?></span> 
				<span><? print utf8_encode($abike_configuracion_obj->frase_slide_3_2); ?></span> 
				<span><? print utf8_encode($abike_configuracion_obj->frase_slide_3_3); ?></span>
			</h4>
          
          <? */ ?>

        <blockquote> 
                <p><? print utf8_encode($abike_configuracion_obj->frase_slide_3_1); ?></p>
				<p><? print utf8_encode($abike_configuracion_obj->frase_slide_3_2); ?></p>          
				<p><? print utf8_encode($abike_configuracion_obj->frase_slide_3_3); ?></p>          
           </blockquote>
          
          
          
          <? }  ?> 




			<a href="#" class="subir">Subir</a>

		</section>

		<section id="contacto">

			<h2>Vení a visitarnos</h2>

			<article>
				<h3>Información de contacto</h3>
				<? print utf8_encode($abike_configuracion_obj->contacto_texto); ?>
				<nav>
					<h5>Seguinos en: </h5>
					<a href="https://www.facebook.com/AmericanBike1?fref=ts" class="facebook" target="_blank">Facebook</a>
					<a href="https://instagram.com/american.bike" class="instagram" target="_blank">Instagram</a>
				</nav>
			</article>

			<form id="form-contacto" name="form-contacto">

				<ol>
					<li>
						<label>Nombre</label>
						<input type="text" class="text" id="txt_nombre" name="txt_nombre">
					</li>
					<li>
						<label>E-mail</label>
						<input type="text" class="text" id="txt_email" name="txt_email">
					</li>
					<li>
						<label>Dejá tu mensaje</label>
						<textarea class="textarea" id="txt_mensaje" name="txt_mensaje"></textarea>
					</li>
				</ol>

<div class="g-recaptcha" data-sitekey="6LdH6wwTAAAAADvCmgCyP1UUiv7UTdYKgp8M3zWW"></div>

				<p class="submit">
					<input type="submit" class="submit" value="Enviar mensaje">
				</p>

				<img class="sending" src="images/ajax-loader.gif" />
				<div class="send-ok">Mensaje enviado.  Nos contactaremos a la brevedad.</div>
				<div class="send-error">Se produjo un error al enviar el mensaje.  Por favor intente más tarde.</div>

			</form>

			<a href="#" class="subir">Subir</a>

		</section>

		<section id="contacto-info">

			<article>
				<h3>Dirección</h3>
				<p><? print utf8_encode($abike_configuracion_obj->direccion); ?></p>
			</article>
			<article>
				<h3>Teléfono</h3>
				<p><? print utf8_encode($abike_configuracion_obj->telefono); ?></p>
			</article>
			<article>
				<h3>E-mail</h3>
				<p><a href="mailto:<? print strtolower($abike_configuracion_obj->email); ?>"><? print $abike_configuracion_obj->email; ?></a></p>
			</article>

		</section>

	</section>

	<footer id="footer">

		<nav>
			<ul>
				<li><a href="#" target="_blank">La Tienda</a></li>
				<li><a href="#servicios">Servicio Técnico</a></li>
				<li><a href="#noticias">News</a></li>
				<li><a href="#contacto">Contacto</a></li>
			</ul>
		</nav>

		<p id="copyright"><small>&copy; American Bike <?=date("Y");?> - Todos los derechos reservados.
            
            &nbsp;&nbsp;
            <a href="http://www.vousys.com/" target="_blank" title="VOUSYS desarrollo web & mobile"><img src="http://www.vousys.com/vousys_publicidad.png" alt="VOUSYS desarrollo web & mobile" /></a>
        
        </small></p>

	</footer>

	<script type="text/javascript" src="frameworks/jquery-1.9.1.min.js"></script>
	<script type='text/javascript' src='frameworks/jquery-migrate-1.2.1.min.js'></script>
	<script type='text/javascript' src='frameworks/jquery.validate.js'></script>
	<script type="text/javascript" src="js/jquery.cycle2.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="js/default.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		    $('#form-contacto').validate({
		        errorPlacement: function(error, element) { /*ocultar mensajes*/},   
		        rules: {
	                txt_nombre: {required:true  },
	                txt_email: {required:true, email:true },
	    			txt_mensaje: {required:true},		    
		        },
		        messages: {
	                txt_descripcion: '*',
	                txt_email: '*',
	                txt_mensaje: '*',
		        }
		        , invalidHandler: function(form, validator) {
		            $('form .sending').hide();
					$('form .submit').show();
		        }
		        , submitHandler: function(form) {
	                $('form .submit').hide();	                                
	                $('form .sending').show();
			    	
			    	$.post("ajax.php?action=1", $("form").serialize(), function (data) { 
			    		$('form .sending').hide();	                       
						if (data == 'OK') {
						  $('form .sending').hide();
						  $('form .send-error').hide();
						  $('form .send-ok').show();

                          $('#form-contacto')[0].reset();
                          
						} else {
							if (data == 'MAIL')
								$('form .send-error').html('Ingrese un mail válido.');
							else 
								$('form .send-error').html('Se produjo un error al enviar el mensaje.  Por favor intente más tarde.');
									
							$('form .sending').hide();
							$('form .submit').show();
							$('form .send-error').show();
						}
	              	});
		        }
		    
		    });
		});
	</script>
</body>
</html>