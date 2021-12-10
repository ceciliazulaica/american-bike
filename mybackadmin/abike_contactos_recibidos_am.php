<? $header['title']= '';
    $header['description']= '';
    $header['keywords']= '';
 include_once 'header.php';
    include_once '../includes/abike_contactos_recibidos.php';
    
    
     //:::::::::::::::::::::::::::::::::::::::::::
     //     parámetros que recibe la pantalla 
     //     ------------------------------------
     //     $id     --> Indica el ID si es el caso de la operacion MOdificacion 
     //     $operacion        --> Indica el tipo de operacion 
     //:::::::::::::::::::::::::::::::::::::::::::
    
$abike_contactos_recibidos_obj=new abike_contactos_recibidos;
echo "<section id='am'>";
if ($_GET['save'] == 1) {
    
    
    
    $grabacion_rta="";
    
    if (trim($_POST['txt_nombre']) == '')          $grabacion_rta.="<li>Debe ingresar Nombre </li>";
    if (trim($_POST['txt_email']) == '')          $grabacion_rta.="<li>Debe ingresar Email </li>";
    if (trim($_POST['txt_mensaje']) == '')          $grabacion_rta.="<li>Debe ingresar Mensaje </li>";
            
    if ($grabacion_rta == '') {
        $valida_save=true;
    }else{
        $valida_save=false;
        $msg_error ="<div class='msg-error'> <h1>Por favor, corrige los siguientes errores e intenta grabar nuevamente</h1><ul class='list'> $grabacion_rta </ul></div> ";
    }//del if
    
    $abike_contactos_recibidos_obj->id=trim($_POST['txt_id']);
    $abike_contactos_recibidos_obj->nombre=trim($_POST['txt_nombre']);
    $abike_contactos_recibidos_obj->email=trim($_POST['txt_email']);
    $abike_contactos_recibidos_obj->mensaje=trim($_POST['txt_mensaje']);
    if ($valida_save) {
            
            if ($_GET['operacion'] != OP_ALTA) {
            
                //_______ Actualizo en la tabla ______
                $abike_contactos_recibidos_obj->id=$_GET['id'];
                $abike_contactos_recibidos_obj->update();

            }else{
        
                //_______ Agrego en la tabla ______
                $abike_contactos_recibidos_obj->id=$abike_contactos_recibidos_obj->add();
            }



                // Guardo el mensaje de OK para mostrarlo
                $msg_ok ="<div class='ok'>  <h1>Se ha guardado correctamente! </h1></div> ";

            if ($_GET['operacion'] != OP_ALTA) {
                //Vuelvo al administrador
                // pagina_redireccionar("abike_contactos_recibidos_adm.php?busca=1");
            }

        }else {
        }// de si valida Save
    
} // del if de si grava
    
    
?> 
    
    
<script type='text/JavaScript'>    
     <? if ($_GET['popup'] != 1) { ?>
     <? } ?>
    $(document).ready(function() {
        $('#btn-guardar-loading').hide();
                
        //-->  Cancelar <--
        $('#btn-cancelar').click(function() {
            window.location.href = 'abike_contactos_recibidos_adm.php'; 
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
                                txt_nombre: {required:true  },
    
                                txt_email: {required:true ,email: true},
    
    
        },
        messages: {
                txt_nombre: '*',
                txt_email: '*',
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
     if (trim($msg_error) == '')    $abike_contactos_recibidos_obj=new abike_contactos_recibidos;
     
    if ($_GET['operacion'] != OP_ALTA) {
        //Traigo los datos correspondientes con el id
        $abike_contactos_recibidos_obj->id=$_GET['id'];
        $abike_contactos_recibidos_obj->traer();
        if ($abike_contactos_recibidos_obj->id!=$_GET['id']) die('No se encontraron datos');


        $op_desc="Modificacion de  contactos recibidos #".$_GET['id'];
    }else{
        $op_desc="Nuevos  contactos recibidos";
    }

   echo "<form name='formulario'  id='formulario' method='post'   ENCTYPE='multipart/form-data'  action='abike_contactos_recibidos_am.php?save=1&id=".$_GET['id']."&operacion=".$_GET['operacion']."&popup=".$_GET['popup']."'>";

    //Si grabo OK
    echo $msg_ok;
     
    //Si hubo error 
    echo $msg_error;
     
     
    echo "<header><h1> $op_desc </h1> <p>Completá todos los campos requeridos y presiona Guardar</p></header>";


    echo "<ul>
                      <li>
                            <label for='txt_nombre'>Nombre</label>
                            <input  type='text' name='txt_nombre'  id='txt_nombre'    value='".$abike_contactos_recibidos_obj->nombre."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Nombre.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Nombre !--> ";
                
            echo "
                      <li>
                            <label for='txt_email'>Email</label>
                            <input  type='text' name='txt_email'  id='txt_email'    value='".$abike_contactos_recibidos_obj->email."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Email.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Email !--> ";
                
            echo "
                      <li>
                            <label for='txt_mensaje'>Mensaje</label>
                        <br clear='all' /><div class='textarea'><textarea name='txt_mensaje' id='txt_mensaje' class='obligatorio'>". trim($abike_contactos_recibidos_obj->mensaje)."</textarea></div>
                      </li><!-- campo Mensaje !--> ";
                
            echo "
         ";
            echo "<li><label></label></li>";
            echo "<li class='botones'> ";
            if ($_GET['popup'] != 1) {
                                echo "<div class='cancelar' id='btn-cancelar'>Cancelar</div>";
                                    echo "<div class='or'></div>";
            }
                                echo "<div class='submit' id='btn-guardar'>Guardar</div><div id='btn-guardar-loading'><img src='../images/loading.gif' /> Aguarde por favor , guardando ...</div>";
                    echo "</li><!-- botones !-->
       </ul><!-- campos !-->";
    
   echo "</form>";
   echo "</section><!-- am !-->";
    
    
   include_once 'footer.php' ?>
