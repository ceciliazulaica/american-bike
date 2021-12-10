<?php
	/**
	 * Esta clase permite transportar datos en tiempo de ejecucion
	 * utilizando una unica instancia
	 * <code>
	 * 	<?php
	 * 		// need.php
	 * 		include_once 'archivo.php';
	 * 		$config = Config::getInstance();
	 * 		$config->set('id',5,'persistent');
	 * 	?>
	 * 	///////////////////////////////////////
	 * 	<?php
	 * 		include_once 'otro_archivo';
	 * 		$config = Config::getInstance();
	 * 		$id = $config->get('id'); // 5
	 * 		$config->clear('id'); // el metodo permite 2 valores, key y runtime
	 * 	?>
	 */

	Class Config {

		 private static $instances = array();

		public function getInstance()
		{

			 if(!isset(self::$instances['Config'])){
		       self::$instances['Config'] = new Config();
		       self::init();
		     }
		      
		      return self::$instances['Config'];

		}

		private function __construct()
		{
			
		}

		public function init()
		{
			$_c = Config::getInstance();
			if(isset($_SESSION['Config']['Persisten'])){
				foreach($_SESSION['Config']['Persisten'] AS $key => $value){
					$_c->set($key,$value,'persistent');
				}
			}
		}

		public function set($key, $value, $duration = false)
		{
			$_c = Config::getInstance();
			$_c->{ $key } = $value;
			switch(strtolower($duration)){
				case false :
					break;
				case 'persistent' :
					$_SESSION['Config']['Persisten'][$key] = $value;
					break;

			}
		}

		public function get($key) 
		{
			$_c = Config::getInstance();
			if(isset($_c->{ $key })){
				return $_c->{ $key };
			}
			return false;
		}

		public function clear($key,$runtime = false)
		{
			$_c = Config::getInstance();
			if(isset($_c->{ $key })){
				unset($_c->{ $key });
			}
			if(!$runtime){
				if(isset($_SESSION['Config']['Persisten'][$key]))
					unset($_SESSION['Config']['Persisten'][$key]);
			}
		}

		public function load($file)
		{
			// @TODO
		}


	}