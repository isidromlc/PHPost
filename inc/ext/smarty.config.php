<?php 
if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');

/**
 * Configuración de Smarty 4.0.0
 *
 * @name    smarty.config.php
 * @package Smarty 4.0
 * @link https://github.com/smarty-php/smarty
 * @author  Miguel92
 * @copyright PHPost 2022
 * @version v4.0
*/
# INCLUIMOS EL ARCHIVO NECESARIO
require_once TS_SMARTY . 'bootstrap.php';

# Inicializamos la clase
$smarty = new Smarty();

/**
 * Definiremos las rutas a:
 *
 * Plugins(php), Templates(tpl)
*/
define('TEMA_ACTIVO', TS_THEMES . TS_TEMA);
define('TEMPLATES', 	 TEMA_ACTIVO . "/templates");
define('SECTIONS', 	 TEMPLATES . "/sections");
define('MODULES', 	 TEMPLATES . "/modules");
define('ADMIN_MODS',  TEMPLATES . "/admin_mods");

# $smarty->setCaching($smarty->CACHING_LIFETIME_CURRENT);
$smarty->setCompileCheck(CACHE_CHECKED);

/**
 * Compilamos los archivos en la carpeta cache
 * @link => https://www.smarty.net/docs/en/api.set.compile.dir.tpl 
*/
$smarty->setCompileDir(TS_ROOT . "/cache/" . TS_TEMA);

/**
 * Creamos key para asignarle el valor del directorio,
 * ya que estas se usarán en los plugins,
 * ex: "key_name" => valor_carpeta
 * ======================================
 * ATENCIÓN: no deben cambiar el "key_name"
*/
$_ACCESO_TPL_PHP_ = [
	/**
	 * Todos los themes
	*/
	"themes" => TS_THEMES,
	/**
	 * Acceso para buscar los CSS/JS/IMAGES del theme
	*/
	"tema"	=> TEMA_ACTIVO,
	"css"		=> TEMA_ACTIVO . "/css",
	"js"		=> TEMA_ACTIVO . "/js",
	"images"	=> TEMA_ACTIVO . "/images",
	/**
	 * Acceso para buscar los TPL
	*/
	"templates"	=> TEMPLATES,
	"sections" 	=> SECTIONS,
	"modules"	=> MODULES,
	"admins"		=> ADMIN_MODS,
	/**
	 * Acceso para buscar los PHP
	*/
	"plugins"	=> TS_PLUGINS
];
$smarty->setTemplateDir($_ACCESO_TPL_PHP_);

/**
 * Indicamos la ruta de los plugins para adicionar al sitio,
 * debemos hacer esto para que cuente como parte de smarty
 * @link => https://www.smarty.net/docs/en/api.add.plugins.dir.tpl
*/
$smarty->addPluginsDir(TS_PLUGINS);

$SECURITY_POLICY = new Smarty_Security($smarty);
$SECURITY_POLICY->$php_handling = $smart->PHP_REMOVE;
$SECURITY_POLICY->$allow_php_tag = true;
$SECURITY_POLICY->$modifiers = [];
$SECURITY_POLICY->$php_functions = [];

/**
 * Con esta función habilitamos el acceso a los directorios agregados
 * en la función de $smarty->setTemplateDir(...) si no estan definidos
 * no podran obtener el contenido de las mismas
 * @link => https://www.smarty.net/docs/en/advanced.features.tpl#advanced.features.security 
*/
if( SECURITY ) $smarty->enableSecurity( $SECURITY_POLICY );

/**
 * Borrar archivos (no carpeta) más de $number x
 * @link => https://www.smarty.net/docs/en/api.clear.all.cache.tpl
*/
$smarty->clearAllCache( CACHE_LIFE_TIME );

/**
 * Eliminará: Comentarios, Espacios.
 * Basicamente comprimirá todo el html
 * @link => https://www.smarty.net/docs/en/api.load.filter.tpl
 * @link => https://stackoverflow.com/questions/18673684/minify-html-outputs-in-smarty/28556561
*/
if( COMPRESS_HTML ) $smarty->loadFilter('output', 'trimwhitespace');

$smarty->muteUndefinedOrNullWarnings();

$smarty->assign("tsCanonical", $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);