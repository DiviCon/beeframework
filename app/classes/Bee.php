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

	}

	/**
	 * Método para iniciar la sesion en el sistema
	 **/
	private function init_session()
	{
		if (session_status() === PHP_SESSION_NONE) 
		{
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

        if (!is_file($configPath)) 
        {
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
	}
}