<? @session_start();
include_once "../includes/config.php";
include_once "../includes/lib_utiles.php";

	 $csv=export_table_to_csv($_GET["tabla"]);
 	 $filename = $_GET["tabla"]."_".date("Y-m-d_H-i",time());
	
	
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	print $csv;
 
?>