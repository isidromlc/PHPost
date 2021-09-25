<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.nl2br.php
 * Type:     modifier
 * Name:     nl2br
 * Purpose:  Convierte de \r\n, \r o \n o => <br />
 * -------------------------------------------------------------
 * Input: <br />
 *         - Contenido = Contenido para reemplazar
 *         - preceed_test = si es verdadero, incluye etiquetas de ruptura anteriores en reemplazo
 * Example:  {$Contenido|nl2br}
 * @link https://www.php.net/nl2br
 * @version  1.0
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @return string
 */
function smarty_modifier_nl2br($string) {
    return nl2br($string);
}