<?php
/**
 * Clase para la gestion de registros temporales de la aplicacion
 * se utilizara 8 niveles para calificar los mensajes segun el 
 * estandar RFC 5424 @link http://tools.ietf.org/html/rfc5424
 * Niveles
 * ==============================================================
 * -	debug 			1
 * -	info 			2
 * -	notice 			4
 * -	warning 		9
 * -	error 			16
 * -	critical 		32
 * -	alert 			64
 * -	emergency 		128
 */

Class Debug 
{
	private static $name_levels = 
						array(
							0	=> 'none',
							1 	=> 'debug',
							2 	=> 'info',
							4 	=> 'notice',
							8 	=> 'warning',
							16 	=> 'error',
							32	=> 'critical',
							64	=> 'alert',
							128	=> 'emergency',
							255 => 'All'
							);

	private static $level_values = array(0, 1, 2, 4, 8, 16, 32, 64, 128);


	public function log($level = 0)
	{
		$config = Config::getInstance();
		if(!$userConfigLevel = $config->get('debug_level'))
			$userConfigLevel = 0;

		
		$chk = $userConfigLevel & $level;

		if($chk !== 0) {
			$trace = debug_backtrace();
			$data = array_slice(func_get_args(),1);
			$return ="<pre style=\"background:#ededed;border-radius:4px;border:solid 1px #d6d6d6f;padding:0 8px\">"
					."<h3 style=\"margin:0;padding:10px 0;border-bottom:solid 1px #c6c6c6\">[{$trace[0]['file']} :: {$trace[0]['line']}]</h3>"
					."<h4 style=\"margin:0;padding:10px 0;border-bottom:solid 1px #c6c6c6\">" . self::$name_levels[$level] . "</h4>"
					."<blockquote style=\"margin:0 0 5px;padding:0;border-top:solid 1px #FFFFFF\">".print_r($data,true)."</blockquote>"
					."</pre>";
			return $return;
		} else {
			return '['.self::$name_levels[$level].'] revise el log de sistema  <br/>';
		}
	}	
}