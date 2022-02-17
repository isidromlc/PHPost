<?php
/**
 * Archivo de Inicialización del Sistema
 *
 * Carga las clases base y ejecuta la solicitud.
 *
 * @name    header.php
 * @author  PHPost Team
 */

/*
 * -------------------------------------------------------------------
 *  Estableciendo variables importantes
 * -------------------------------------------------------------------
 */

   if( defined('TS_HEADER') ) return;

   // Sesión
   if(!isset($_SESSION)) session_start();

   // Reporte de errores
   error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
   ini_set('display_errors', TRUE);

   // Límite de ejecución
   set_time_limit(300);

   // Variable $page
   if( !isset($page) ) $page = '';

/*
 * -------------------------------------------------------------------
 *  Definiendo constantes
 * -------------------------------------------------------------------
 */
   //DEFINICION DE CONSTANTES
   define('TS_ROOT', realpath(dirname(__FILE__)));

   define('TS_HEADER', TRUE);

   define('TS_CLASS', 'inc/class/');

   define('TS_EXTRA', TS_ROOT.'/inc/ext/');

   define('TS_SMARTY', TS_ROOT.'/inc/smarty/');

   define('TS_FILES', TS_ROOT.'/files/');
   
   set_include_path(get_include_path() . PATH_SEPARATOR . realpath('./'));

/*
 * -------------------------------------------------------------------
 *  Agregamos los archivos globales
 * -------------------------------------------------------------------
 */

   // Funciones
   include TS_EXTRA.'functions.php';

   // Nucleo
   include TS_CLASS.'c.core.php';
   
   // Controlador de usuarios
   include TS_CLASS.'c.user.php';

   // Monitor de usuario
   include TS_CLASS.'c.monitor.php';
   
   // Actividad de usuario
   include TS_CLASS.'c.actividad.php';

   // Mensajes de usuario
   include TS_CLASS.'c.mensajes.php';
   
   // Crean requests
   include TS_EXTRA.'QueryString.php';

/*
 * -------------------------------------------------------------------
 *  Inicializamos los objetos principales
 * -------------------------------------------------------------------
 */
 
   // Limpiar variables...
   cleanRequest();

   // Cargamos el nucleo
   $tsCore = new tsCore();
   
   // Usuario
   $tsUser = new tsUser();

   // Monitor
   $tsMonitor = new tsMonitor();

   // Actividad
   $tsActividad = new tsActividad();

   // Mensajes
   $tsMP = new tsMensajes();

   // Definimos el template a utilizar
   $tsTema = $tsCore->settings['tema']['t_path'];
   if(empty($tsTema)) $tsTema = 'default';
   define('TS_TEMA', $tsTema);

   # Configuraciones adicionales para smarty
   define('TS_THEMES', TS_ROOT . '/themes/'); # Todos los temas
   define('TS_PLUGINS', TS_FILES . 'plugins/'); # Todos los plugins
   # Tiempo de vida del cache antes de ser eliminado [5hs] (3600 equivale 1hs)
   define('CACHE_LIFE_TIME', 3600 * 5);
   define('CACHE_CHECKED', TRUE);
   # Solo usar las carpetas agregadas en $smarty->setTemplateDir()
   define('SECURITY', TRUE);
   # Para comprimir el html y que sea más rápido
   define('COMPRESS_HTML', FALSE);
   # Smarty 4.0
   require_once TS_EXTRA . 'smarty.config.php';

/*
 * -------------------------------------------------------------------
 *  Asignación de variables
 * -------------------------------------------------------------------
*/
// Configuraciones
$smarty->assign('tsConfig', $tsCore->settings);

// Obtejo usuario
$smarty->assign('tsUser', $tsUser);

// Avisos
$smarty->assign('tsAvisos', $tsMonitor->avisos);

// Nofiticaciones
$smarty->assign('tsNots', $tsMonitor->notificaciones);

// Mensajes
$smarty->assign('tsMPs', $tsMP->mensajes);
      
/**
 * Si hay alguna IP bloqueada por el Moderador/Administrador,
 * ejecutamos esta función, en caso contrario no hará nada
*/
ip_banned();

/**
 * Si hay un usuario baneado por el Moderador/Administrador,
 * ejecutamos esta función, en caso contrario no hará nada
*/
user_banned();

/**
 * Si la página esta en modo mantenimiento, ejecutamos la función
*/
site_in_maintenance();