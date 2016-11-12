<?php

/**
 * Nueva forma de conectar a la base de datos
 */
// Conectamos al servidor
$db_link = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);

// Comprobamos el estado de la conexión
if( mysqli_connect_errno() )
{
    exit( show_error( 'No se pudo establecer la conexi&oacute;n con la base de datos.</p> <p class="warning">'.mysqli_connect_error() , 'other') );
}
else
{
    if ( !mysqli_set_charset($db_link, 'utf8') )
    {
        exit( show_error( 'No se pudo establecer la codificaci&oacute;n de caracteres.', 'db' ) );
    }
    
    //mysqli_query($db_link, 'set names \'utf8\'');
	//mysqli_query($db_link, 'set character set utf8');
}

/**
 * Ejecutar consulta
 */
function db_exec($info = '', $type, $data)
{
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
}

/**
 * Cargar resultados
 */
function result_array($result)
{
    $result instanceof mysqli_result;
    if( !is_a($result, 'mysqli_result') ) return false;
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