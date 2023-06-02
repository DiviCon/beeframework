<?php 

class Bee {

	// Propiedades del framework
	private $framework = 'Bee Framework';
	private $version =  '1.0.0';
	private $uri = [];

	
	/**
	 * Función principal que se ejecuta cuando se instancia nuestra clase
	 **/
	function __construct()
	{
		$this->init();
	}

	/**
	 * Método para ejecutar todo subsecuente
	 **/
	private function init()
	{
		$this->init_session();
        $this->init_load_config();
        $this->init_load_functions();
        $this->init_autoload();
        $this->dispatch();

	}

	/**
	 * Método para iniciar la sesion en el sistema
	 **/
	private function init_session()
	{
		if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
	}


	/**
	 * Método para cargar la configuración del sistema
	 **/
	private function init_load_config()
	{
		$file = 'bee_config.php';
        $configPath = 'app/config/' . $file;

        if (!is_file($configPath)) {
            die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione.', $file, $this->framework));
        }

        require_once $configPath;
	}


	/**
	 * Método para cargar las funciones del sistema y las funciones del proyecto
	 **/
	private function init_load_functions()
	{
	    $this->load_core_function();
	    $this->load_custom_function();
	}


	/**
	 * Carga las funciones del sistema
	 **/
	private function load_core_function()
	{
	    $functionPath = FUNCTIONS . 'bee_core_functions.php';

	    if (!is_file($functionPath)) {
	        die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione.', 'bee_core_functions.php', $this->framework));
	    }

	    require_once $functionPath;
	}


	/**
	 * Carga las funciones del proyecto
	 **/
	private function load_custom_function()
	{
	    $functionPath = FUNCTIONS . 'bee_custom_functions.php';

	    if (!is_file($functionPath)) {
	        die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione.', 'bee_custom_functions.php', $this->framework));
	    }

	    require_once $functionPath;
	}


	/**
	 * Método para cargar todos los archivos de forma automatica
	 **/
	private function init_autoload()
	{
		require_once CLASSES . 'Db.php';
		require_once CLASSES . 'Model.php';
		require_once CLASSES . 'Controller.php';
		require_once CONTROLLERS . DEFAULT_CONTROLLER . 'Controller.php';
		require_once CONTROLLERS . DEFAULT_ERROR_CONTROLLER . 'Controller.php';
	}


	/**
	 * Método para filtrar y descomponer los elementos de nuestra uri y url
	 **/
	private function filter_url()
	{
		if (isset($_GET['uri'])) {
			$this->uri = $_GET['uri'];
			$this->uri = rtrim($this->uri, '/');
			$this->uri = filter_var($this->uri, FILTER_SANITIZE_URL);
			$this->uri = explode('/', strtolower($this->uri));

			return $this->uri;
		}
	}


	/**
	 * Método para ejecutar y cargar de forma automática el controlador, método y parámetros solicitados por el usuario
	 **/
	private function dispatch()
	{
	    // Filtrar la URL
	    $this->filter_url();

	    // Obtener el controlador actual
	    $current_controller = isset($this->uri[0]) ? $this->uri[0] : DEFAULT_CONTROLLER;

	    $controller = $current_controller . 'Controller';

	    if (!class_exists($controller)) {
	        $controller = DEFAULT_ERROR_CONTROLLER . 'Controller';
	    }

	    // Obtener el método actual
	    $current_method = isset($this->uri[1]) ? str_replace('-', '_', $this->uri[1]) : DEFAULT_METHOD;

	    // Crear instancia del controlador
	    $controller = new $controller;

	    // Obtener los parámetros
	    $params = array_values(empty($this->uri) ? [] : $this->uri);

	    // Llamar al método del controlador con los parámetros adecuados
	    if (empty($params)) {
	        call_user_func([$controller, $current_method]);
	    } else {
	        call_user_func_array([$controller, $current_method], $params);
	    }
	}

}