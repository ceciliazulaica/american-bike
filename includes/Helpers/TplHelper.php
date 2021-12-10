<?php

Class TplHelper {
	

	private static $instance = null;

	private $base_path = '';

	private $vars	= array();

	public $layout = 'layout/common.php';

	public function getInstance()
	{
		if(!is_object(self::$instance)){
			self::$instance = new TplHelper;
		}
		return self::$instance;
	} 

	private function __construct()
	{
		$this->base_path =  ROOT . DS . 'templates' . DS;
	}


	public function set($key,$value, $merge = false)
	{
		$_this = TplHelper::getInstance();
		if(!$merge){
			$_this->vars[$key] = $value;
		} else {
			$_this->vars = array_merge(
				$_this->vars, $value
			);
		}
		return $_this;
		
	}




	public function render($tpl,$_layout = false, $clear = false)
	{
		$_this = TplHelper::getInstance();
		
		ob_start();
		
		if(!empty($_this->vars))
			extract($_this->vars);
		
		include $_this->base_path . str_replace('/',DS,$tpl);
		
		$out = ob_get_clean();
		
		if($clear)
			$_this->vars = array();

		if($_layout !== false){
			if($_layout === true){
				return $_this->_renderLayout($out,$this->layout);
			}else{
				return $_this->_renderLayout($out,$_layout);
			}
		}

		return $out;
	}

	private function _renderLayout($content,$layout){
		$_this = TplHelper::getInstance();
		TplHelper::set('__layout__content', $content);
		return TplHelper::render($layout);
	}

	/**
	 * Interpola contenido en un contexto especifico
	 *
	 * <code>
	 * 		<?php
	 * 			$mensaje = 'hola {usuario}, su cuenta ha sido activada';
	 * 			echo TplHelper::interpolate($mensaje,array('usuario' => 'Samu'));
	 * 		// html
	 * </code>
	 * 
	 * @param  string $message Mensaje con llaves a reemplazar
	 * @param  array  $context variables a utilizar para interpolar en el mensaje
	 * @return string          resultado del reemplazo
	 */		
	static function interpolate($message, array $context = array())
	{
		// armar el array contenedor para los reemplazos
		$replace = array();
		
		foreach($context AS $key => $val){
			$replace['{' . $key . '}'] = $val;
		}

		// Interpolar los datos
		return strtr($message,$replace);
	}
}