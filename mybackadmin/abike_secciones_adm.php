<? $header['title']= '';
    $header['description']= '';
    $header['keywords']= '';
 include_once 'header.php';
    include_once '../includes/abike_secciones.php';
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
        // Creo el objeto abike_secciones
        $abike_secciones_obj = new abike_secciones;
        $abike_secciones_obj->id = $_GET['id'];
        $abike_secciones_obj->delete();
    } 

    if ($_GET['guardar_orden'] == 1) {
        // Creo el objeto 
        $abike_secciones_obj = new abike_secciones;
        $abike_secciones_obj->guardar_orden($_POST['id_list']);
    }
    
    ?><script type='text/JavaScript'>
    $(document).ready(function() {
        //-->  Imprimir <--
        $('#imprimir').click(function() {
            imprimir_div('listado'); 
        });
    
// Ordenar una tabla sin el problema del ancho.
// http://stackoverflow.com/questions/1307705/jquery-ui-sortable-with-table-and-tr-width/16687620#16687620

        $('td, th', '#ordenable').each(function () {
            var cell = $(this);
            cell.width(cell.width());
        });

        $('#ordenable tbody').sortable({
                items: '> tr',
                forcePlaceholderSize: true,
                placeholder:'must-have-class',
                start: function (event, ui) {
                    // Build a placeholder cell that spans all the cells in the row
                    var cellCount = 0;
                    $('td, th', ui.helper).each(function () {
                        // For each TD or TH try and get it's colspan attribute, and add that or 1 to the total
                        var colspan = 1;
                        var colspanAttr = $(this).attr('colspan');
                        if (colspanAttr > 1) {
                            colspan = colspanAttr;
                        }
                        cellCount += colspan;
                    });

                    // Add the placeholder UI - note that this is the item's content, so TD rather thanTR
                    ui.placeholder.html('<td colspan="' + cellCount + '">&nbsp;</td>');
                }
                }).disableSelection();

   });

        function guardar_orden(offset) {
                var id_list= new Array();
                var i = offset;
                $('#ordenable tbody>tr').each(function(i,e){
                    id_list[i] = $(this).find('.ordenable_id').attr('id');
                    i++;
                });
                $.post('abike_secciones_adm.php?guardar_orden=1', {'id_list': id_list}, function (e){smoke.alert("Ya se ha actualizado el orden");});
            };

        function eliminar(id,descripcion,pagina) {
            smoke.confirm('Confirma que desea eliminar: '+ descripcion + '?',function(e){
            if (e){
                document.location = 'abike_secciones_adm.php?elimina=1&id='+id+'&pagina='+pagina;
                }
            });
        }
        
        
    </script><?
    
    
    
    
    $tabindex=0;
    ?>
    
<section id='adm'>
 <div id='buscador'>
    <form name='me' method='post' action='abike_secciones_adm.php?busca=1' >
    <h1>Busqueda Avanzada </h1>
    <h2>Seleccione un parámetro de búsqueda</h2>
    
    <ul>
                <li><label for='txt_descripcion' >Descripcion</label>
                      <input type='text' name='txt_descripcion' id='txt_descripcion'   value='<?= $_POST['txt_descripcion'];?>'    >
                           
                </li><!-- campo descripcion!-->
                
                
                <li><label for='txt_orden' >Orden</label>
                      <input type='text' name='txt_orden' id='txt_orden'   value='<?= $_POST['txt_orden'];?>'    >
                           
                </li><!-- campo orden!-->
                
                <li><label for='txt_link' >Link</label>
                      <input type='text' name='txt_link' id='txt_link'   value='<?= $_POST['txt_link'];?>'    >
                           
                </li><!-- campo link!-->
                
                <li class='botones'><input type='submit' name='bt_submit' class='submit' value='Buscar' id='bt_submit' ></li>
    </ul>
    
   </form>
    
   </div><!-- buscador !--> 
    
  <div id='listado'>  

     <?         // ====== Xls ============
                define ('SEPARADOR',';');
                $file_name = 'reportes/secciones_'.date('d-m-Y_h-i').'.xls';
                $_SESSION['sess_reporte_vec']=array();
                $_SESSION['sess_reporte_vec']['file_name']=$file_name;
                $_SESSION['sess_reporte_vec']['reporte']= $reporte_vec = array();
                //Creo la primer solapa del libro
                $worksheet_num = 0;
                $reporte_vec[$worksheet_num]['nombre']=' secciones';
                $reporte_vec[$worksheet_num]['contenido']=$reporte_contenido=array();
                $reporte_fila=1;


     //if ($_GET['busca'] == 1) {
    
            //:::::::::::::::::::::::::::::::::::::::::::
            //              Consulta 
            //:::::::::::::::::::::::::::::::::::::::::::
            //Creo el objeto abike_secciones
            $abike_secciones_obj = new abike_secciones;
            $abike_secciones_obj->id = $_POST['txt_id'];
            $abike_secciones_obj->descripcion = $_POST['txt_descripcion'];
            $abike_secciones_obj->orden = $_POST['txt_orden'];
            $abike_secciones_obj->link = $_POST['txt_link'];


            //******** Incluyo para exportar TODO*/
            $_SESSION['sess_reporte_vec']['objeto']       =  serialize($abike_secciones_obj);
            $_SESSION['sess_reporte_vec']['objeto_name']   =  'abike_secciones';
            //******** Incluyo para exportar TODO*/


            // Controlo la paginacion 
            $pagina = intval($_GET['pagina']); 
            $registros = 100; 
            $total_registros=$abike_secciones_obj->cant_traer();
            $total_paginas = ceil($total_registros / $registros);
           $abike_secciones_obj->traer($pagina,$registros);

           $cant=count($abike_secciones_obj->resultados_vec);
     //}
?>
    <h1> Secciones</h1>
 <?   if ($total_paginas>1) paginador_generico('abike_secciones_adm.php',$_GET['pagina'],$total_registros,$registros); ?>
    <a id='add' href='abike_secciones_am.php?operacion=<? echo OP_ALTA; ?>'> &nbsp; Añadir un nuevo registro</a>
    <table align="center"   class="example" id="ordenable"><thead>
          <tr class='tabla_cabe'>
              <th width="0"></th>
              <th class="">Descripcion</th>
              <th class="">Bajada</th>
              <th class="">Link</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
                  


          </tr></thead><tbody>
<?
     //if ($_GET['busca'] == 1) {

           for ($i=0;$i<$cant;$i++) {
            echo "<tr>
                      <td class='ordenable_id' width='0' id='".$abike_secciones_obj->resultados_vec[$i]['id']."'></td>
                      <td ><a href='abike_secciones_am.php?id=".$abike_secciones_obj->resultados_vec[$i]['id']."&operacion=".OP_UPDATE."'>".$abike_secciones_obj->resultados_vec[$i]['descripcion']."</a></td>
                      <td >".$abike_secciones_obj->resultados_vec[$i]['bajada']."</td>
                      <td >".$abike_secciones_obj->resultados_vec[$i]['link']."</td>
                      <td ><a href='abike_secciones_am.php?id=".$abike_secciones_obj->resultados_vec[$i]['id']."&operacion=".OP_UPDATE."'><img src='imagenes/ico_edit.png' border='0' alt='Modificar'  title='Modificar'></a></td>
                      <td >";?><a href='#' onClick="eliminar(<? echo $abike_secciones_obj->resultados_vec[$i]['id']?>,'<? echo $abike_secciones_obj->resultados_vec[$i]['descripcion']?>',<?=intval($_GET['pagina']);?>)"><img src='imagenes/img_papelera.png' border='0' alt='Eliminar' title='Eliminar '></a></td><? echo "
                  </tr>";
                  

           }//del for 

     // }// del if de si busca
    $reporte_vec[$worksheet_num]['contenido']=$reporte_contenido;
    $_SESSION['sess_reporte_vec']['reporte']= $reporte_vec;
?>
    </tbody></table >
 
 
 
    <ul class='herramientas'>
        <li>
            <a id='imprimir'>
                &nbsp;Imprimir
            </a>
        </li>
        <li>
            <a href='../includes/excel_export_objetos.php' target='_blank' id='exportar-xls'>
                Descargar en xls
            </a>
        </li>
        <li>
            <input type="button" value="Guardar Orden" onclick="guardar_orden(<?= $_GET['pagina'] * $registros; ?>);" />
        </li>
    </ul>
 </div><!-- listados !-->
 </section><!-- adm !-->
   <? include_once 'footer.php'; ?>
