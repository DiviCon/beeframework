<?php 

// Saber si trabajamos en local o remoto
define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::']));

// Definir el timezone
date_default_timezone_set('America/Bogota');

// Lenguaje
define('LANG', 'es');

// Ruta base del proyecto
define('BASEPATH', IS_LOCAL ? '/beeframework/' : '___EL BASEPATH EN PRODUCCION___');

// Sal del sistema
define('AUTH_SALT', 'BeeFramework<3');

// Puerto y la url del sitio
define('PORT', '8848');
define('URL', IS_LOCAL ? 'http://127.0.0.1:'.PORT.'/beeframework/' : '___URL EN PRODUCCION___');