<?php
/**
 * Incluir la libreria necesaria 
 */
APP::import('Vendors/PHPMailer','class.phpmailer.php','PHPMailer');


/**
 * Adaptacion para utilizacion en vueltalcole
 * @author Pablo Samudia <inf@vousys.com>
 * @copyright Veronica Osorio info@vousys.com
 */
class EmailHelper
{
	/**
	 * Objeto PHPMailer
	 * @var object
	 */
	public $oMailer = null;

	/**
	 * ruta del templete que se va a utilizar
	 * @var mixed
	 */
	public $tpl	= false;

	public $To = '';

	public $From = '';

	public $cc = '';

	public $Subject = '';

	public $FromName = '';

	public $sBody = '';

	public $Mailer = 'mail';

	public $toName = '';

	public $aSendOptions = array(	
									'To','From','cc',
									'bcc','ReplyTo','Subject',
									'FromName', 'ToName'
								 );



	/**
	 * Contructo del objeto
	 * 
	 * @param array $params contiene los datos de configuracion para la inicializacion del helper
	 */
	public function __construct($params = false)
	{
		// Crear la instancia de PHPMailer
		$this->oMailer = new PHPMailer();

		

		// Codificación de carácteres
		$this->oMailer->CharSet 	= 'utf-8';

		$this->oMailer->Mailer 		= 'mail';

		if($fromName = Config::get('email_from')){
			$this->FromName = $fromName;
		}
				
		if(is_array($params))
		{
			$this->setParams($params);
		}

		return $this; // concatenacion de objeto

	}

	public function tpl($tpl)
	{
		$this->tpl = $tpl;
		return $this;
	}

	public function setParams($params)
	{
		if(is_array($params))
		{
			// Seteo los parametros para el envio de email
			foreach($this->aSendOptions AS $var){
				if(isset($params[$var])){
					$this->{$var} = $params[$var];
					//$this->oMailer->{$var} = $params[$var];
				}
			}
		}
		return $this;
	}


	function attach($path,$cid = false)
	{
		$_cid = (!$cid) ? $this->_randomCid($path) : $cid;
		$this->oMailer->AddEmbeddedImage($path,$_cid);
		return $this;
	}

	
	public function set($key,$var)
	{
		TplHelper::set($key,$var);
		return $this;
	}

	public function renderTemplate($tpl = false){
		$_tpl = (!$tpl) ? $this->tpl : $tpl;

		$this->sBody .= TplHelper::render($_tpl);

		return $this;
	}

	function send()
	{
		$this->oMailer->IsHTML 		= true;

		$this->oMailer->SetFrom($this->From, $this->FromName);
		$this->oMailer->AddAddress($this->To, $this->ToName);

		$this->oMailer->Subject    = $this->Subject;
		$this->oMailer->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$this->oMailer->MsgHTML($this->sBody);

		$this->oMailer->Send();

		
		return $this;
		//$this->_clearData();
	}


	private function _clearData(){
		$this->oMailer->ClearAllRecipients();
		$this->oMailer->ClearAttachments();
		foreach($this->aSendOptions AS $var){
			if(isset($params[$var])){
				$this->{$var} = null;
				//$this->oMailer->{$var} = $params[$var];
			}
		}
	}

	private function _randomCid($path)
	{
		return random(0,999).time().base64_encode(basename($path));
	}

	function _test(){
		echo $this->sBody;
		return $this;
	}

	function SendEmail($from, $fromName, $to, $toName, $cc, $subject, $body)
	{
		$mail = new PHPMailer();
		$this->oMailer->From     = $from;
		$this->oMailer->FromName = $fromName;
		$this->oMailer->Mailer   = "mail";
		$this->oMailer->AddAddress($to, $toName);
		$this->oMailer->AddCC($cc);
		$this->oMailer->Subject = $subject;
		$this->oMailer->Body    = $body;
		$this->oMailer->IsHTML = true;
		$this->oMailer->Send();
	}

}
?>