<? $header['title']= '';
    $header['description']= '';
    $header['keywords']= '';
    include_once 'header.php';
    include_once '../includes/usuarios.php';
    include_once "../includes/form_inc_lib.php";


     //:::::::::::::::::::::::::::::::::::::::::::
     //     parámetros que recibe la pantalla
     //     ------------------------------------
     //     $grabacion_rta    --> Indica la Rta de GRabacion
     //     $id     --> Indica el ID si es el caso de la operacion MOdificacion
     //     $operacion        --> Indica el tipo de operacion
     //:::::::::::::::::::::::::::::::::::::::::::

if ($_GET['save'] == 1) {



    $grabacion_rta="";

    if (trim($_POST['txt_pwd']) == '' || trim($_POST['txt_pwd_repetir']) == '') {
        $grabacion_rta.="Debe completar ambos campos";
    } // del If

    if (trim($_POST['txt_pwd']) != trim($_POST['txt_pwd_repetir'])) {
        $grabacion_rta.="Las contrase&ntilde;as no coinciden";
    } // del If

    if ($grabacion_rta == '') {
        $valida_save=true;
    }else{
        $valida_save=false;
    }//del if


    $usuarios_vec[0]['id']= $_SESSION['sess_usuario_id'];
    $usuarios_vec[0]['pwd']=$_POST['txt_pwd'];

    if ($valida_save) {
        usuarios_pwd_cambiar($usuarios_vec);
        
        
		$mensaje = file_get_contents('../templates/usuarios_pwd_update.htm');
		$mensaje = str_replace('{SISTEMA_URL}',SISTEMA_URL,$mensaje);
		$mensaje = str_replace('{EMPRESA_NOMBRE}', EMPRESA_NOMBRE,$mensaje);
		$mensaje = str_replace('{USUARIO_NOMBRE}',$_SESSION['sess_usuario_nombre'],$mensaje);
		$mensaje = str_replace('{EMAIL}',$_SESSION['sess_usuario_email'],$mensaje);
		$mensaje = str_replace('{PWD}',$usuarios_vec[0]['pwd'],$mensaje);
		if(mail_enviar(EMPRESA_MAIL,EMPRESA_NOMBRE,$_SESSION['sess_usuario_email'],"Cambio de clave de acceso",$mensaje,$rta)){
			msgbox('Se ha enviado un correo con su nueva clave a ' . $_SESSION['sess_usuario_email']);

		}else{
			msgbox('Ocurrio un problema al intenta enviar la nueva clave, por favor intentelo mas tarde.');
		}

        $usuarios_vec=array();
         msgbox('Se cambio la contraseña correctamente');
        
    }

} // del if de si grava


?>


<script type='text/JavaScript'>
       function cancelar() {
       window.location.href = 'usuarios_adm.php';
       }
       function panta_validar() {
            var error_str="";

                if (document.me.txt_pwd.value.length == 0) {
                       error_str+="Debe ingresar la contraseña \n";
                } // del If

                if (document.me.txt_pwd_repetir.value.length == 0) {
                       error_str+="Debe ingresar nuevamente la contraseña \n";
                } // del If

            if (error_str == '') {
                return(true);
             }else{
                alert(error_str);
                return(false);
             }//del if

       } // de la fcion
    </script> <?

    $tabindex=0;
    if (trim($grabacion_rta) != '') {
        if ((trim($grabacion_rta) != 'Se guardo correctamente') and (trim($grabacion_rta) != '')) {
        }else{
                $usuarios_vec=array();
        }
    }

    $op_desc="Modificacion de Contrase&ntilde;a de usuario";


    echo "<h1>$op_desc</h1>";

    if ((trim($grabacion_rta) != 'Se guardo correctamente') and (trim($grabacion_rta) != '')) {
        $grabacion_rta=str_replace('--','<br />',$grabacion_rta);
        echo "<font color='red'>Errores Detectados en la validacion: <br />$grabacion_rta</font>";
    }

   echo "<form name='me' method='post' onSubmit='return panta_validar();'  ENCTYPE='multipart/form-data'
            action='usuarios_pwd_cambiar.php?save=1&id=".$_GET['id']."&operacion=".$_GET['operacion']."'>";
	$tabindex++;
    echo "<table align='center'>
            <tr>
                <td class='letra'>Contrase&ntilde;a</td>
                <td class='letra'>
                <input type='password' name='txt_pwd' id='txt_pwd' class='control'  tabindex='".$tabindex."'
                        value='' size='80' maxlength='255' onKeyPress='return enter_form(this, event)'>
                </td>
            </tr>";
            $tabindex++;
    echo "<tr>
                <td class='letra'>Confirmar</td>
                <td class='letra'>
                <input type='password' name='txt_pwd_repetir' id='txt_pwd_repetir' class='control'  tabindex='".$tabindex."'
                        value='' size='80' maxlength='255' onKeyPress='return enter_form(this, event)'>
                </td>
            </tr>";
            $tabindex++;

            echo "
         ";
     echo "
            <tr>
                    <td align='right'><input type='submit' name='bt_submit'  value='Guardar' id='bt_submit' class='control' title ='Guardar' ></td>
                    <td align='left'><input type='button' value='Cancelar' onClick='cancelar();' class='control' title ='Cancelar'></td>
            </tr>";
   echo "</table>";

   echo "</form><br /><br /><br /><br /><br /><br />";


   include_once 'footer.php' ?>
