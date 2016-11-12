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
    error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE ^ E_DEPRECATED);
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

    define('TS_FILES', TS_ROOT.'/files/');
    
    set_include_path(get_include_path() . PATH_SEPARATOR . realpath('./'));

/*
 * -------------------------------------------------------------------
 *  Agregamos los archivos globales
 * -------------------------------------------------------------------
 */


    // Contiene las variables de configuración principal
    include 'config.inc.php';

    // No ha sido instalado el script...
    //$install_dir = TS_ROOT . '/install/';
    if($db['hostname'] == 'dbhost')
        header("Location: ./install/index.php");
        
        
    // Funciones
    include TS_EXTRA.'functions.php';
    
    // Funciones para la DB
    //include TS_CLASS.'c.db.php';

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
    
    // Smarty
    include TS_CLASS.'c.smarty.php';
    
    // Crean requests
    include TS_EXTRA.'QueryString.php';

/*
 * -------------------------------------------------------------------
 *  Inicializamos los objetos principales
 * -------------------------------------------------------------------
 */
 
 
    // Interacción con la base de datos
    //$tsdb =& tsDatabase::getInstance();
    
    // Limpiar variables...
    cleanRequest();

    // Cargamos el nucleo
    $tsCore =& tsCore::getInstance();
    
    // Usuario
    $tsUser =& tsUser::getInstance();

    // Monitor
    $tsMonitor = new tsMonitor();

    // Actividad
    $tsActividad =& tsActividad::getInstance();

    // Mensajes
    $tsMP = new tsMensajes();

    // Definimos el template a utilizar
    $tsTema = $tsCore->settings['tema']['t_path'];
    if(empty($tsTema)) $tsTema = 'default';
    define('TS_TEMA', $tsTema);

    // Smarty
    $smarty =& tsSmarty::getInstance();

/*
 * -------------------------------------------------------------------
 *  Asignación de variables
 * -------------------------------------------------------------------
 */
    
    // Configuraciones
    $smarty->assign('tsConfig',$tsCore->settings);
    
    // Obtejo usuario
    $smarty->assign('tsUser',$tsUser);
    
    // Avisos
    $smarty->assign('tsAvisos', $tsMonitor->avisos);
    
    // Nofiticaciones
    $smarty->assign('tsNots',$tsMonitor->notificaciones);
    
    // Mensajes
    $smarty->assign('tsMPs',$tsMP->mensajes);
    

/*
 * -------------------------------------------------------------------
 *  Validaciones extra
 * -------------------------------------------------------------------
 */
    // Baneo por IP
    $ip = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    if(!filter_var($ip, FILTER_VALIDATE_IP)) die('Su ip no se pudo validar.'); 
    if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM w_blacklist WHERE type = \'1\' && value = \''.$ip.'\' LIMIT 1'))) die('Bloqueado');

    // Online/Offline
    if($tsCore->settings['offline'] == 1 && ($tsUser->is_admod != 1 && $tsUser->permisos['govwm'] == false) && $_GET['action'] != 'login-user'){
    	$smarty->assign('tsTitle',$tsCore->settings['titulo'].' -  '.$tsCore->settings['slogan']);
        if(empty($_GET['action'])) 
    	   $smarty->display('sections/mantenimiento.tpl');
        else die('Espera un poco...');
    	exit();
    // Banned
    } elseif($tsUser->is_banned) {
        $banned_data = $tsUser->getUserBanned();
        if(!empty($banned_data)){
            // SI NO ES POR AJAX
            if(empty($_GET['action'])){
                $smarty->assign('tsBanned',$banned_data);
                $smarty->display('sections/suspension.tpl');
            } 
            else die('<div class="emptyError">Usuario suspendido</div>');
            //
            exit;
        }
    }