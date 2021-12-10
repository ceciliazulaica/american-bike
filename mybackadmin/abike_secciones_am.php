<style type="text/css">
  .tamanio {
    clear: both;
    color: #999;
    float: left;
    font-size: 11px;
    margin-left: 12%;
  }
</style>

<? $header['title']= '';
    $header['description']= '';
    $header['keywords']= '';
 include_once 'header.php';
    include_once '../includes/abike_secciones.php';
    
    
     //:::::::::::::::::::::::::::::::::::::::::::
     //     parámetros que recibe la pantalla 
     //     ------------------------------------
     //     $id     --> Indica el ID si es el caso de la operacion MOdificacion 
     //     $operacion        --> Indica el tipo de operacion 
     //:::::::::::::::::::::::::::::::::::::::::::
    
$abike_secciones_obj=new abike_secciones;
echo "<section id='am'>";


if ($_GET['save'] == 1) {
    
    
    
    $grabacion_rta="";
    
    if (trim($_POST['txt_descripcion']) == '')          $grabacion_rta.="<li>Debe ingresar Descripcion </li>";
    if (trim($_POST['txt_bajada']) == '')          $grabacion_rta.="<li>Debe ingresar Bajada </li>";
    if (trim($_POST['txt_orden']) == '')          $grabacion_rta.="<li>Debe ingresar Orden </li>";
    if (trim($_POST['cmb_link']) == '')          $grabacion_rta.="<li>Debe ingresar Link </li>";
            
    if ($grabacion_rta == '') {
        $valida_save=true;
    }else{
        $valida_save=false;
        $msg_error ="<div class='msg-error'> <h1>Por favor, corrige los siguientes errores e intenta grabar nuevamente</h1><ul class='list'> $grabacion_rta </ul></div> ";
    }//del if
    
    $abike_secciones_obj->id=trim($_POST['txt_id']);
    $abike_secciones_obj->descripcion=trim($_POST['txt_descripcion']);
    $abike_secciones_obj->bajada=trim($_POST['txt_bajada']);
    $abike_secciones_obj->imagen=trim($_POST['txt_imagen']);
    $abike_secciones_obj->orden=trim($_POST['txt_orden']);
    $abike_secciones_obj->link=$_POST['cmb_link'];
    if ($valida_save) {
            
            if ($_GET['operacion'] != OP_ALTA) {
            
                //_______ Actualizo en la tabla ______
                $abike_secciones_obj->id=$_GET['id'];
                $abike_secciones_obj->update();

            }else{
        
                //_______ Agrego en la tabla ______
                $abike_secciones_obj->id=$abike_secciones_obj->add();
            }

                  $file_nuevo = $abike_secciones_obj->imagenes_subir('txt_imagen',$abike_secciones_obj->id);
                  if ( $file_nuevo!= '') $abike_secciones_obj->campo_update('imagen',$file_nuevo);


                // Guardo el mensaje de OK para mostrarlo
                $msg_ok ="<div class='ok'>  <h1>Se ha guardado correctamente! </h1></div> ";

            if ($_GET['operacion'] != OP_ALTA) {
                //Vuelvo al administrador
                // pagina_redireccionar("abike_secciones_adm.php?busca=1");
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
            window.location.href = 'abike_secciones_adm.php'; 
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
                                txt_descripcion: {required:true  },
    
    
                                txt_orden: {required:true ,number: true},
    
                                cmb_link: {required:true},
    
        },
        messages: {
                txt_descripcion: '*',
                txt_orden: '*',
                cmb_link: '*',
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
     if (trim($msg_error) == '')    $abike_secciones_obj=new abike_secciones;
     
    if ($_GET['operacion'] != OP_ALTA) {
        //Traigo los datos correspondientes con el id
        $abike_secciones_obj->id=$_GET['id'];
        $abike_secciones_obj->traer();
        if ($abike_secciones_obj->id!=$_GET['id']) die('No se encontraron datos');


        $op_desc="Modificacion de  secciones #".$_GET['id'];
    }else{
        $op_desc="Nuevos  secciones";
        $abike_secciones_obj->orden = $abike_secciones_obj->prox_orden();
        if (!isset($abike_secciones_obj->orden))
            $abike_secciones_obj->orden = 1;
    }

   echo "<form name='formulario'  id='formulario' method='post'   ENCTYPE='multipart/form-data'  action='abike_secciones_am.php?save=1&id=".$_GET['id']."&operacion=".$_GET['operacion']."&popup=".$_GET['popup']."'>";

    //Si grabo OK
    echo $msg_ok;
     
    //Si hubo error 
    echo $msg_error;
     
     
    echo "<header><h1> $op_desc </h1> <p>Completá todos los campos requeridos y presiona Guardar</p></header>";


    echo "<ul>
                      <li>
                            <label for='txt_descripcion'>Descripcion</label>
                            <input  type='text' name='txt_descripcion'  id='txt_descripcion'    value='".$abike_secciones_obj->descripcion."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Descripcion.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Descripcion !--> ";
                
            echo "
                      <li>
                            <label for='txt_bajada'>Bajada</label>
                        <br clear='all' /><div class='textarea'><textarea name='txt_bajada' id='txt_bajada' class='obligatorio'>". trim($abike_secciones_obj->bajada)."</textarea></div>
                      </li><!-- campo Bajada !--> ";
                
            echo "
                      <li>
                            <label for='txt_imagen'>Imagen</label>
                            <!--<label></label>!--><input type='file' class='form-tooltip' title='Cargue desde su pc el archivo.'  name='txt_imagen' id='txt_imagen'   >
                                            ".($abike_secciones_obj->imagen != '' ? "<img src='../".$abike_secciones_obj->imagen."' width='60' height='60' class='avatar small'/>":   '' )." 
                            <span class='tamanio'>Tamaño: 116 x 115</span>
                      </li><!-- campo Imagen !--> ";
                
            echo "
                      <li>
                            <label for='txt_orden'>Orden</label>
                            <input  type='text' name='txt_orden'  id='txt_orden'    value='".$abike_secciones_obj->orden."'   maxlength='20'  class='form-tooltip medium obligatorio' title='Ingrese el valor del Orden. Ej 234.45 (el punto separa los decimales) '>
                      </li><!-- campo Orden !--> ";
                
            echo "
                      <li>
                            <label for='cmb_link'>Link</label>
                            <select name='cmb_link'  id='cmb_link'>
                                <option value='contacto' " . ($abike_secciones_obj->link == "contacto" ? "selected" : "") ." class='form-tooltip long obligatorio' title='Seleccione el valor del Link'>Contacto</option>
                                <option value='tienda' " . ($abike_secciones_obj->link == "tienda" ? "selected" : "") ." class='form-tooltip long obligatorio' title='Seleccione el valor del Link'>Tienda</option>
                                <option value='servicios' " . ($abike_secciones_obj->link == "servicios" ? "selected" : "") ." class='form-tooltip long obligatorio' title='Seleccione el valor del Link'>Servicios</option>
                                <option value='noticias' " . ($abike_secciones_obj->link == "noticias" ? "selected" : "") ." class='form-tooltip long obligatorio' title='Seleccione el valor del Link'>Info Bike</option>
                            </select>
                      </li><!-- campo Link !--> ";
                
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
