<? $header['title']= '';
    $header['description']= '';
    $header['keywords']= '';
 include_once 'header.php';
    include_once '../includes/abike_configuracion.php';
    include_once "../includes/form_inc_lib.php";
    
     //:::::::::::::::::::::::::::::::::::::::::::
     //     parámetros que recibe la pantalla 
     //     ------------------------------------
     //     $busca == 1   --> Realiza la búsqueda 
     //     $pagina  --> indica desde donde pagina 
     //:::::::::::::::::::::::::::::::::::::::::::
    // para la paginacion
    if (intval($_GET['pagina']) != 0) $_POST = $_SESSION['sess_busqueda'];
    
    // Guardo para el paginado las condiciones
    if (version_compare(phpversion(), '5.4.2', '<')) @session_register('sess_busqueda');
    $_SESSION['sess_busqueda']=$_POST;
    
    if ($_GET['elimina'] == 1) { 
        // Creo el objeto abike_configuracion
        $abike_configuracion_obj = new abike_configuracion;
        $abike_configuracion_obj->id = $_GET['id'];
        $abike_configuracion_obj->delete();
    } 
    
    ?><script type='text/JavaScript'>
    $(document).ready(function() {
        //-->  Imprimir <--
        $('#imprimir').click(function() {
            imprimir_div('listado'); 
        });
   });
    
        function eliminar(id,descripcion,pagina) {
            smoke.confirm('Confirma que desea eliminar: '+ descripcion + '?',function(e){
            if (e){
                document.location = 'abike_configuracion_adm.php?elimina=1&id='+id+'&pagina='+pagina;
                }
            });
        }
        
        
    </script><?
    
    
    
    
    $tabindex=0;
    ?>
    
<section id='adm'>
 <div id='buscador'>
    <form name='me' method='post' action='abike_configuracion_adm.php?busca=1' >
    <h1>Busqueda Avanzada </h1>
    <h2>Seleccione un parámetro de búsqueda</h2>
    
    <ul>
                <li><label for='txt_frase_top' >Frase top</label>
                      <input type='text' name='txt_frase_top' id='txt_frase_top'   value='<?= $_POST['txt_frase_top'];?>'    >
                           
                </li><!-- campo frase_top!-->
                
                <li><label for='txt_direccion' >Direccion</label>
                      <input type='text' name='txt_direccion' id='txt_direccion'   value='<?= $_POST['txt_direccion'];?>'    >
                           
                </li><!-- campo direccion!-->
                
                <li><label for='txt_telefono' >Telefono</label>
                      <input type='text' name='txt_telefono' id='txt_telefono'   value='<?= $_POST['txt_telefono'];?>'    >
                           
                </li><!-- campo telefono!-->
                
                <li><label for='txt_email' >Email</label>
                      <input type='text' name='txt_email' id='txt_email'   value='<?= $_POST['txt_email'];?>'    >
                           
                </li><!-- campo email!-->
                
                <li><label for='txt_contacto_email' >Contacto email</label>
                      <input type='text' name='txt_contacto_email' id='txt_contacto_email'   value='<?= $_POST['txt_contacto_email'];?>'    >
                           
                </li><!-- campo contacto_email!-->
                
                
                <li class='botones'><input type='submit' name='bt_submit' class='submit' value='Buscar' id='bt_submit' ></li>
    </ul>
    
   </form>
    
   </div><!-- buscador !--> 
    
  <div id='listado'>  

     <?         // ====== Xls ============
                define ('SEPARADOR',';');
                $file_name = 'reportes/configuracion_'.date('d-m-Y_h-i').'.xls';
                $_SESSION['sess_reporte_vec']=array();
                $_SESSION['sess_reporte_vec']['file_name']=$file_name;
                $_SESSION['sess_reporte_vec']['reporte']= $reporte_vec = array();
                //Creo la primer solapa del libro
                $worksheet_num = 0;
                $reporte_vec[$worksheet_num]['nombre']=' configuracion';
                $reporte_vec[$worksheet_num]['contenido']=$reporte_contenido=array();
                $reporte_fila=1;


     //if ($_GET['busca'] == 1) {
    
            //:::::::::::::::::::::::::::::::::::::::::::
            //              Consulta 
            //:::::::::::::::::::::::::::::::::::::::::::
            //Creo el objeto abike_configuracion
            $abike_configuracion_obj = new abike_configuracion;
            $abike_configuracion_obj->id = $_POST['txt_id'];
            $abike_configuracion_obj->frase_top = $_POST['txt_frase_top'];
            $abike_configuracion_obj->direccion = $_POST['txt_direccion'];
            $abike_configuracion_obj->telefono = $_POST['txt_telefono'];
            $abike_configuracion_obj->email = $_POST['txt_email'];
            $abike_configuracion_obj->contacto_email = $_POST['txt_contacto_email'];


            //******** Incluyo para exportar TODO*/
            $_SESSION['sess_reporte_vec']['objeto']       =  serialize($abike_configuracion_obj);
            $_SESSION['sess_reporte_vec']['objeto_name']   =  'abike_configuracion';
            //******** Incluyo para exportar TODO*/


            // Controlo la paginacion 
            $pagina = intval($_GET['pagina']); 
            $registros = 100; 
            $total_registros=$abike_configuracion_obj->cant_traer();
            $total_paginas = ceil($total_registros / $registros);
           $abike_configuracion_obj->traer($pagina,$registros);

           $cant=count($abike_configuracion_obj->resultados_vec);
     //}
?>
    <h1> Configuracion</h1>
 <?   if ($total_paginas>1) paginador_generico('abike_configuracion_adm.php',$_GET['pagina'],$total_registros,$registros); ?>
    <a id='add' href='abike_configuracion_am.php?operacion=<? echo OP_ALTA; ?>'> &nbsp; Añadir un nuevo registro</a>
    <table align="center"   class="example table-autosort:99" ><thead>
          <tr class='tabla_cabe'>
              <th class="table-sortable:default">Frase top</th>
              <th class="table-sortable:default">Direccion</th>
              <th class="table-sortable:default">Telefono</th>
              <th class="table-sortable:default">Email</th>
              <th class="table-sortable:default">Contacto email</th>
              <th class="table-sortable:default">Contacto texto</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
                  


          </tr></thead><tbody>
<?
     //if ($_GET['busca'] == 1) {

           for ($i=0;$i<$cant;$i++) {
            echo "<tr>
                      <td ><a href='abike_configuracion_am.php?id=".$abike_configuracion_obj->resultados_vec[$i]['id']."&operacion=".OP_UPDATE."'>".$abike_configuracion_obj->resultados_vec[$i]['frase_top']."</a></td>
                      <td >".$abike_configuracion_obj->resultados_vec[$i]['direccion']."</td>
                      <td >".$abike_configuracion_obj->resultados_vec[$i]['telefono']."</td>
                      <td >".$abike_configuracion_obj->resultados_vec[$i]['email']."</td>
                      <td >".$abike_configuracion_obj->resultados_vec[$i]['contacto_email']."</td>
                      <td >".$abike_configuracion_obj->resultados_vec[$i]['contacto_texto']."</td>
                      <td ><a href='abike_configuracion_am.php?id=".$abike_configuracion_obj->resultados_vec[$i]['id']."&operacion=".OP_UPDATE."'><img src='imagenes/ico_edit.png' border='0' alt='Modificar'  title='Modificar'></a></td>
                      <td >";?><a href='#' onClick="eliminar(<? echo $abike_configuracion_obj->resultados_vec[$i]['id']?>,'<? echo $abike_configuracion_obj->resultados_vec[$i]['descripcion']?>',<?=intval($_GET['pagina']);?>)"><img src='imagenes/img_papelera.png' border='0' alt='Eliminar' title='Eliminar '></a></td><? echo "
                  </tr>";
                  

           }//del for 

     // }// del if de si busca
    $reporte_vec[$worksheet_num]['contenido']=$reporte_contenido;
    $_SESSION['sess_reporte_vec']['reporte']= $reporte_vec;
?>
    </tbody></table >
 
 
 
    <ul class='herramientas'><li><a id='imprimir'>&nbsp;Imprimir</a></li><li><a href='../includes/excel_export_objetos.php' target='_blank' id='exportar-xls'>Descargar en xls</a></li></ul>
 </div><!-- listados !-->
 </section><!-- adm !-->
   <? include_once 'footer.php'; ?>
