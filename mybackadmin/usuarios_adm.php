<? $header['title']= '';
    $header['description']= '';
    $header['keywords']= '';
 include_once 'header.php';
    include_once '../includes/usuarios.php';
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
    @session_register('sess_busqueda');
    $_SESSION['sess_busqueda']=$_POST;
    
    if ($_GET['elimina'] == 1) { 
        // Creo el objeto usuarios
        $usuarios_obj = new usuarios;
        $usuarios_obj->id = $_GET['id'];
        $usuarios_obj->delete();
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
                document.location = 'usuarios_adm.php?elimina=1&id='+id+'&pagina='+pagina;
                }
            });
        }
        
        
    </script><?
    
    
    
    
    $tabindex=0;
    ?>
    
<section id='adm'>
 <div id='buscador'>
    <form name='me' method='post' action='usuarios_adm.php?busca=1' >
    <h1>Busqueda Avanzada </h1>
    <h2>Seleccione un parámetro de búsqueda</h2>
    
    <ul>
                <li><label for='txt_descripcion' >Descripcion</label>
                      <input type='text' name='txt_descripcion' id='txt_descripcion'   value='<?= $_POST['txt_descripcion'];?>'    >
                           
                </li><!-- campo descripcion!-->
                
                <li><label for='txt_legajo' >Legajo</label>
                      <input type='text' name='txt_legajo' id='txt_legajo'   value='<?= $_POST['txt_legajo'];?>'    >
                           
                </li><!-- campo legajo!-->
                
                <li><label for='txt_email' >Email</label>
                      <input type='text' name='txt_email' id='txt_email'   value='<?= $_POST['txt_email'];?>'    >
                           
                </li><!-- campo email!-->
                 
                <li><label for='txt_perfil_id' >Perfil</label>
                      <input type='text' name='txt_perfil_id' id='txt_perfil_id'   value='<?= $_POST['txt_perfil_id'];?>'    >
                           
                </li><!-- campo perfil_id!-->
                
                <li class='botones'><input type='submit' name='bt_submit' class='submit' value='Buscar' id='bt_submit' ></li>
    </ul>
    
   </form>
    
   </div><!-- buscador !--> 
    
  <div id='listado'>  

     <?         // ====== Xls ============
                define ('SEPARADOR',';');
                $file_name = 'reportes/usuarios_'.date('d-m-Y_h-i').'.xls';
                $_SESSION['sess_reporte_vec']=array();
                $_SESSION['sess_reporte_vec']['file_name']=$file_name;
                $_SESSION['sess_reporte_vec']['reporte']= $reporte_vec = array();
                //Creo la primer solapa del libro
                $worksheet_num = 0;
                $reporte_vec[$worksheet_num]['nombre']=' usuarios';
                $reporte_vec[$worksheet_num]['contenido']=$reporte_contenido=array();
                $reporte_fila=1;


     //if ($_GET['busca'] == 1) {
    
            //:::::::::::::::::::::::::::::::::::::::::::
            //              Consulta 
            //:::::::::::::::::::::::::::::::::::::::::::
            //Creo el objeto usuarios
            $usuarios_obj = new usuarios;
            $usuarios_obj->id = $_POST['txt_id'];
            $usuarios_obj->descripcion = $_POST['txt_descripcion'];
            $usuarios_obj->legajo = $_POST['txt_legajo'];
            $usuarios_obj->email = $_POST['txt_email'];
            $usuarios_obj->pwd = $_POST['txt_pwd'];
            $usuarios_obj->perfil_id = $_POST['txt_perfil_id'];


            //******** Incluyo para exportar TODO*/
            $_SESSION['sess_reporte_vec']['objeto']       =  serialize($usuarios_obj);
            $_SESSION['sess_reporte_vec']['objeto_name']   =  'usuarios';
            //******** Incluyo para exportar TODO*/


            // Controlo la paginacion 
            $pagina = intval($_GET['pagina']); 
            $registros = 100; 
            $total_registros=$usuarios_obj->cant_traer();
            $total_paginas = ceil($total_registros / $registros);
           $usuarios_obj->traer($pagina,$registros);

           $cant=count($usuarios_obj->resultados_vec);
     //}
?>
    <h1> Usuarios</h1>
 <?   if ($total_paginas>1) paginador_generico('usuarios_adm.php',$_GET['pagina'],$total_registros,$registros); ?>
<?php if(in_array('configuracion.usuario.add', $perfiles_vec[$_SESSION['sess_usuario_perfil_id']]['acciones'])) { ?>
    <a id='add' href='usuarios_am.php?operacion=<? echo OP_ALTA; ?>'> &nbsp; Añadir un nuevo registro</a>
<?php } ?>    
    <table align="center"   class="example table-autosort:99" ><thead>
          <tr class='tabla_cabe'>
              <th class="table-sortable:default">Descripcion</th>
              <th class="table-sortable:default">Legajo</th>
              <th class="table-sortable:default">Email</th>
              <th class="table-sortable:default">Perfil</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
                  


          </tr></thead><tbody>
<?
     //if ($_GET['busca'] == 1) {

           for ($i=0;$i<$cant;$i++) {
            echo "<tr>
                      <td ><a href='usuarios_am.php?id=".$usuarios_obj->resultados_vec[$i]['id']."&operacion=".OP_UPDATE."'>".$usuarios_obj->resultados_vec[$i]['descripcion']."</a></td>
                      <td >".$usuarios_obj->resultados_vec[$i]['legajo']."</td>
                      <td >".$usuarios_obj->resultados_vec[$i]['email']."</td>
                      <td >".$perfiles_vec[$usuarios_obj->resultados_vec[$i]['perfil_id']]['nombre']."</td>
                      <td ><a href='usuarios_am.php?id=".$usuarios_obj->resultados_vec[$i]['id']."&operacion=".OP_UPDATE."'><img src='imagenes/ico_edit.png' border='0' alt='Modificar'  title='Modificar'></a></td>";
if(in_array('configuracion.usuario.delete', $perfiles_vec[$_SESSION['sess_usuario_perfil_id']]['acciones'])) {
            echo     "<td >";?><a href='#' onClick="eliminar(<? echo $usuarios_obj->resultados_vec[$i]['id']?>,'<? echo $usuarios_obj->resultados_vec[$i]['descripcion']?>',<?=intval($_GET['pagina']);?>)"><img src='imagenes/img_papelera.png' border='0' alt='Eliminar' title='Eliminar '></a></td><? 
}            
            echo "</tr>";
                  

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
