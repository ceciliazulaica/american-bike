<? $header['title']= '';
    $header['description']= '';
    $header['keywords']= '';
 include_once 'header.php';
    include_once '../includes/abike_noticias.php';
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
        // Creo el objeto abike_noticias
        $abike_noticias_obj = new abike_noticias;
        $abike_noticias_obj->id = $_GET['id'];
        $abike_noticias_obj->delete();
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
                document.location = 'abike_noticias_adm.php?elimina=1&id='+id+'&pagina='+pagina;
                }
            });
        }
        
        
    </script><?
    
    
    
    
    $tabindex=0;
    ?>
    
<section id='adm'>
 <div id='buscador'>
    <form name='me' method='post' action='abike_noticias_adm.php?busca=1' >
    <h1>Busqueda Avanzada </h1>
    <h2>Seleccione un parámetro de búsqueda</h2>
    
    <ul>
                <li><label for='txt_descripcion' >Descripcion</label>
                      <input type='text' name='txt_descripcion' id='txt_descripcion'   value='<?= $_POST['txt_descripcion'];?>'    >
                           
                </li><!-- campo descripcion!-->
                
                <li><label for='txt_bajada' >Bajada</label>
                      <input type='text' name='txt_bajada' id='txt_bajada'   value='<?= $_POST['txt_bajada'];?>'    >
                           
                </li><!-- campo bajada!-->
                
                <li><label for='txt_porcentaje' >Porcentaje</label>
                      <input type='text' name='txt_porcentaje' id='txt_porcentaje'   value='<?= $_POST['txt_porcentaje'];?>'    >
                           
                </li><!-- campo porcentaje!-->
                
                
                <li><label for='txt_fuente' >Fuente</label>
                      <input type='text' name='txt_fuente' id='txt_fuente'   value='<?= $_POST['txt_fuente'];?>'    >
                           
                </li><!-- campo fuente!-->
                
                <li class='botones'><input type='submit' name='bt_submit' class='submit' value='Buscar' id='bt_submit' ></li>
    </ul>
    
   </form>
    
   </div><!-- buscador !--> 
    
  <div id='listado'>  

     <?         // ====== Xls ============
                define ('SEPARADOR',';');
                $file_name = 'reportes/noticias_'.date('d-m-Y_h-i').'.xls';
                $_SESSION['sess_reporte_vec']=array();
                $_SESSION['sess_reporte_vec']['file_name']=$file_name;
                $_SESSION['sess_reporte_vec']['reporte']= $reporte_vec = array();
                //Creo la primer solapa del libro
                $worksheet_num = 0;
                $reporte_vec[$worksheet_num]['nombre']=' noticias';
                $reporte_vec[$worksheet_num]['contenido']=$reporte_contenido=array();
                $reporte_fila=1;


     //if ($_GET['busca'] == 1) {
    
            //:::::::::::::::::::::::::::::::::::::::::::
            //              Consulta 
            //:::::::::::::::::::::::::::::::::::::::::::
            //Creo el objeto abike_noticias
            $abike_noticias_obj = new abike_noticias;
            $abike_noticias_obj->id = $_POST['txt_id'];
            $abike_noticias_obj->descripcion = $_POST['txt_descripcion'];
            $abike_noticias_obj->bajada = $_POST['txt_bajada'];
            $abike_noticias_obj->porcentaje = $_POST['txt_porcentaje'];
            $abike_noticias_obj->fuente = $_POST['txt_fuente'];


            //******** Incluyo para exportar TODO*/
            $_SESSION['sess_reporte_vec']['objeto']       =  serialize($abike_noticias_obj);
            $_SESSION['sess_reporte_vec']['objeto_name']   =  'abike_noticias';
            //******** Incluyo para exportar TODO*/


            // Controlo la paginacion 
            $pagina = intval($_GET['pagina']); 
            $registros = 100; 
            $total_registros=$abike_noticias_obj->cant_traer();
            $total_paginas = ceil($total_registros / $registros);
           $abike_noticias_obj->traer($pagina,$registros);

           $cant=count($abike_noticias_obj->resultados_vec);
     //}
?>
    <h1> Noticias</h1>
 <?   if ($total_paginas>1) paginador_generico('abike_noticias_adm.php',$_GET['pagina'],$total_registros,$registros); ?>
    <a id='add' href='abike_noticias_am.php?operacion=<? echo OP_ALTA; ?>'> &nbsp; Añadir un nuevo registro</a>
    <table align="center"   class="example table-autosort:99" ><thead>
          <tr class='tabla_cabe'>
              <th class="table-sortable:default">Descripcion</th>
              <th class="table-sortable:default">Bajada</th>
              <th class="table-sortable:default">Porcentaje</th>
              <th class="table-sortable:default">Cuerpo</th>
              <th class="table-sortable:default">Fuente</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
                  


          </tr></thead><tbody>
<?
     //if ($_GET['busca'] == 1) {

           for ($i=0;$i<$cant;$i++) {
            echo "<tr>
                      <td ><a href='abike_noticias_am.php?id=".$abike_noticias_obj->resultados_vec[$i]['id']."&operacion=".OP_UPDATE."'>".$abike_noticias_obj->resultados_vec[$i]['descripcion']."</a></td>
                      <td >".$abike_noticias_obj->resultados_vec[$i]['bajada']."</td>
                      <td >".$abike_noticias_obj->resultados_vec[$i]['porcentaje']."</td>
                      <td >".$abike_noticias_obj->resultados_vec[$i]['cuerpo']."</td>
                      <td >".$abike_noticias_obj->resultados_vec[$i]['fuente']."</td>
                      <td ><a href='abike_noticias_am.php?id=".$abike_noticias_obj->resultados_vec[$i]['id']."&operacion=".OP_UPDATE."'><img src='imagenes/ico_edit.png' border='0' alt='Modificar'  title='Modificar'></a></td>
                      <td >";?><a href='#' onClick="eliminar(<? echo $abike_noticias_obj->resultados_vec[$i]['id']?>,'<? echo $abike_noticias_obj->resultados_vec[$i]['descripcion']?>',<?=intval($_GET['pagina']);?>)"><img src='imagenes/img_papelera.png' border='0' alt='Eliminar' title='Eliminar '></a></td><? echo "
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
