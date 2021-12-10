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
    include_once '../includes/abike_sliders.php';
    
    
     //:::::::::::::::::::::::::::::::::::::::::::
     //     parámetros que recibe la pantalla 
     //     ------------------------------------
     //     $id     --> Indica el ID si es el caso de la operacion MOdificacion 
     //     $operacion        --> Indica el tipo de operacion 
     //:::::::::::::::::::::::::::::::::::::::::::
    
$abike_sliders_obj=new abike_sliders;
echo "<section id='am'>";
if ($_GET['save'] == 1) {
    
    
    
    $grabacion_rta="";
    
    if (trim($_POST['cmb_tipo']) == '')          $grabacion_rta.="<li>Debe ingresar Tipo </li>";
            
    if ($grabacion_rta == '') {
        $valida_save=true;
    }else{
        $valida_save=false;
        $msg_error ="<div class='msg-error'> <h1>Por favor, corrige los siguientes errores e intenta grabar nuevamente</h1><ul class='list'> $grabacion_rta </ul></div> ";
    }//del if
    
    $abike_sliders_obj->id=trim($_POST['txt_id']);
    $abike_sliders_obj->tipo=$_POST['cmb_tipo'];
    $abike_sliders_obj->imagen=trim($_POST['txt_imagen']);
    if ($valida_save) {
            
            if ($_GET['operacion'] != OP_ALTA) {
            
                //_______ Actualizo en la tabla ______
                $abike_sliders_obj->id=$_GET['id'];
                $abike_sliders_obj->update();

            }else{
        
                //_______ Agrego en la tabla ______
                $abike_sliders_obj->id=$abike_sliders_obj->add();
            }

                  $file_nuevo = $abike_sliders_obj->imagenes_subir('txt_imagen',$abike_sliders_obj->id);
                  if ( $file_nuevo!= '') $abike_sliders_obj->campo_update('imagen',$file_nuevo);


                // Guardo el mensaje de OK para mostrarlo
                $msg_ok ="<div class='ok'>  <h1>Se ha guardado correctamente! </h1></div> ";

            if ($_GET['operacion'] != OP_ALTA) {
                //Vuelvo al administrador
                // pagina_redireccionar("abike_sliders_adm.php?busca=1");
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
            window.location.href = 'abike_sliders_adm.php'; 
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
                                cmb_tipo: {required:true ,number: true},
    
        },
        messages: {
                cmb_tipo: '*',
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
     if (trim($msg_error) == '')    $abike_sliders_obj=new abike_sliders;
     
    if ($_GET['operacion'] != OP_ALTA) {
        //Traigo los datos correspondientes con el id
        $abike_sliders_obj->id=$_GET['id'];
        $abike_sliders_obj->traer();
        if ($abike_sliders_obj->id!=$_GET['id']) die('No se encontraron datos');


        $op_desc="Modificacion de  sliders #".$_GET['id'];
    }else{
        $op_desc="Nuevos  sliders";
    }

   echo "<form name='formulario'  id='formulario' method='post'   ENCTYPE='multipart/form-data'  action='abike_sliders_am.php?save=1&id=".$_GET['id']."&operacion=".$_GET['operacion']."&popup=".$_GET['popup']."'>";

    //Si grabo OK
    echo $msg_ok;
     
    //Si hubo error 
    echo $msg_error;
     
     
    echo "<header><h1> $op_desc </h1> <p>Completá todos los campos requeridos y presiona Guardar</p></header>";


    echo "<ul>
                      <li>
                            <label for='cmb_tipo'>Tipo</label>
                            <select name='cmb_tipo'  id='cmb_tipo'>
                                <option value='1' " . ($abike_sliders_obj->tipo == 1? "selected" : "") . " class='form-tooltip medium obligatorio' title='Seleccione el valor del Tipo'>Slider Principal</option>
                                <option value='2' " . ($abike_sliders_obj->tipo == 2? "selected" : "") . " class='form-tooltip medium obligatorio' title='Seleccione el valor del Tipo'>Imagen arriba de los servicios</option>
                                <option value='3' " . ($abike_sliders_obj->tipo == 3? "selected" : "") . " class='form-tooltip medium obligatorio' title='Seleccione el valor del Tipo'>Imagen arriba de las noticias</option>
                                <option value='4' " . ($abike_sliders_obj->tipo == 4? "selected" : "") . " class='form-tooltip medium obligatorio' title='Seleccione el valor del Tipo'>Imagen arriba del mapa</option>
                            </select>
                      </li><!-- campo Tipo !--> ";
                
            echo "
                      <li>
                            <label for='txt_imagen'>Imagen</label>
                            <!--<label></label>!--><input type='file' class='form-tooltip' title='Cargue desde su pc el archivo.'  name='txt_imagen' id='txt_imagen'   >
                                            ".($abike_sliders_obj->imagen != '' ? "<img src='../".$abike_sliders_obj->imagen."' width='60' height='60' class='avatar small'/>":   '' )." 
                                            <span class='tamanio'>Alto: 370 - Ancho: automático</span>
                      </li><!-- campo Imagen !--> ";
                
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
