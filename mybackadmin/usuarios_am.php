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
    
    if (trim($_POST['txt_descripcion']) == '') $grabacion_rta.="<li>Debe ingresar Descripcion </li>";
    if (trim($_POST['txt_legajo']) == '')      $grabacion_rta.="<li>Debe ingresar Legajo </li>";
    if (trim($_POST['txt_email']) == '')       $grabacion_rta.="<li>Debe ingresar Email </li>";
    if (trim($_POST['txt_pwd']) == '' && $_GET['operacion'] == OP_ALTA) $grabacion_rta.="<li>Debe ingresar Pwd </li>";
    if (trim($_POST['txt_perfil_id']) == '')   $grabacion_rta.="<li>Debe ingresar Perfil </li>";


    // se valida que no exista otro usuario con el mismo legajo
    $usuarios_previo_obj = new usuarios;
    $usuarios_previo_obj->legajo = trim($_POST['txt_legajo']);
    $usuarios_previo_obj->traer();
    if (count($usuarios_previo_obj->resultados_vec)>0 && $_GET['operacion'] == OP_ALTA) {
        $grabacion_rta.="<li>Ya existe un usuario con el legajo indicado.</li>";
    }
    else {
        // se verifica que el legajo no corresponda a otro usuario
        foreach ($usuarios_previo_obj->resultados_vec as $usuario_obj) {
            if ((int)$usuario_obj['id']!=(int)$_GET['id'] && $usuario_obj['legajo']==trim($_POST['txt_legajo'])) {
                $grabacion_rta.="<li>Ya existe un usuario con el legajo indicado.</li>";
                break;
            }
        } 
    }

    // se valida que no exista otro usuario con el mismo email
    $usuarios_previo_obj = new usuarios;
    $usuarios_previo_obj->email = trim($_POST['txt_email']);
    $usuarios_previo_obj->traer();
    if (count($usuarios_previo_obj->resultados_vec)>0 && $_GET['operacion'] == OP_ALTA) {
        $grabacion_rta.="<li>Ya existe un usuario con el email indicado.</li>";
    }
    else {
        // se verifica que el legajo no corresponda a otro usuario
        foreach ($usuarios_previo_obj->resultados_vec as $usuario_obj) {
            if ((int)$usuario_obj['id']!=(int)$_GET['id'] && $usuario_obj['email']==trim($_POST['txt_email'])) {
                $grabacion_rta.="<li>Ya existe un usuario con el email indicado.</li>";
                break;
            }
        } 
    }
        
    if ($grabacion_rta == '') {
        $valida_save=true;
    }else{
        $valida_save=false;
        $msg_error ="<div class='msg-error'> <h1>Por favor, corrige los siguientes errores e intenta grabar nuevamente</h1><ul class='list'> $grabacion_rta </ul></div> ";
    }//del if
    
    $usuarios_obj->id=trim($_POST['txt_id']);
    $usuarios_obj->descripcion=trim($_POST['txt_descripcion']);
    $usuarios_obj->legajo=trim($_POST['txt_legajo']);
    $usuarios_obj->email=trim($_POST['txt_email']);
    $usuarios_obj->pwd=trim($_POST['txt_pwd']);
    $usuarios_obj->perfil_id=trim($_POST['txt_perfil_id']);
    if ($valida_save) {
            
            if ($_GET['operacion'] != OP_ALTA) {
            
                //_______ Actualizo en la tabla ______
                $usuarios_obj->id=$_GET['id'];
                $usuarios_obj->update();

            }else{
        
                //_______ Agrego en la tabla ______
                $usuarios_obj->id=$usuarios_obj->add();
            }



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
                $("#txt_pwd").rules("remove");
                $('#btn-guardar').hide();
                $('#btn-guardar-loading').show();
                $('#formulario').submit();
        });
    
    
    /** validate form on keyup and submit **/
    $('#formulario').validate({
         errorPlacement: function(error, element) { /*ocultar mensajes*/},   
        rules: {
                                txt_descripcion: {required:true  },
    
                                txt_legajo: {required:true  },
    
                                txt_email: {required:true ,email: true},

                                txt_pwd: {required:true, password:true  },
    
                                txt_perfil_id: {required:true  },
    
        },
        messages: {
                txt_descripcion: '*',
                txt_legajo: '*',
                txt_email: '*',
                txt_pwd: '*',                
                txt_perfil_id: '*',
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
     
    if ($_GET['operacion'] != OP_ALTA) {
        //Traigo los datos correspondientes con el id
        $usuarios_obj->id=$_GET['id'];
        $usuarios_obj->traer();
        if ($usuarios_obj->id!=$_GET['id']) die('No se encontraron datos');


        $op_desc="Modificacion de  usuarios #".$_GET['id'];
    }else{
        $op_desc="Nuevos  usuarios";
    }

   echo "<form name='formulario'  id='formulario' method='post'   ENCTYPE='multipart/form-data'  action='usuarios_am.php?save=1&id=".$_GET['id']."&operacion=".$_GET['operacion']."&popup=".$_GET['popup']."'>";

    //Si grabo OK
    echo $msg_ok;
     
    //Si hubo error 
    echo $msg_error;
     
     
    echo "<header><h1> $op_desc </h1> <p>Completá todos los campos requeridos y presiona Guardar</p></header>";


    echo "<ul>
                      <li>
                            <label for='txt_descripcion'>Descripcion</label>
                            <input  type='text' name='txt_descripcion'  id='txt_descripcion'    value='".$usuarios_obj->descripcion."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Descripcion.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Descripcion !--> ";
                
            echo "
                      <li>
                            <label for='txt_legajo'>Legajo</label>
                            <input  type='text' name='txt_legajo'  id='txt_legajo'    value='".$usuarios_obj->legajo."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Legajo.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Legajo !--> ";
                
            echo "
                      <li>
                            <label for='txt_email'>Email</label>
                            <input  type='text' name='txt_email'  id='txt_email'    value='".$usuarios_obj->email."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Email.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Email !--> ";
                
            echo "
                      <li>
                            <label for='txt_pwd'>Pwd</label>
                            <input  type='password' name='txt_pwd'  id='txt_pwd'      maxlength='255'  class='long obligatorio' placeholder='".($_GET['operacion']==OP_ALTA?'Ingrese el texto.':'Ingrese la NUEVA contraseña (o deje el campo vacio si no pretende modificarla)')."' title='Ingrese el texto del Pwd.Puede ingresar hasta 255 caracteres'>
                            <div class='password-meter'> <div class='password-meter-message'> &nbsp; </div> </div>
                                            
                      </li><!-- campo Pwd !--> ";
                
            echo "
                      <li>
                            <label for='txt_perfil_id'>Perfil</label>
                            <select name='txt_perfil_id'  id='txt_perfil_id'>
                                <option value=''></option>";                                
                            foreach ($perfiles_vec as $perfil) {
            echo "              <option value='".$perfil['id']."' ".($usuarios_obj->perfil_id==$perfil['id']?'selected':'').">".$perfil['nombre']."</option>";                                
                            }
            echo "          </select>
                      </li><!-- campo Perfil !--> ";
                
            echo "
         ";
            echo "<li><label></label></li>";
            echo "<li class='botones'>
                                <div class='cancelar' id='btn-cancelar'>Cancelar</div>";
if(in_array('configuracion.usuario.edit', $perfiles_vec[$_SESSION['sess_usuario_perfil_id']]['acciones'])) { 
            echo "                  <div class='or'></div>
                                <div class='submit' id='btn-guardar'>Guardar</div><div id='btn-guardar-loading'><img src='../images/loading.gif' /> Aguarde por favor , guardando ...</div>";
}
            echo "</li><!-- botones !-->
       </ul><!-- campos !-->";
    
   echo "</form>";
   echo "</section><!-- am !-->";
    
    
   include_once 'footer.php' ?>
