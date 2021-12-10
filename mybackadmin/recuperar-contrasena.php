<?  $es_login=1; 
    include "header.php";
	include_once '../includes/viaticos_usuarios.php';


if (($_POST['login_email'] != '') ){

 
        $viaticos_usuarios_obj=new viaticos_usuarios;
        $viaticos_usuarios_obj->email=trim($_POST['login_email']);
        $viaticos_usuarios_obj->traer();

			if(count($viaticos_usuarios_obj->resultados_vec )== 1){

				$viaticos_usuarios_obj->pwd = $clave = rand();
				$viaticos_usuarios_obj->updatePassword();

				$mensaje = file_get_contents('../templates/usuarios_pwd_update.htm');
				$mensaje = str_replace('{SISTEMA_URL}',SISTEMA_URL,$mensaje);
				$mensaje = str_replace('{EMPRESA_NOMBRE}',SISTEMA_NOMBRE,$mensaje);
				$mensaje = str_replace('{EMAIL}',$viaticos_usuarios_obj->email,$mensaje);
				$mensaje = str_replace('{USUARIO_NOMBRE}',$viaticos_usuarios_obj->descripcion,$mensaje);
				$mensaje = str_replace('{PWD}',$clave,$mensaje);


				phpmailer_enviar(SISTEMA_EMAIL,SISTEMA_NOMBRE,$viaticos_usuarios_obj->email,$viaticos_usuarios_obj->descripcion,'Cambio de clave de acceso',$mensaje);
				$pwd_generada=1;

                $msg = "<div class='ok'>Se ha enviado un correo con su nueva clave a " . $viaticos_usuarios_obj->email."</div>";
	}else{
        $msg = "<div class='msg-error'>El mail ingresado no existe en nuestra base de datos, por favor contactese con su administrador.</div>";
	}
}


?>
		<section id="login">		     
			<form action="recuperar-contrasena.php" method="post" name="form_login">
		 			
		      
				    <ul>
		    			<li>
		    				<header>
					    		 <figure><img src="../images/logo.png" /></figure>
					    		 <br />
					    		 
								 <h1>Recuperar Contraseña</h1>
								 <?=$msg ;?>
				    		</header>
				    	</li>
						<li>
							<label>E-Mail:</label>
				        	<input type="text" name="login_email" class="usuario" size="20" />
				        </li>
        
                         
				
						<li class="botones">
							<label></label>
				        	<input type="submit" class="submit" value="Recuperar contraseña" />
				        </li>
				        <li>&nbsp;</li>
                        
                        <li><label></label><a href="login.php">Volver</a></li>
				  </ul>
		 


		</form>
		</section ><!-- login !-->

<? include "footer.php"; ?>		 