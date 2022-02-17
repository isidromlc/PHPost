<?php 

if (!defined('TS_HEADER')) 
    exit('No se permite el acceso directo al script');

/**
 * El footer permite mostrar la plantilla
 *
 * @name    footer.php
 * @package Smarty 4.0
 * @link https://github.com/smarty-php/smarty
 * @author  PHPost Team
 * @author  Miguel92
 * @copyright PHPost 2022
 * @version v4.0
*/

$smarty->assign("tsPage", $tsPage);

// Guardamos en una variable la plantilla a usar
$TEMP = "t.{$tsPage}.tpl";

// Esta plantilla la pueden crear, cambiar nombre pero debe existir
$ERROR_PLANTILLA = "t.error404.tpl";

// Comprobamos que exista la plantilla
$PLANTILLA = $smarty->templateExists( $TEMP ) ? $TEMP : $ERROR_PLANTILLA;

// Cacheamos la plantilla
$smarty->setCacheLifetime( CACHE_LIFE_TIME );

/**
 * Borra la versión compilada del recurso de plantilla especificado
 * @link https://www.smarty.net/docs/en/api.clear.compiled.tpl.tpl
*/
$smarty->clearCompiledTemplate( $PLANTILLA );

/**
 * Limpiamos todo el cache
 * @link https://www.smarty.net/docs/en/api.clear.all.cache.tpl
*/
$smarty->clearAllCache();

/**
 * Cargamos todo el contenido de las plantillas en HTML
 * @link https://www.smarty.net/docs/en/api.display.tpl
*/
$smarty->display( $PLANTILLA );
