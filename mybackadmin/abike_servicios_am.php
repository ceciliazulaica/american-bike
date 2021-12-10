<? $header['title']= '';
    $header['description']= '';
    $header['keywords']= '';
 include_once 'header.php';
    include_once '../includes/abike_servicios.php';
    
    
     //:::::::::::::::::::::::::::::::::::::::::::
     //     parámetros que recibe la pantalla 
     //     ------------------------------------
     //     $id     --> Indica el ID si es el caso de la operacion MOdificacion 
     //     $operacion        --> Indica el tipo de operacion 
     //:::::::::::::::::::::::::::::::::::::::::::
    
$abike_servicios_obj=new abike_servicios;
echo "<section id='am'>";
if ($_GET['save'] == 1) {
    
    
    
    $grabacion_rta="";
    
    if (trim($_POST['txt_descripcion']) == '')          $grabacion_rta.="<li>Debe ingresar Descripcion </li>";
    if (trim($_POST['txt_detalle']) == '')          $grabacion_rta.="<li>Debe ingresar Detalle </li>";
    if (trim($_POST['cmb_nro']) == '')          $grabacion_rta.="<li>Debe ingresar Nro </li>";
            
    if (($_GET['operacion'] == OP_ALTA) && ($abike_servicios_obj->cant_traer() >=3)) $grabacion_rta.="<li>No puede grabar más de 3 servicios</li>";

    if ($grabacion_rta == '') {
        $valida_save=true;
    }else{
        $valida_save=false;
        $msg_error ="<div class='msg-error'> <h1>Por favor, corrige los siguientes errores e intenta grabar nuevamente</h1><ul class='list'> $grabacion_rta </ul></div> ";
    }//del if

    
    $abike_servicios_obj->id=trim($_POST['txt_id']);
    $abike_servicios_obj->descripcion=trim($_POST['txt_descripcion']);
    $abike_servicios_obj->detalle=trim($_POST['txt_detalle']);
    $abike_servicios_obj->nro=$_POST['cmb_nro'];
    if ($valida_save) {
            
            if ($_GET['operacion'] != OP_ALTA) {
            
                //_______ Actualizo en la tabla ______
                $abike_servicios_obj->id=$_GET['id'];
                $abike_servicios_obj->update();

            }else{
        
                //_______ Agrego en la tabla ______
                $abike_servicios_obj->id=$abike_servicios_obj->add();
            }



                // Guardo el mensaje de OK para mostrarlo
                $msg_ok ="<div class='ok'>  <h1>Se ha guardado correctamente! </h1></div> ";

            if ($_GET['operacion'] != OP_ALTA) {
                //Vuelvo al administrador
                // pagina_redireccionar("abike_servicios_adm.php?busca=1");
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
            window.location.href = 'abike_servicios_adm.php'; 
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
    
    
                                cmb_nro: {required:true ,number: true},
    
        },
        messages: {
                txt_descripcion: '*',
                cmb_nro: '*',
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
     if (trim($msg_error) == '')    $abike_servicios_obj=new abike_servicios;
     
    if ($_GET['operacion'] != OP_ALTA) {
        //Traigo los datos correspondientes con el id
        $abike_servicios_obj->id=$_GET['id'];
        $abike_servicios_obj->traer();
        if ($abike_servicios_obj->id!=$_GET['id']) die('No se encontraron datos');


        $op_desc="Modificacion de  servicios #".$_GET['id'];
    }else{
        $op_desc="Nuevos  servicios";
    }

   echo "<form name='formulario'  id='formulario' method='post'   ENCTYPE='multipart/form-data'  action='abike_servicios_am.php?save=1&id=".$_GET['id']."&operacion=".$_GET['operacion']."&popup=".$_GET['popup']."'>";

    //Si grabo OK
    echo $msg_ok;
     
    //Si hubo error 
    echo $msg_error;
     
     
    echo "<header><h1> $op_desc </h1> <p>Completá todos los campos requeridos y presiona Guardar</p></header>";


    echo "<ul>
                      <li>
                            <label for='txt_descripcion'>Descripcion</label>
                            <input  type='text' name='txt_descripcion'  id='txt_descripcion'    value='".$abike_servicios_obj->descripcion."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Descripcion.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Descripcion !--> ";
                
            echo "
                      <li>
                            <label for='txt_detalle'>Detalle</label>
                        <br clear='all' /><div class='textarea'><textarea name='txt_detalle' id='txt_detalle' class='obligatorio'>". trim($abike_servicios_obj->detalle)."</textarea></div>
                      </li><!-- campo Detalle !--> ";
                
            echo "
                      <li>
                            <label for='cmb_nro'>Nro</label>
                            <select name='cmb_nro'  id='cmb_nro'>
                                <option value='1' " . ($abike_servicios_obj->nro == 1 ? "selected" : "") . " class='form-tooltip medium obligatorio' title='Seleccione el valor del Nro.'>1</option>
                                <option value='2' " . ($abike_servicios_obj->nro == 2 ? "selected" : "") . " class='form-tooltip medium obligatorio' title='Seleccione el valor del Nro.'>2</option>
                                <option value='3' " . ($abike_servicios_obj->nro == 3 ? "selected" : "") . " class='form-tooltip medium obligatorio' title='Seleccione el valor del Nro.'>3</option>
                            </select>
                      </li><!-- campo Nro !--> ";
                
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
