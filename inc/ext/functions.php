<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');


$CONFIGINC = TS_ROOT . "/config.inc.php";

/**
 * Comprobamos que el archivo exista
*/
if( file_exists( $CONFIGINC )) {

   # Ahora preguntamos si esta instalado
   require_once $CONFIGINC;
   if( $db["hostname"] === 'dbhost') header("Location: ./install/index.php");

} else header("Location: ./install/index.php");


/**
 * Nueva forma de conectar a la base de datos
 * https://www.php.net/manual/es/mysqli.construct.php => Ejemplo 1
*/

$db_link = new mysqli($db['hostname'], $db['username'], $db['password'], $db['database']);

/**
 * Aquí comprobaremos la conexión
 * @link https://www.php.net/manual/es/mysqli.connect-errno.php 
*/
if (mysqli_connect_errno()):
    $message = mysqli_connect_errno();
   #$message = mysqli_connect_error(); // Lo mismo, pero en ingles
   switch ($message) {
    case 1045:
        $pass = (empty($db['password'])) ? "NO" : "SI";
        $message = "Acceso denegado para el usuario <b>'{$db['username']}'</b>@'localhost' ";
        $message .= " (usando contraseña: {$pass})";
    break;
    case 1049:
        $message = "La base de datos <b>{$db['database']}</b> es desconocida.";
    break;
    case 2002:
        $message = "El host \"<b>{$db['hostname']}</b>\" que intentas conectar es desconocido.";
    break;
   }
   exit(show_error("<p class=\"warning\">{$message}</p>", 'Conexión con MySQLI'));
  
else:

   if (!$db_link->set_charset('utf8mb4')): # utf8 | utf8mb4

    /**
     * @link https://www.php.net/manual/es/mysqli.set-charset.php
     * printf("Conjunto de caracteres actual: %s\n", $db_link->character_set_name());
     * resultado: Conjunto de caracteres actual: utf8mb4
    */
      $message = "Error cargando el conjunto de caracteres:<br>\"<b>{$db_link->error}</b>\"";
    exit(show_error("<p class=\"warning\">{$message}</p>", 'Juego de caracteres no válido'));

   endif;

endif;

/**
 * Ejecutar consulta
 */
function db_exec()
{
	if(isset(func_get_args()[0])) $info = func_get_args()[0];
	if(isset(func_get_args()[1])) $type = func_get_args()[1];
	if(isset(func_get_args()[2])) $data = func_get_args()[2];
	
	global $db_link, $tsUser, $tsAjax, $display;
    
    // Si la primera variable contiene un string, se entiende que es la consulta que debe ejecutarse. Esto lo prepara para ello.
    if(is_array($info)) {
        if(!$tsUser->is_admod && $display['msgs'] != 2) { $info[0] = explode('\\', $info[0]); }
        $info['file'] = $tsUser->is_admod || $display['msgs'] == 2 ? $info[0] : end($info[0]);
        $info['line'] = $info[1];
        $info['query'] = $data;
    } else {
        $data = $type;
        $type = $info;
        if($type == 'query') { $info = array(); $info['query'] = $data; }
    }
    
    if($type === 'query' && !empty($data))
    {
        $query = mysqli_query($db_link, $data);
        if(!$query && !$tsAjax && $display['msgs'] && ($info['file'] || $info['line'] || ($info['query'] && $tsUser->is_admod))) exit( show_error( 'No se pudo ejecutar una consulta en la base de datos.', 'db', $info ) );
        return $query;
    }
    elseif($type === 'real_escape_string')
    {
        return mysqli_real_escape_string($db_link, $data);
    }
    elseif($type === 'num_rows')
    {
        return mysqli_num_rows($data);
    }
    elseif($type === 'fetch_assoc')
    {
        
        return mysqli_fetch_assoc($data);
    }
    elseif($type === 'fetch_array')
    {
        return mysqli_fetch_array($data);
    }
    elseif($type === 'fetch_row')
    {
        return mysqli_fetch_row($data);
    }
    elseif($type === 'free_result')
    {
        return mysqli_free_result($data);
    }
    elseif($type === 'insert_id')
    {
        return mysqli_insert_id($db_link);
    }
    elseif($type === 'error')
    {
        return mysqli_error($db_link);
    }
    elseif($type === 'multi_query')
    {
        return mysqli_multi_query($db_link, $data);
    }
}

/**
 * Cargar resultados
 */
function result_array($result) {
   $result instanceof mysqli_result;
   if( !is_a($result, 'mysqli_result') ) return [];
   $array = [];
   while($row = db_exec('fetch_assoc', $result)) $array[] = $row;
   return $array;
}

/**
 * Mostrar error con diseño comprimido y agradable en pantalla
 */
function show_error($error = 'Indefinido', $type = 'db', $info = array())
{
    global $db_link, $tsUser, $display;
    
    if($type === 'db')
    {
        // Definir bloques HTML
        $extra['file'] = isset($info['file']) ? '<tr><td>Archivo</td><td>'.$info['file'].'</td></tr>' : '';
        $extra['line'] = isset($info['line']) ? '<tr><td>L&iacute;nea</td><td>'.$info['line'].'</td></tr>' : '';
        $extra['query'] = isset($info['query']) && ($tsUser->is_admod || $display['msgs'] == 2) ? '<tr><td>Sentencia</td><td>'.$info['query'].'</td></tr>' : '';
        $extra['error'] = mysqli_error($db_link) && ($tsUser->is_admod || $display['msgs'] == 2) ? '<tr><td colspan="2"><p class="warning">'.mysqli_error($db_link).'</p></td></tr>' : '';
        // Definir tabla HTML
        $table = '<table border="0"><tbody>' . $extra['file'] . $extra['line'] . $extra['query'] . $extra['error'] . '</tbody></table>';
    }
 
    return '0: <head><meta charset="UTF-8" /><title>PHPost › Error</title><style type="text/css">html{background: #f9f9f9;}body {background: #FFF;color: #333;font-family: sans-serif;margin: 2em auto;padding: 1em 2em;border: 1px solid #dfdfdf;max-width: 700px;}h1 {border-bottom: 1px solid #dadada;clear: both;color: #666;font: 24px Georgia, "Times New Roman", Times, serif;padding: 0;padding-bottom: 7px;}#error-page p { background: #DDD; border: 1px solid #b1b1b1; color: #0e0e0e; font-size: 14px;line-height: 1.5;margin: 25px 0 20px;text-align: center;padding: 10;} #error-page p.warning{background-color: #f7e5e8;border: 1px solid #f0c1cb;color: #92394d;margin: 0;} td:last-child{width:250px;} table{font:normal 12px/150% Geneva,Arial,Helvetica,sans-serif;background:#fff;overflow:hidden;border:1px solid #dbe4ef;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;border-collapse:collapse;text-align:left;width:100%;} table td,table th{padding:5px 5px;} table thead th{background:#2b2b2b;color:#BEBEBE;font-size:11px;padding:8px 6px;font-weight:bold;border-left:0px solid #0070A8;} table thead th:first-child{border:none;} table tbody td a{color:#225985;} table tbody td a:hover{color:#328586;} table tbody td{padding:10px;color:#5a5a5a;background:#FDFDFD;border-bottom:1px solid #f3f3f3;font-size:12px;font-weight:normal;} table tbody .alt td{background:#E1EEf4;color:#00557F;} table tbody td:first-child{border-left: none;width: 10%;font-weight: bold;border-right: 1px solid #DFDFDF} table tbody tr:last-child td{border-bottom:none;font-weight: normal;}</style></head><body><div id="error-page"><h1>ERROR</h1><p>'.$error.'</p>'.($type === 'db' ? $table : '').'</div></body>';
}

// Borramos la variable por seguridad
unset($db);

function ip_banned() {
   $IPBAN = (isset($_SERVER["X_FORWARDED_FOR"])) ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
   if(!filter_var($IPBAN, FILTER_VALIDATE_IP)) exit('Su ip no se pudo validar.');
   if(db_exec( 'num_rows', db_exec([__FILE__, __LINE__], 'query', 
         "SELECT id FROM w_blacklist WHERE type = 1 && value = '{$IPBAN}' LIMIT 1"
   ))) die('Tu IP fue bloqueada por el administrador/moderador.');
}

function user_banned() {
   global $tsCore, $tsUser, $smarty;
   $banned_data = $tsUser->getUserBanned();

   if(!empty($banned_data)){
      if(empty($_GET['action'])){
         $smarty->assign([
            'tsTitle' => "Usuario baneado - {$tsCore->settings['titulo']}",
            'tsBanned' => $banned_data
         ]);
         $smarty->loadFilter('output', 'trimwhitespace');
         $smarty->display('suspension.tpl');

      } else die('<div class="emptyError">Usuario suspendido</div>');
      //
      exit;
   }

}

function site_in_maintenance() {
   global $tsCore, $tsUser, $smarty;
   if($tsCore->settings['offline'] == 1 && ($tsUser->is_admod != 1 && $tsUser->permisos['govwm'] == false) && $_GET['action'] != 'login-user'){
      $smarty->assign('tsTitle', "Sitio en mantenimiento - {$tsCore->settings['titulo']}");
      $smarty->assign('tsLogin', (isset($_GET["login"]) and $_GET["login"] == 'admin' ? true : false));

      if(empty($_GET["action"])) {
         $smarty->loadFilter('output', 'trimwhitespace');
         $smarty->display('mantenimiento.tpl');
      } else die('Espera un poco...');
      exit();
   }
}

function getSSL() {
   if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') $isSecure = false;
   elseif (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') $isSecure = true;
   elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
      $isSecure = true;
   }
   $isSecure = ($isSecure == true) ? 'https://' : 'http://';
   return $isSecure;
}

/**
 * Función is_countable
 * @link https://www.php.net/manual/es/function.is-countable.php
 * NOTA:
 * Si no puede actualizar a PHP 7.3, puede usar este polyfill simple:
*/
if (!function_exists('is_countable')) {
   function is_countable($var) {
      return (is_array($var) || $var instanceof Countable);
   }
}