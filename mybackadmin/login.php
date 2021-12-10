<?  $es_login=1; include "header.php";
 
	$usuario_logueado = false;
	if((  trim($_POST['login_user']) != '') && (trim($_POST['login_pwd']) != '')  ){
			
			if(trim($_POST['login_user']) == 'admin' && trim($_POST['login_pwd']) == 'vousys!'){

                /** seguridad */
                session_name("appname");
                $_SESSION['sess_name'] = session_name(); 
                /** seguridad */


				$_SESSION['sess_usuario_logueado'] = true;
				$usuario_logueado = true;
				pagina_redireccionar("index.php");
			}else {
				$msg = "<div class='msg-error'>No se han podido validar los datos del usuario ingresado</div>";
			}
	}

?>

 
 		<section id="login">		     
			<form action="login.php" method="post" name="form_login">
		 			
		      
				    <ul>
		    			<li>
		    				<header>
					    		 <figure><img src="../images/logo.png" /></figure>
					    		 <br />
					    		 
								 <h1>LOGIN</h1>
								 <?=$msg ;?>
				    		</header>
				    	</li>
						<li>
							<label>Usuario:</label>
				        	<input type="text" name="login_user" class="usuario" size="20" />
				        </li>
		
						<li>
							<label>Contraseña:</label>
				        	<input type="password" name="login_pwd"  class="clave" size="20" />
				        </li>
				
						<li class="botones">
							<label></label>
				        	<input type="submit" class="submit" value="Ingresar" />
				        </li>
				        <li>&nbsp;</li>
				  </ul>
		
		</form>
		</section ><!-- login !-->

<? include "footer.php"; ?>