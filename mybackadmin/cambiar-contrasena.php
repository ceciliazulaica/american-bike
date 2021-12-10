<? $header['title']= '';
    $header['description']= '';
    $header['keywords']= '';
 include_once 'header.php';
    include_once '../includes/usuarios.php';
        
     //:::::::::::::::::::::::::::::::::::::::::::
     //     parámetros que recibe la pantalla 
     //     ------------------------------------
     //     $id     --> Indica el ID si es el caso de la operacion MOdificacion 
     //     $operacion        --> Indica el tipo de operacion 
     //:::::::::::::::::::::::::::::::::::::::::::
    
$usuarios_obj=new usuarios;
echo "<section id='am'>";
if ($_GET['save'] == 1) {
    
    
    
    $grabacion_rta="";
    
    if (trim($_POST['txt_pwd']) == '' || trim($_POST['txt_pwd_repetir']) == '') $grabacion_rta.="<li>Debe ingresar ambos campos</li>";
    
    if (trim($_POST['txt_pwd']) != trim($_POST['txt_pwd_repetir'])) $grabacion_rta.="<li>Ambos campos deben ser iguales</li>";

    if ($grabacion_rta == '') {
        $valida_save=true;
    }else{
        $valida_save=false;
        $msg_error ="<div class='msg-error'> <h1>Por favor, corrige los siguientes errores e intenta grabar nuevamente</h1><ul class='list'> $grabacion_rta </ul></div> ";
    }//del if
    
    $usuarios_obj->pwd=trim($_POST['txt_pwd']);
    if ($valida_save) {
        //_______ Actualizo en la tabla ______
        $usuarios_obj->id=$_GET['id'];
        $usuarios_obj->updatePassword();


        // Guardo el mensaje de OK para mostrarlo
        $msg_ok ="<div class='ok'>  <h1>Se ha guardado correctamente! </h1></div> ";

        if ($_GET['operacion'] != OP_ALTA) {
            //Vuelvo al administrador
            // pagina_redireccionar("usuarios_adm.php?busca=1");
        }

    }else {
    }// de si valida Save
    
} // del if de si grava
        
?> 
    
    
<script type='text/JavaScript'>    
     <? if ($_GET['popup'] != 1) { ?>
     <? } ?>
    $(document).ready(function() {

        $.validator.passwordRating.messages = {
            "similar-to-username": "Similar al nombre de usuario",
            "too-short": "Demasiado corto",
            "very-weak": "Muy débil",
            "weak": "Débil",
            "good": "Bueno",
            "strong": "Fuerte"
        }


        $("#txt_pwd").keyup(function() {
          $(this).valid();
        });
        

        $('#btn-guardar-loading').hide();
                
        //-->  Cancelar <--
        $('#btn-cancelar').click(function() {
            window.location.href = 'usuarios_adm.php'; 
        });
        //-->  SAVE <--
        $('#btn-guardar').click(function() {
                $('#btn-guardar').hide();
                $('#btn-guardar-loading').show();
                $('#formulario').submit();
        });
    
    
    /** validate form on keyup and submit **/
    $('#formulario').validate({
         errorPlacement: function(error, element) { /*ocultar mensajes*/},   
        rules: {
            txt_pwd: {required:true, password:true  },
            txt_pwd_repetir: {required:true, password:true  },
        },
        messages: {
           txt_pwd: '*',
           txt_pwd_repetir: '*',     
        }
        , invalidHandler: function(form, validator) {
                $('#btn-guardar-loading').hide();
                $('#btn-guardar').show();
        }
        , submitHandler: function(form) {
                $('#btn-guardar-loading').show();
                $('#btn-guardar').hide();
                form.submit();
        }
    
    });
 });
    </script> <?
    
    $tabindex=0;
     // No hubo error o es la primera vez q carga la pantalla, limpio 
     if (trim($msg_error) == '')    $usuarios_obj=new usuarios;
     
    
    //Traigo los datos correspondientes con el id     
    $usuarios_obj->id=$_SESSION['sess_usuario_id'];
    $usuarios_obj->traer();
    if (count($usuarios_obj->resultados_vec)==0) die('No se encontraron datos');


    $op_desc="Modificacion de contraseña de usuario";
    
   echo "<form name='formulario'  id='formulario' method='post'   ENCTYPE='multipart/form-data'  action='usuarios_pwd_cambiar.php?save=1&id=".$_SESSION['sess_usuario_id']."&operacion=".$_GET['operacion']."&popup=".$_GET['popup']."'>";

    //Si grabo OK
    echo $msg_ok;
     
    //Si hubo error 
    echo $msg_error;
     
     
    echo "<header><h1> $op_desc </h1> <p>Completá todos los campos requeridos y presiona Guardar</p></header>";


    echo "<ul>
                      <li>
                            <label for='txt_pwd'>Contraseña</label>
                            <input  type='password' name='txt_pwd'  id='txt_pwd'      maxlength='255'  class='long obligatorio'  placeholder='Ingrese la nueva contraseña' title='Ingrese el texto del Pwd.Puede ingresar hasta 255 caracteres'>
                            <div class='password-meter'> <div class='password-meter-message'> &nbsp; </div> </div>
                                            
                      </li><!-- campo Pwd !--> ";
                
            echo "
                       <li>
                            <label for='txt_pwd_repetir'>Repetir</label>
                            <input  type='password' name='txt_pwd_repetir'  id='txt_pwd_repetir'      maxlength='255'  class='long obligatorio' placeholder='Repita la nueva contraseña' title='Ingrese el texto del Pwd.Puede ingresar hasta 255 caracteres'>
                                            
                      </li><!-- campo Pwd Repetir !--> ";
                
            echo "
         ";
            echo "<li><label></label></li>";
            echo "<li class='botones'>
                                <div class='cancelar' id='btn-cancelar'>Cancelar</div>
                                    <div class='or'></div>
                                <div class='submit' id='btn-guardar'>Guardar</div><div id='btn-guardar-loading'><img src='../images/loading.gif' /> Aguarde por favor , guardando ...</div>
                    </li><!-- botones !-->
       </ul><!-- campos !-->";
    
   echo "</form>";
   echo "</section><!-- am !-->";
    
    
   include_once 'footer.php' ?>
