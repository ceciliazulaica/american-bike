<?
/* ----------------------------------------------------------
	Libreria Desarrollada por Veronica Osorio
				vosorio@gmail.com
 ---------------------------------------------------------- */


	//include_once "lib_usuarios.php";




function prog_end($administrador_page = "") {

	echo "  <p align='center'>
					<a href='index.php'>Volver al Menu Inicial</a> &nbsp; &nbsp;";
					if ($administrador_page != "") {
						echo"<a href='".$administrador_page."'>Volver al Administrador</a>";
					}
			echo "</p>
                       </body>
	   </html>";
}

?>