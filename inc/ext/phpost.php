<?php if(!defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Ajustes :: Algunos ajustes para la configuración de Smarty
 *
 * @package Smarty 3.1.39
 * @author PHPost Team & Miguel92 
 * @copyright PHPost Risus 2021
 * @version v1.0 19-03-2021
 * @link https://phpost.net/foro/
 * @file ajustes.php
*/

/*
 *  Acá definimos la carpeta donde se almacenarán los archivos caché 
 * que se generan automáticamente al utilizar el sitio web
*/
define('TS_CACHE', TS_ROOT.DIRECTORY_SEPARATOR.'cache');
/*
 * Esta instrucción enviará los archivo caché a la carpeta 
 * que hemos definido antes
*/
$smarty->setCompileDir(TS_CACHE.DIRECTORY_SEPARATOR.TS_TEMA)
/*
 * Este arreglo es para habilitar el acceso a los tpl.
*/
->setTemplateDir([
	/* ↓ Templates ↓ */
	'main_1' => TS_ROOT.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.TS_TEMA.DIRECTORY_SEPARATOR.'templates',
	/* ↓ Registo & Login ↓ */
	'main_2' => TS_ROOT.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.'access',
	/* ↓ Vistas ↓ */
	'main_3' => TS_ROOT.DIRECTORY_SEPARATOR.'themes',
])
/*
 * Esta instrucción evitará acceso externo sin permisos.
*/
->enableSecurity();

/* COMPRIME EL HTML PARA MÁS VELOCIDAD */
$smarty->loadFilter('output', 'trimwhitespace');

$smarty->assign('tsPKey', $tsCore->settings['pkey']);

/**
 * -------------------------------------------------------------------
 * DAMOS LA UBICACIÓN GEOGRÁFICA 
 * Página: https://www.php.net/manual/es/timezones.php
 * -------------------------------------------------------------------
*/
# date_default_timezone_set('America/Argentina/Buenos_Aires');
/**
 * -------------------------------------------------------------------
 * FORZAMOS EL IDIOMA EN ESPAÑOL 
 * Página: https://www.php.net/manual/es/function.setlocale.php
 * -------------------------------------------------------------------
*/
$lang = explode(',', $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
$locale = $lang[0];
setlocale(LC_ALL, $locale);
setlocale(LC_TIME, 'spanish');
// Linux
setlocale(LC_MESSAGES, $locale);
// windows
putenv("LC_ALL={$locale}"); 
$smarty->assign('Lenguaje', $locale);