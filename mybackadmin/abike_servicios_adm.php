<? $header['title']= '';
    $header['description']= '';
    $header['keywords']= '';
 include_once 'header.php';
    include_once '../includes/abike_servicios.php';
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
        // Creo el objeto abike_servicios
        $abike_servicios_obj = new abike_servicios;
        $abike_servicios_obj->id = $_GET['id'];
        $abike_servicios_obj->delete();
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
                document.location = 'abike_servicios_adm.php?elimina=1&id='+id+'&pagina='+pagina;
                }
            });
        }
        
        
    </script><?
    
    
    
    
    $tabindex=0;
    ?>
    
<section id='adm'>
 <div id='buscador'>
    <form name='me' method='post' action='abike_servicios_adm.php?busca=1' >
    <h1>Busqueda Avanzada </h1>
    <h2>Seleccione un parámetro de búsqueda</h2>
    
    <ul>
                <li><label for='txt_descripcion' >Descripcion</label>
                      <input type='text' name='txt_descripcion' id='txt_descripcion'   value='<?= $_POST['txt_descripcion'];?>'    >
                           
                </li><!-- campo descripcion!-->
                
                
                <li><label for='txt_nro' >Nro</label>
                      <input type='text' name='txt_nro' id='txt_nro'   value='<?= $_POST['txt_nro'];?>'    >
                           
                </li><!-- campo nro!-->
                
                <li class='botones'><input type='submit' name='bt_submit' class='submit' value='Buscar' id='bt_submit' ></li>
    </ul>
    
   </form>
    
   </div><!-- buscador !--> 
    
  <div id='listado'>  

     <?         // ====== Xls ============
                define ('SEPARADOR',';');
                $file_name = 'reportes/servicios_'.date('d-m-Y_h-i').'.xls';
                $_SESSION['sess_reporte_vec']=array();
                $_SESSION['sess_reporte_vec']['file_name']=$file_name;
                $_SESSION['sess_reporte_vec']['reporte']= $reporte_vec = array();
                //Creo la primer solapa del libro
                $worksheet_num = 0;
                $reporte_vec[$worksheet_num]['nombre']=' servicios';
                $reporte_vec[$worksheet_num]['contenido']=$reporte_contenido=array();
                $reporte_fila=1;


     //if ($_GET['busca'] == 1) {
    
            //:::::::::::::::::::::::::::::::::::::::::::
            //              Consulta 
            //:::::::::::::::::::::::::::::::::::::::::::
            //Creo el objeto abike_servicios
            $abike_servicios_obj = new abike_servicios;
            $abike_servicios_obj->id = $_POST['txt_id'];
            $abike_servicios_obj->descripcion = $_POST['txt_descripcion'];
            $abike_servicios_obj->nro = $_POST['txt_nro'];


            //******** Incluyo para exportar TODO*/
            $_SESSION['sess_reporte_vec']['objeto']       =  serialize($abike_servicios_obj);
            $_SESSION['sess_reporte_vec']['objeto_name']   =  'abike_servicios';
            //******** Incluyo para exportar TODO*/


            // Controlo la paginacion 
            $pagina = intval($_GET['pagina']); 
            $registros = 100; 
            $total_registros=$abike_servicios_obj->cant_traer();
            $total_paginas = ceil($total_registros / $registros);
           $abike_servicios_obj->traer($pagina,$registros);

           $cant=count($abike_servicios_obj->resultados_vec);
     //}
?>
    <h1> Servicios</h1>
 <?   if ($total_paginas>1) paginador_generico('abike_servicios_adm.php',$_GET['pagina'],$total_registros,$registros); ?>
 <?php if ($cant < 3) { ?>
    <a id='add' href='abike_servicios_am.php?operacion=<? echo OP_ALTA; ?>'> &nbsp; Añadir un nuevo registro</a>
 <?php } ?>
    <table align="center"   class="example table-autosort:99" ><thead>
          <tr class='tabla_cabe'>
              <th class="table-sortable:default">Descripcion</th>
              <th class="table-sortable:default">Detalle</th>
              <th class="table-sortable:default">Nro</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
                  


          </tr></thead><tbody>
<?
     //if ($_GET['busca'] == 1) {

           for ($i=0;$i<$cant;$i++) {
            echo "<tr>
                      <td ><a href='abike_servicios_am.php?id=".$abike_servicios_obj->resultados_vec[$i]['id']."&operacion=".OP_UPDATE."'>".$abike_servicios_obj->resultados_vec[$i]['descripcion']."</a></td>
                      <td >".$abike_servicios_obj->resultados_vec[$i]['detalle']."</td>
                      <td >".$abike_servicios_obj->resultados_vec[$i]['nro']."</td>
                      <td ><a href='abike_servicios_am.php?id=".$abike_servicios_obj->resultados_vec[$i]['id']."&operacion=".OP_UPDATE."'><img src='imagenes/ico_edit.png' border='0' alt='Modificar'  title='Modificar'></a></td>
                      <td >";?><a href='#' onClick="eliminar(<? echo $abike_servicios_obj->resultados_vec[$i]['id']?>,'<? echo $abike_servicios_obj->resultados_vec[$i]['descripcion']?>',<?=intval($_GET['pagina']);?>)"><img src='imagenes/img_papelera.png' border='0' alt='Eliminar' title='Eliminar '></a></td><? echo "
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
