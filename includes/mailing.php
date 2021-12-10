<?  
class mailing
{
	var $remitente_mail ; 
	var $remitente_nombre ;
	var $destinatario_mail; 
	var $destinatario_nombre ; 
	var $asunto;
	 

    function _construct() {
            $this->limpiar();
    }
    
    function limpiar() {
	 	$this->remitente_mail =""; 
		$this->remitente_nombre ="";
		$this->destinatario_mail ="";
		$this->destinatario_nombre ="";
		$this->asunto =""; 
	
	}
		
	public function recomendar( $link)
	{
		$mensaje = $this->remitente_nombre.' le recomienda ésta búsqueda laboral. <br />Accede a la misma mediante el siguiente link:<br /><a href="'.SISTEMA_URL.'/ver-oferta-laboral-de-'.$link.'.html">'.SISTEMA_URL.'/ver-oferta-laboral-de-'.$link.'.html</a><br /><br />Muchas Gracias';
		$this->enviar(  $mensaje );
	}
	
	public function aplicar($oferta)
	{
		$mensaje = $this->remitente_nombre.'   ha enviado su CV para la oferta '.$oferta.', desde la web de Increxa';
		$this->asunto= $this->remitente_nombre.'   ha enviado su CV para la oferta '.$oferta.', desde la web de Increxa';
		$this->destinatario_mail="vosorio@gmail.com";
		$this->enviar(  $mensaje,"mailing-base.htm" );
	}
	
	public function cargar_cv()
	{
		$mensaje = $this->remitente_nombre.'   ha enviado su CV, desde la web de Increxa';
		$this->asunto= $this->remitente_nombre.'   ha enviado su CV, desde la web de Increxa';
		$this->destinatario_mail="vosorio@gmail.com";
		$this->enviar(  $mensaje,"mailing-base.htm" );
	}
	public function contacto($tema_consulta,$nombre,$apellido,$empresa,$cargo,$email,$telefono,$consulta)
	{
		$mensaje = '
			Nombre: '.$nombre.'<br />
			Apellido: '.$apellido.'<br />
			Empresa: '.$empresa.'<br />
			Cargo: '.$cargo.'<br />
			Email: '.$email.'<br />
			Teléfono: '.$telefono.'<br /><br />
			
			Tema de su consulta:'.$tema_consulta.'<br /><br />
			
			Mensaje: '.$consulta.'<br />
		';
		
		
		$this->remitente_nombre=$nombre." ".$apellido;
		$this->remitente_mail=$email;
		$this->asunto="Consulta $tema_consulta / ($nombre $apellido)";
		$this->destinatario_mail="vosorio@gmail.com";
		$this->enviar(  $mensaje,"mailing-base.htm" );
	}
	
	public function enviar( $mensaje,$template="mailing.htm" )
	{
		$template = file_get_contents('templates/'.$template);
		$template = str_replace( '{CONTENIDO}', tabla_con_bordes_redondeados($mensaje) , $template );
		$template = str_replace( '{SISTEMA_URL}' , SISTEMA_URL , $template );
		$template = str_replace( '{ESTIMADO_NOMBRE}', $this->destinatario_nombre , $template );


		if(mail_enviar ($this->remitente_mail,$this->remitente_nombre,$this->destinatario_mail,$this->asunto,$template,$rta,false)){
			return true;
		}else{
			return false;
		}
		
	}
}
?>
