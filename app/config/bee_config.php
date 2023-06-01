<?php

// Saber si trabajamos en local o remoto
define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::']));

// Definir el timezone
date_default_timezone_set('America/Bogota');

// Lenguaje
define('LANG', 'es');

// Ruta base del proyecto
define('BASEPATH', IS_LOCAL ? '/beeframework/' : '___EL BASEPATH EN PRODUCCION___');

// Generar una cadena aleatoria para la sal del sistema
$randomBytes = random_bytes(32);
$salt = bin2hex($randomBytes);

// Sal del sistema
define('AUTH_SALT', $salt);


// Puerto y la url del sitio
define('PORT', '8848');
define('URL', IS_LOCAL ? "http://127.0.0.1:".PORT.BASEPATH : '___URL EN PRODUCCION___');

// Rutas de nuestro directorio y archivos
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__.DS);

define('APP', ROOT.'app'.DS);
define('CLASSES', APP.'classes'.DS);
define('CONFIG', APP.'config'.DS);
define('CONTROLLERS', APP.'controllers'.DS);
define('FUNCTIONS', APP.'functions'.DS);
define('MODELS', APP.'models'.DS);

define('TEMPLATES', ROOT.'templates'.DS);
define('INCLUDES', TEMPLATES.'includes'.DS);
define('MODULES', TEMPLATES.'modules'.DS);
define('VIEWS', TEMPLATES.'views'.DS);

define('ASSETS', URL.'assets/');
define('CSS', URL.'css/');
define('FAVICON', URL.'favicon/');
define('FONTS', URL.'fonts/');
define('IMAGES', URL.'images/');
define('JS', URL.'js/');
define('PLUGINS', URL.'plugins/');
define('UPLOADS', URL.'uploads/');

// Credenciales para la base de datos
// DB Local
define('LDB_ENGINE', 'mysql');
define('LDB_HOST', 'localhost');
define('LDB_NAME', 'salamandra');
define('LDB_USER', 'root');
define('LDB_PASS', 'Mario7723702');
define('LDB_CHARSET', 'utf8');

// DB Remota
define('DB_ENGINE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'salamandra');
define('DB_USER', 'root');
define('DB_PASS', 'Mario7723702');
define('DB_CHARSET', 'utf8');