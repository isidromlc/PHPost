<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty file_exists modifier plugin
 *
 * Type:     modifier<br>
 * Name:     file_exists<br>
 * Date:     Feb 16, 2022
 * Purpose:  Comprueba que exista el archivo.
 * Input:    Devuelte un booleano
 * Example:  {$archivo_a_comprobar|file_exists}
 * @link     https://www.php.net/manual/es/function.file-exists.php
 * @author   Miguel92
 * @version  1.0
 * @param 	 string
 * @param    string
 * @return   boolean
 */
function smarty_modifier_file_exists($archivo, $directorio){
	global $smarty;

	# Extensiones de imagenes
	$img = ["png", "jpg", "gif", "webp", "svg"];

	# Nombre del archivo
	$file = end(explode('/', $archivo));

	# Extensión del archivo
	$ext = explode('.', $file)[1];

	if($directorio === 'css') {
		$file_exists = file_exists($smarty->template_dir[$ext] . $file);
	}
   
   return $file_exists;
}