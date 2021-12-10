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
    include_once '../includes/abike_noticias.php';
    
    
     //:::::::::::::::::::::::::::::::::::::::::::
     //     parámetros que recibe la pantalla 
     //     ------------------------------------
     //     $id     --> Indica el ID si es el caso de la operacion MOdificacion 
     //     $operacion        --> Indica el tipo de operacion 
     //:::::::::::::::::::::::::::::::::::::::::::
    
$abike_noticias_obj=new abike_noticias;
echo "<section id='am'>";

if ($_GET['elimina'] == 1) { 
        // Creo el objeto abike_noticias
        // $abike_noticias_obj = new abike_noticias;
        $abike_noticias_obj->id = $_GET['id'];
        $abike_noticias_obj->icono=false;
        $abike_noticias_obj->imagen=false;

        switch ($_GET['campo']) {
          case 'txt_imagen':
            $abike_noticias_obj->imagen=true;
            break;
          case 'txt_icono':
            $abike_noticias_obj->icono=true;
            break;
        }

        $abike_noticias_obj->remove_imagen();
} 


if ($_GET['save'] == 1) {
    
    
    
    $grabacion_rta="";
    
    if (trim($_POST['txt_descripcion']) == '')          $grabacion_rta.="<li>Debe ingresar Descripcion </li>";
    if (trim($_POST['txt_bajada']) == '')          $grabacion_rta.="<li>Debe ingresar Bajada </li>";
//    if (trim($_POST['txt_porcentaje']) == '')          $grabacion_rta.="<li>Debe ingresar Porcentaje </li>";
    if (trim($_POST['txt_cuerpo']) == '')          $grabacion_rta.="<li>Debe ingresar Cuerpo </li>";
    if (trim($_POST['txt_fuente']) == '')          $grabacion_rta.="<li>Debe ingresar Fuente </li>";
            
    if ($grabacion_rta == '') {
        $valida_save=true;
    }else{
        $valida_save=false;
        $msg_error ="<div class='msg-error'> <h1>Por favor, corrige los siguientes errores e intenta grabar nuevamente</h1><ul class='list'> $grabacion_rta </ul></div> ";
    }//del if
    
    $abike_noticias_obj->id=trim($_POST['txt_id']);
    $abike_noticias_obj->descripcion=trim($_POST['txt_descripcion']);
    $abike_noticias_obj->bajada=trim($_POST['txt_bajada']);
    $abike_noticias_obj->porcentaje=trim($_POST['txt_porcentaje']);
    $abike_noticias_obj->cuerpo=trim($_POST['txt_cuerpo']);
    $abike_noticias_obj->imagen=trim($_POST['txt_imagen']);
    $abike_noticias_obj->fuente=trim($_POST['txt_fuente']);
    $abike_noticias_obj->icono=trim($_POST['txt_icono']);

    if ($valida_save) {
            
            if ($_GET['operacion'] != OP_ALTA) {
            
                //_______ Actualizo en la tabla ______
                $abike_noticias_obj->id=$_GET['id'];
                $abike_noticias_obj->update();

            }else{
        
                //_______ Agrego en la tabla ______
                $abike_noticias_obj->id=$abike_noticias_obj->add();
            }
                  $file_nuevo = $abike_noticias_obj->imagenes_subir('txt_icono',$abike_noticias_obj->id);
                  if ( $file_nuevo!= '') $abike_noticias_obj->campo_update('icono',$file_nuevo);

                  $file_nuevo = $abike_noticias_obj->imagenes_subir('txt_imagen',$abike_noticias_obj->id);
                  if ( $file_nuevo!= '') $abike_noticias_obj->campo_update('imagen',$file_nuevo);


                // Guardo el mensaje de OK para mostrarlo
                $msg_ok ="<div class='ok'>  <h1>Se ha guardado correctamente! </h1></div> ";

            if ($_GET['operacion'] != OP_ALTA) {
                //Vuelvo al administrador
                // pagina_redireccionar("abike_noticias_adm.php?busca=1");
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
            window.location.href = 'abike_noticias_adm.php'; 
        });
        //-->  SAVE <--
        $('#btn-guardar').click(function() {
                $('#btn-guardar').hide();
                $('#btn-guardar-loading').show();
                $('#formulario').submit();
        });

       <? if ($_GET['operacion'] != OP_ALTA) { ?>
          //-->  ELIMINAR IMAGEN <--
          $('a.delete').click(function eliminar() {
              var campo = $(this).attr('campo');

              smoke.confirm('Confirma que desea eliminar la imagen ?',function(e){
              if (e){
                  document.location = 'abike_noticias_am.php?elimina=1&campo='+campo+'&id='+<? print $_GET['id']; ?>;
                  }
              });
          });
        <? } ?>
    
    
    /** validate form on keyup and submit **/
    $('#formulario').validate({
         errorPlacement: function(error, element) { /*ocultar mensajes*/},   
        rules: {
                                txt_descripcion: {required:true  },
    
                                txt_bajada: {required:true  },
    
//                                txt_porcentaje: {required:true  },
    
    
                                txt_fuente: {required:true  },
    
        },
        messages: {
                txt_descripcion: '*',
                txt_bajada: '*',
//                txt_porcentaje: '*',
                txt_fuente: '*',
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
     if (trim($msg_error) == '')    $abike_noticias_obj=new abike_noticias;
     
    if ($_GET['operacion'] != OP_ALTA) {
        //Traigo los datos correspondientes con el id
        $abike_noticias_obj->id=$_GET['id'];
        $abike_noticias_obj->traer();
        if ($abike_noticias_obj->id!=$_GET['id']) die('No se encontraron datos');


        $op_desc="Modificacion de  noticias #".$_GET['id'];
    }else{
        $op_desc="Nuevos  noticias";
    }

   echo "<form name='formulario'  id='formulario' method='post'   ENCTYPE='multipart/form-data'  action='abike_noticias_am.php?save=1&id=".$_GET['id']."&operacion=".$_GET['operacion']."&popup=".$_GET['popup']."'>";

    //Si grabo OK
    echo $msg_ok;
     
    //Si hubo error 
    echo $msg_error;
     
     
    echo "<header><h1> $op_desc </h1> <p>Completá todos los campos requeridos y presiona Guardar</p></header>";


    echo "<ul>
                      <li>
                            <label for='txt_descripcion'>Descripcion</label>
                            <input  type='text' name='txt_descripcion'  id='txt_descripcion'    value='".$abike_noticias_obj->descripcion."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Descripcion.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Descripcion !--> ";

            echo "
                      <li>
                            <label for='txt_icono'>Icono</label>
                            <!--<label></label>!--><input type='file' class='form-tooltip' title='Cargue desde su pc el archivo.'  name='txt_icono' id='txt_icono'   >
                                            ".($abike_noticias_obj->icono != '' ? "<img src='../".$abike_noticias_obj->icono."' width='60' height='60' class='avatar small'/>":   '' )." 
                                            ".($abike_noticias_obj->icono != '' ? "<a class='delete' campo='txt_icono' href='#'>Quitar</a>":   '' )." 
                                            <span class='tamanio'>Tamaño: 53 x 55</span>
                      </li><!-- campo Icono !--> ";          
                
            echo "
                      <li>
                            <label for='txt_bajada'>Bajada</label>
                            <input  type='text' name='txt_bajada'  id='txt_bajada'    value='".$abike_noticias_obj->bajada."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Bajada.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Bajada !--> ";
                
            echo "
                      <li>
                            <label for='txt_porcentaje'>Porcentaje</label>
                            <input  type='text' name='txt_porcentaje'  id='txt_porcentaje'    value='".$abike_noticias_obj->porcentaje."'   maxlength='255'  class='form-tooltip small' placeholder='ej. 75%' title='Ingrese el texto del Porcentaje.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Porcentaje !--> ";
                
            echo "
                      <li>
                            <label for='txt_cuerpo'>Cuerpo</label>
                        <br clear='all' /><div class='textarea'><textarea name='txt_cuerpo' id='txt_cuerpo' class='obligatorio'>". trim($abike_noticias_obj->cuerpo)."</textarea></div>
                      </li><!-- campo Cuerpo !--> ";
                
            echo "
                      <li>
                            <label for='txt_imagen'>Imagen</label>
                            <!--<label></label>!--><input type='file' class='form-tooltip' title='Cargue desde su pc el archivo.'  name='txt_imagen' id='txt_imagen'   >
                                            ".($abike_noticias_obj->imagen != '' ? "<img src='../".$abike_noticias_obj->imagen."' width='60' height='60' class='avatar small'/>":   '' )." 
                                            ".($abike_noticias_obj->imagen != '' ? "<a class='delete' campo='txt_imagen' href='#'>Quitar</a>":   '' )." 
                             <span class='tamanio'>Tamaño: 430 x 447</span>
                      </li><!-- campo Imagen !--> ";
                
            echo "
                      <li>
                            <label for='txt_fuente'>Fuente</label>
                            <input  type='text' name='txt_fuente'  id='txt_fuente'    value='".$abike_noticias_obj->fuente."'   maxlength='255'  class='form-tooltip long obligatorio' placeholder='Ingrese el texto' title='Ingrese el texto del Fuente.Puede ingresar hasta 255 caracteres'>
                      </li><!-- campo Fuente !--> ";
                
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
