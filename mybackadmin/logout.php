<?php
session_start($PHPSESSID);
session_destroy();
header("Location: login.php");

//Guardo la data en la cookie
//setcookie("lg","",mktime(0,0,0,1,1,2001),'/','.bairesapartments.com',false);

?>