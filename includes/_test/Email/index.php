<?php
	/**
	 * Prueba del import para la clase class.phpmailer.php 
	 */
	 
	 require_once '../../config.php';

	 show_source(__FILE__);

	 APP::import('System','Debug.php');

	 Config::set('debug_level',L_ALL);
	 
	 APP::import('Vendors/PHPMailer','class.phpmailer.php','PHPMailer');

	 $mail = new PHPMailer();

	 echo Debug::log(L_DEBUG,$mail);

	 App::import('Helpers','EmailHelper.php');

	 $email = new EmailHelper(array(
		'To' 		=> 'p.a.samu@gmail.com',
		'ToName'	=> 'samu',
		'From'		=> 'p.a.samu@gmail.com',
		'Subject' 	=> 'Prueba de email',
	 ));

	 Config::set('Email','Hola Mundo'); 

	 $email->tpl('templates/testConfig.html')
		->renderTemplate()
		->send();
