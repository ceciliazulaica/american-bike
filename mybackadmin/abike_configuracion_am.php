<? $header['title']= '';
    $header['description']= '';
    $header['keywords']= '';
 include_once 'header.php';
    include_once '../includes/abike_configuracion.php';
    
    
     //:::::::::::::::::::::::::::::::::::::::::::
     //     parámetros que recibe la pantalla 
     //     ------------------------------------
     //     $id     --> Indica el ID si es el caso de la operacion MOdificacion 
     //     $operacion        --> Indica el tipo de operacion 
     //:::::::::::::::::::::::::::::::::::::::::::
    
$abike_configuracion_obj=new abike_configuracion;
echo "<section id='am'>";
if ($_GET['save'] == 1) {
    
    
    
    $grabacion_rta="";
    
    //if (trim($_POST['txt_frase_top']) == '')          $grabacion_rta.="<li>Debe ingresar Frase top </li>";
    if (trim($_POST['txt_direccion']) == '')          $grabacion_rta.="<li>Debe ingresar Direccion </li>";
    if (trim($_POST['txt_telefono']) == '')          $grabacion_rta.="<li>Debe ingresar Telefono </li>";
    if (trim($_POST['txt_email']) == '')          $grabacion_rta.="<li>Debe ingresar Email </li>";
    if (trim($_POST['txt_contacto_email']) == '')          $grabacion_rta.="<li>Debe ingresar Contacto email </li>";
    if (trim($_POST['txt_contacto_texto']) == '')          $grabacion_rta.="<li>Debe ingresar Contacto texto </li>";
            
    if ($grabacion_rta == '') {
        $valida_save=true;
    }else{
        $valida_save=false;
        $msg_error ="<div class='msg-error'> <h1>Por favor, corrige los siguientes errores e intenta grabar nuevamente</h1><ul class='list'> $grabacion_rta </ul></div> ";
    }//del if
    
    $abike_configuracion_obj->id=trim($_POST['txt_id']);
    $abike_configuracion_obj->frase_top=trim($_POST['txt_frase_top']);
    $abike_configuracion_obj->direccion=trim($_POST['txt_direccion']);
    $abike_configuracion_obj->telefono=trim($_POST['txt_telefono']);
    $abike_configuracion_obj->email=trim($_POST['txt_email']);
    $abike_configuracion_obj->contacto_email=trim($_POST['txt_contacto_email']);
    $abike_configuracion_obj->contacto_texto=trim($_POST['txt_contacto_texto']);
    $abike_configuracion_obj->frase_slide_1_1=trim($_POST['txt_frase_slide_1_1']);
    $abike_configuracion_obj->frase_slide_1_2=trim($_POST['txt_frase_slide_1_2']);
    $abike_configuracion_obj->frase_slide_2_1=trim($_POST['txt_frase_slide_2_1']);
    $abike_configuracion_obj->frase_slide_2_2=trim($_POST['txt_frase_slide_2_2']);
    $abike_configuracion_obj->frase_slide_3_1=trim($_POST['txt_frase_slide_3_1']);
    $abike_configuracion_obj->frase_slide_3_2=trim($_POST['txt_frase_slide_3_2']);
    $abike_configuracion_obj->frase_slide_3_3=trim($_POST['txt_frase_slide_3_3']);
    if ($valida_save) {
            
            if ($_GET['operacion'] != OP_ALTA) {
            
                //_______ Actualizo en la tabla ______
                $abike_configuracion_obj->id=$_GET['id'];
                $abike_configuracion_obj->update();

            }else{
        
                //_______ Agrego en la tabla ______
                $abike_configuracion_obj->id=$abike_configuracion_obj->add();
            }



                // Guardo el mensaje de OK para mostrarlo
                $msg_ok ="<div class='ok'>  <h1>Se ha guardado correctamente! </h1></div> ";

            if ($_GET['operacion'] != OP_ALTA) {
                //Vuelvo al administrador
                // pagina_redireccionar("abike_configuracion_adm.php?busca=1");
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
            window.location.href = 'abike_configuracion_adm.php'; 
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
                                txt_frase_top: {required:false},
    
                                txt_direccion: {required:true  },
    
                                txt_telefono: {required:true  },
    
                                txt_email: {required:true ,email: true},
    
                                txt_contacto_email: {required:true  },
    
    
        },
        messages: {
                txt_frase_top: '*',
                txt_direccion: '*',
                txt_telefono: '*',
                txt_email: '*',
                txt_contacto_email: '*',
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
     if (trim($msg_error) == '')    $abike_configuracion_obj=new abike_configuracion;
     
    if ($_GET['operacion'] != OP_ALTA) {
        //Traigo los datos correspondientes con el id
        $abike_configuracion_obj->id=$_GET['id'];
        $abike_configuracion_obj->traer();
        if ($abike_configuracion_obj->id!=$_GET['id']) die('No se encontraron datos');


        $op_desc="Configuracion ";
    }else{
        $op_desc="Nuevos  configuracion";
    }

   echo "<form name='formulario'  id='formulario' method='post'   ENCTYPE='multipart/form-data'  action='abike_configuracion_am.php?save=1&id=".$_GET['id']."&operacion=".$_GET['operacion']."&popup=".$_GET['popup']."'>";

    //Si grabo OK
    echo $msg_ok;
     
    //Si hubo error 
    echo $msg_error;
     
     
    echo "<header><h1> $op_desc </h1> <p>Completá todos los campos requeridos y presiona Guardar</p></header>";


    echo "<ul>
                      <li>
                            <label for='txt_frase_top'>Frase bajo slider principal</label>
                            <input  type='text' name='txt_frase_top'  id='txt_frase_top'    value='".$abike_configuracion_obj->frase_top."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Frase top.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Frase top !--> ";

            echo "
                      <li>
                            <label for='txt_frase_slide_1_1'>Frase slide 1 (linea 1)</label>
                            <input  type='text' name='txt_frase_slide_1_1'  id='txt_frase_slide_1_1'    value='".$abike_configuracion_obj->frase_slide_1_1."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Slide 1 (línea 1).Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Slide 1 (línea 1) !--> ";

            echo "
                      <li>
                            <label for='txt_frase_slide_1_2'>Frase slide 1 (linea 2)</label>
                            <input  type='text' name='txt_frase_slide_1_2'  id='txt_frase_slide_1_2'    value='".$abike_configuracion_obj->frase_slide_1_2."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Slide 1 (línea 2).Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Slide 1 (línea 2) !--> ";

            echo "
                      <li>
                            <label for='txt_frase_slide_2_1'>Frase slide 2 (linea 1)</label>
                            <input  type='text' name='txt_frase_slide_2_1'  id='txt_frase_slide_2_1'    value='".$abike_configuracion_obj->frase_slide_2_1."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Slide 2 (línea 1).Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Slide 2 (línea 1) !--> ";

            echo "
                      <li>
                            <label for='txt_frase_slide_2_2'>Frase slide 2 (linea 2)</label>
                            <input  type='text' name='txt_frase_slide_2_2'  id='txt_frase_slide_2_2'    value='".$abike_configuracion_obj->frase_slide_2_2."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Slide 2 (línea 2).Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Slide 2 (línea 2) !--> ";

            echo "
                      <li>
                            <label for='txt_frase_slide_3_1'>Frase slide 3 (linea 1)</label>
                            <input  type='text' name='txt_frase_slide_3_1'  id='txt_frase_slide_3_1'    value='".$abike_configuracion_obj->frase_slide_3_1."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Slide 3 (línea 1).Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Slide 3 (línea 1) !--> ";

            echo "
                      <li>
                            <label for='txt_frase_slide_3_2'>Frase slide 3 (linea 2)</label>
                            <input  type='text' name='txt_frase_slide_3_2'  id='txt_frase_slide_3_2'    value='".$abike_configuracion_obj->frase_slide_3_2."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Slide 3 (línea 2).Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Slide 3 (línea 2) !--> ";

            echo "
                      <li>
                            <label for='txt_frase_slide_3_3'>Frase slide 3 (linea 3)</label>
                            <input  type='text' name='txt_frase_slide_3_3'  id='txt_frase_slide_3_3'    value='".$abike_configuracion_obj->frase_slide_3_3."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Slide 3 (línea 3).Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Slide 3 (línea 3) !--> ";

                
            echo "
                      <li>
                            <label for='txt_direccion'>Direccion</label>
                            <input  type='text' name='txt_direccion'  id='txt_direccion'    value='".$abike_configuracion_obj->direccion."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Direccion.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Direccion !--> ";
                
            echo "
                      <li>
                            <label for='txt_telefono'>Telefono</label>
                            <input  type='text' name='txt_telefono'  id='txt_telefono'    value='".$abike_configuracion_obj->telefono."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Telefono.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Telefono !--> ";
                
            echo "
                      <li>
                            <label for='txt_email'>Email</label>
                            <input  type='text' name='txt_email'  id='txt_email'    value='".$abike_configuracion_obj->email."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Email.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Email !--> ";
                
            echo "
                      <li>
                            <label for='txt_contacto_email'>Contacto email</label>
                            <input  type='text' name='txt_contacto_email'  id='txt_contacto_email'    value='".$abike_configuracion_obj->contacto_email."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Contacto email.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Contacto email !--> ";
                
            echo "
                      <li>
                            <label for='txt_contacto_texto'>Contacto texto</label>
                        <br clear='all' /><div class='textarea'><textarea name='txt_contacto_texto' id='txt_contacto_texto' class='obligatorio'>". trim($abike_configuracion_obj->contacto_texto)."</textarea></div>
                      </li><!-- campo Contacto texto !--> ";
                
            echo "
         ";
            echo "<li><label></label></li>";
            echo "<li class='botones'> ";
             
                                echo "<div class='submit' id='btn-guardar'>Guardar</div><div id='btn-guardar-loading'><img src='../images/loading.gif' /> Aguarde por favor , guardando ...</div>";
                    echo "</li><!-- botones !-->
       </ul><!-- campos !-->";
    
   echo "</form>";
   echo "</section><!-- am !-->";
    
    
   include_once 'footer.php' ?>
