<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Footer :: El footer permite mostrar la plantilla
 *
 * @package Smarty 3.1.39
 * @author PHPost Team & Miguel92 
 * @copyright PHPost Risus 2021
 * @version v1.0 19-03-2021
 * @link https://phpost.net/foro/
*/

# Definimos algunas variables 
define('CACHE', TS_ROOT . '/cache/' .TS_TEMA);
define('TEMAS', TS_ROOT . '/themes');
define('TEMA_ACTUAL', TEMAS . '/' . TS_TEMA);
define('PLUGINS', TS_ROOT . "/files/plugins");

/**
 * Compilamos los archivos en la carpeta cache
 * @link => https://www.smarty.net/docs/en/api.set.compile.dir.tpl 
*/
$smarty->setCompileDir(TS_ROOT . "cache/" . TS_TEMA);

/**
 * Creamos key para asignarle el valor del directorio,
 * ya que estas se usarán en los plugins,
 * ex: "key_name" => valor_carpeta
 * ======================================
 * ATENCIÓN: no deben cambiar ningún valor
*/
$directorios = [
	# Buscamos la carpeta del theme actual
	"tema_activado" => TEMA_ACTUAL,
	"tema_css" => TEMA_ACTUAL . "/css",
	# Buscamos todos los .tpl
	"templates" => TEMA_ACTUAL . "/templates",
	"modules" => TEMA_ACTUAL . "/modules",
	"sections" => TEMA_ACTUAL . "/sections",
	# Accedemos a todos los plugins
	"plugins" => PLUGINS,
];
$smarty->setTemplateDir($directorios);
/**
 * Indicamos la ruta de los plugins para adicionar al sitio
 * @link => https://www.smarty.net/docs/en/api.add.plugins.dir.tpl
*/
$smarty->addPluginsDir(PLUGINS);
/**
 * Con esta función habilitamos el acceso a los directorios agregados
 * en la función de $smarty->setTemplateDir(...) si no estan definidos
 * no podran obtener el contenido de las mismas
 * @link => https://www.smarty.net/docs/en/advanced.features.tpl#advanced.features.security 
*/
$smarty->enableSecurity();

# Página solicitada
$smarty->assign("tsPage", $tsPage);

$display = "t.{$tsPage}.tpl";

if($smarty->templateExists($display)) {
	# Mostramos la plantilla
	$smarty->display($display);
} else {
	# En caso que no exista, mostraremos este error
	die("Lo sentimos, se produjo un error al cargar la plantilla '$display'. Contacte al administrador");
}